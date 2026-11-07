<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\ApplicationStatus;
use App\Enums\DocumentType;
use App\Enums\Gender;
use App\Enums\PaymentStatus;
use App\Enums\PostStatus;
use App\Enums\ProgramType;
use App\Enums\SettingGroup;
use App\Enums\UserRole;
use App\Models\AdmissionWave;
use App\Models\Applicant;
use App\Models\ApplicantDocument;
use App\Models\ApplicantParent;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\GalleryPhoto;
use App\Models\Post;
use App\Models\PostView;
use App\Models\SiteSetting;
use App\Models\Teacher;
use App\Models\User;
use Carbon\CarbonInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;

uses(RefreshDatabase::class);

test('User model uses ULID and casts role to UserRole Backed Enum', function () {
    $user = User::create([
        'name' => 'Adversarial Admin',
        'email' => 'adversarial@daareltazkiyah.sch.id',
        'password' => 'password123',
        'role' => UserRole::SuperAdmin,
    ]);

    expect($user->id)->toBeString()
        ->and(strlen($user->id))->toBe(26)
        ->and(Str::isUlid($user->id))->toBeTrue()
        ->and($user->role)->toBe(UserRole::SuperAdmin)
        ->and($user->isSuperAdmin())->toBeTrue()
        ->and($user->isAdminCms())->toBeFalse()
        ->and($user->isAdminPsb())->toBeFalse()
        ->and($user->canManageCms())->toBeTrue()
        ->and($user->canManagePsb())->toBeTrue()
        ->and($user->canManageSettings())->toBeTrue();

    // Verify rejection of invalid enum string
    expect(fn () => User::create([
        'name' => 'Invalid Enum User',
        'email' => 'invalid@example.com',
        'password' => 'password123',
        'role' => 'non_existent_role',
    ]))->toThrow(\ValueError::class);
});

test('AdmissionWave model integrity, casts and scopeActive/isOpen verification', function () {
    $now = Carbon::parse('2027-01-15 10:00:00');
    Carbon::setTestNow($now);

    $activeWave = AdmissionWave::create([
        'name' => 'Gelombang I 2027',
        'slug' => 'gelombang-i-2027',
        'academic_year' => '2027/2028',
        'start_date' => '2027-01-01',
        'end_date' => '2027-02-28',
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
        'max_quota_mts' => 100,
        'max_quota_mdta' => 50,
    ]);

    $pastWave = AdmissionWave::create([
        'name' => 'Gelombang Lampau',
        'slug' => 'gelombang-lampau',
        'academic_year' => '2026/2027',
        'start_date' => '2026-01-01',
        'end_date' => '2026-02-28',
        'fee_mts' => 80000,
        'fee_mdta' => 20000,
    ]);

    expect(Str::isUlid($activeWave->id))->toBeTrue()
        ->and($activeWave->start_date)->toBeInstanceOf(CarbonInterface::class)
        ->and($activeWave->fee_mts)->toBe(100000)
        ->and($activeWave->isOpen())->toBeTrue()
        ->and($pastWave->isOpen())->toBeFalse();

    $activeResults = AdmissionWave::query()->active()->get();
    expect($activeResults)->toHaveCount(1)
        ->and($activeResults->first()->id)->toBe($activeWave->id);

    expect(AdmissionWave::currentActive()?->id)->toBe($activeWave->id);

    Carbon::setTestNow();
});

test('Applicant model casts Backed Enums, maintains scopes and relationships', function () {
    $wave = AdmissionWave::create([
        'name' => 'Gelombang Test',
        'slug' => 'gelombang-test',
        'academic_year' => '2027/2028',
        'start_date' => now()->subDay()->toDateString(),
        'end_date' => now()->addMonth()->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $applicant = Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => 'PSB-2027-MTS-0001',
        'access_token' => 'ABC12345',
        'program_type' => ProgramType::Mts,
        'full_name' => 'Muhammad Fatih',
        'nik' => '3273010101990001',
        'nisn' => '0012345678',
        'gender' => Gender::Male,
        'birth_place' => 'Cirebon',
        'birth_date' => '2013-05-10',
        'child_order' => 1,
        'previous_school' => 'SD IT Al-Hidayah',
        'address' => 'Jl. Kanggraksan No. 45',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::Unpaid,
        'application_status' => ApplicationStatus::Pending,
    ]);

    expect($applicant->program_type)->toBe(ProgramType::Mts)
        ->and($applicant->gender)->toBe(Gender::Male)
        ->and($applicant->payment_status)->toBe(PaymentStatus::Unpaid)
        ->and($applicant->application_status)->toBe(ApplicationStatus::Pending)
        ->and($applicant->canBeEdited())->toBeTrue();

    // Test parent relationship
    $parent = ApplicantParent::create([
        'applicant_id' => $applicant->id,
        'father_name' => 'Ahmad Fauzi',
        'mother_name' => 'Siti Aminah',
        'father_job' => 'PNS',
        'mother_job' => 'Guru',
        'parent_phone' => '081234567890',
        'parent_address' => 'Jl. Kanggraksan No. 45',
    ]);

    expect($applicant->parent->id)->toBe($parent->id)
        ->and($parent->applicant->id)->toBe($applicant->id);

    // Test documents relationship
    $doc = ApplicantDocument::create([
        'applicant_id' => $applicant->id,
        'document_type' => DocumentType::Kk,
        'file_path' => 'documents/kk_0001.pdf',
        'original_name' => 'kartu_keluarga.pdf',
    ]);

    expect($applicant->documents)->toHaveCount(1)
        ->and($applicant->document(DocumentType::Kk)?->id)->toBe($doc->id)
        ->and($doc->document_type)->toBe(DocumentType::Kk);

    // Test Scopes
    expect(Applicant::program(ProgramType::Mts)->count())->toBe(1)
        ->and(Applicant::program(ProgramType::Mdta)->count())->toBe(0)
        ->and(Applicant::status(ApplicationStatus::Pending)->count())->toBe(1)
        ->and(Applicant::search('Fatih')->count())->toBe(1)
        ->and(Applicant::search('0012345678')->count())->toBe(1)
        ->and(Applicant::search('NON_EXISTENT')->count())->toBe(0);
});

test('Post model casts, relationships, and scopes (published, featured, byCategory)', function () {
    $author = User::create([
        'name' => 'Ust. Penulis',
        'email' => 'penulis@daareltazkiyah.sch.id',
        'password' => 'secret123',
        'role' => UserRole::AdminCms,
    ]);

    $category = Category::create([
        'name' => 'Kegiatan Santri',
        'slug' => 'kegiatan-santri',
        'description' => 'Seputar kegiatan santri Daar El Tazkiyah',
    ]);

    $publishedPost = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'Kajian Rutin Tafsir Al-Quran',
        'slug' => 'kajian-rutin-tafsir-al-quran',
        'content' => '<p>Kajian rutin setiap hari Ahad pagi.</p>',
        'status' => PostStatus::Published,
        'is_featured' => true,
        'published_at' => now()->subHour(),
    ]);

    $draftPost = Post::create([
        'category_id' => $category->id,
        'author_id' => $author->id,
        'title' => 'Draf Rencana Acara Ramadhan',
        'slug' => 'draf-rencana-acara-ramadhan',
        'content' => '<p>Konten rahasia belum rilis.</p>',
        'status' => PostStatus::Draft,
        'is_featured' => false,
        'published_at' => null,
    ]);

    expect($publishedPost->status)->toBe(PostStatus::Published)
        ->and($publishedPost->author->id)->toBe($author->id)
        ->and($publishedPost->category->id)->toBe($category->id)
        ->and($author->posts->pluck('id'))->toContain($publishedPost->id);

    // Verify scopes
    $publishedPosts = Post::query()->published()->get();
    expect($publishedPosts->pluck('id'))->toContain($publishedPost->id)
        ->and($publishedPosts->pluck('id'))->not->toContain($draftPost->id);

    $featuredPosts = Post::query()->featured()->get();
    expect($featuredPosts->pluck('id'))->toContain($publishedPost->id)
        ->and($featuredPosts->pluck('id'))->not->toContain($draftPost->id);

    $byCat = Post::query()->byCategory('kegiatan-santri')->get();
    expect($byCat)->toHaveCount(2);

    // Test PostView daily aggregation
    PostView::recordView($publishedPost->id);
    expect($publishedPost->views)->toHaveCount(1)
        ->and($publishedPost->totalViews())->toBe(1);

    // Test soft delete
    $publishedPost->delete();
    expect(Post::count())->toBe(1)
        ->and(Post::withTrashed()->count())->toBe(2);
});

test('Teacher model casts sort_order and scopes active and ordered', function () {
    $t1 = Teacher::create([
        'full_name' => 'KH. Ahmad Dahlan, Lc., M.A.',
        'role_title' => 'Pengasuh Pondok',
        'bio' => 'Alumni Universitas Al-Azhar Kairo Mesir',
        'sort_order' => 1,
        'is_active' => true,
    ]);

    $t2 = Teacher::create([
        'full_name' => 'Ust. Muhammad Zaid, S.Pd.I',
        'role_title' => 'Pengajar Tahfizh',
        'sort_order' => 2,
        'is_active' => false,
    ]);

    expect($t1->sort_order)->toBe(1)
        ->and($t1->is_active)->toBeTrue()
        ->and($t2->is_active)->toBeFalse();

    $active = Teacher::query()->active()->get();
    expect($active)->toHaveCount(1)
        ->and($active->first()->id)->toBe($t1->id);

    $ordered = Teacher::query()->ordered()->get();
    expect($ordered->first()->id)->toBe($t1->id)
        ->and($ordered->last()->id)->toBe($t2->id);
});

test('Gallery and GalleryPhoto relationships and scopes', function () {
    $gallery = Gallery::create([
        'title' => 'Wisuda Santri Angkatan I',
        'slug' => 'wisuda-santri-angkatan-i',
        'description' => 'Dokumentasi wisuda santri',
        'event_date' => '2026-10-15',
        'sort_order' => 1,
        'is_published' => true,
    ]);

    $photo1 = GalleryPhoto::create([
        'gallery_id' => $gallery->id,
        'file_path' => 'galleries/photo1.webp',
        'caption' => 'Foto Bersama Asatidz',
        'sort_order' => 1,
    ]);

    $photo2 = GalleryPhoto::create([
        'gallery_id' => $gallery->id,
        'file_path' => 'galleries/photo2.webp',
        'caption' => 'Pemberian Ijazah',
        'sort_order' => 2,
    ]);

    expect($gallery->photos)->toHaveCount(2)
        ->and($gallery->photos->first()->id)->toBe($photo1->id)
        ->and($gallery->photos->last()->id)->toBe($photo2->id)
        ->and($photo1->gallery->id)->toBe($gallery->id);

    expect(Gallery::query()->published()->count())->toBe(1);
});

test('SiteSetting model supports cached get, set and SettingGroup cast', function () {
    SiteSetting::set('contact_phone', '081234567890', SettingGroup::General);

    expect(SiteSetting::get('contact_phone'))->toBe('081234567890')
        ->and(SiteSetting::get('non_existent', 'default_val'))->toBe('default_val');

    $setting = SiteSetting::where('key', 'contact_phone')->first();
    expect($setting->group)->toBe(SettingGroup::General);
});

test('Sessions table supports 26-character ULID user_id without truncation or MySQL 1366 incompatibility', function () {
    expect(Schema::hasTable('sessions'))->toBeTrue();

    $user = User::create([
        'name' => 'Session ULID User',
        'email' => 'session_ulid@example.com',
        'password' => 'secret123',
        'role' => UserRole::AdminPsb,
    ]);

    $sessionId = Str::random(40);

    // Simulate database session handler write
    DB::table('sessions')->insert([
        'id' => $sessionId,
        'user_id' => $user->id,
        'ip_address' => '127.0.0.1',
        'user_agent' => 'PHPUnit/Pest Adversarial Harness',
        'payload' => base64_encode(serialize(['_token' => Str::random(40), 'data' => 'test'])),
        'last_activity' => time(),
    ]);

    $storedSession = DB::table('sessions')->where('id', $sessionId)->first();

    expect($storedSession)->not->toBeNull()
        ->and($storedSession->user_id)->toBe($user->id)
        ->and(strlen((string) $storedSession->user_id))->toBe(26)
        ->and(Str::isUlid((string) $storedSession->user_id))->toBeTrue();
});

test('Spatie Activitylog polymorphically stores ULID subject and causer', function () {
    $causer = User::create([
        'name' => 'Admin Verifier',
        'email' => 'verifier@daareltazkiyah.sch.id',
        'password' => 'secret123',
        'role' => UserRole::AdminPsb,
    ]);

    $wave = AdmissionWave::create([
        'name' => 'Gelombang Log Test',
        'slug' => 'gelombang-log-test',
        'academic_year' => '2027/2028',
        'start_date' => now()->toDateString(),
        'end_date' => now()->addMonth()->toDateString(),
        'fee_mts' => 100000,
        'fee_mdta' => 25000,
    ]);

    $applicant = Applicant::create([
        'admission_wave_id' => $wave->id,
        'registration_number' => 'PSB-2027-MTS-7777',
        'access_token' => 'LOG77777',
        'program_type' => ProgramType::Mts,
        'full_name' => 'Santri Log Subject',
        'nik' => '3273010101770001',
        'gender' => Gender::Male,
        'birth_place' => 'Cirebon',
        'birth_date' => '2013-01-01',
        'child_order' => 1,
        'previous_school' => 'SD 1',
        'address' => 'Jl. Pemuda No. 1',
        'registration_fee' => 100000,
        'payment_status' => PaymentStatus::Unpaid,
        'application_status' => ApplicationStatus::Pending,
    ]);

    activity('psb_applicant')
        ->performedOn($applicant)
        ->causedBy($causer)
        ->withProperties(['old' => 'pending', 'new' => 'verified'])
        ->log('Status diverifikasi');

    $log = Activity::where('description', 'Status diverifikasi')
        ->latest('id')
        ->first();

    expect($log)->not->toBeNull()
        ->and($log->subject_id)->toBe($applicant->id)
        ->and($log->causer_id)->toBe($causer->id)
        ->and(Str::isUlid((string) $log->subject_id))->toBeTrue()
        ->and(Str::isUlid((string) $log->causer_id))->toBeTrue();
});
