<?php

declare(strict_types=1);

use App\Http\Controllers\Portal\PortalCmsController;
use App\Http\Controllers\Portal\PortalPsbController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\Public\ProfileController;
use App\Http\Controllers\Public\ProgramController;
use App\Http\Controllers\Public\PsbController;
use App\Http\Controllers\Public\SystemSetupController;
use Illuminate\Support\Facades\Route;

// --- Public Landing Page ---
Route::get('/', HomeController::class)->name('home');

// --- Public Profil, Program, MTs & MDTA (Unified Interactive Pages) ---
Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/program', [ProgramController::class, 'index'])->name('program.index');
Route::get('/mts', [ProgramController::class, 'mts'])->name('mts.index');
Route::get('/mdta', [ProgramController::class, 'mdta'])->name('mdta.index');

// --- Public Contact Page ---
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak/konsultasi', [ContactController::class, 'sendConsultation'])->name('contact.consultation');

// --- Public News (CMS) ---
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');

// --- Public Gallery (CMS - Pinterest Masonry Grid) ---
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');

// --- Public PSB Online Portal ---
Route::prefix('psb')->name('psb.')->group(function () {
    Route::get('/', [PsbController::class, 'index'])->name('index');
    Route::get('/biaya', [PsbController::class, 'fee'])->name('fee');
    Route::get('/perlengkapan', [PsbController::class, 'equipment'])->name('perlengkapan');
    Route::get('/equipment', [PsbController::class, 'equipment'])->name('equipment');
    Route::get('/form', [PsbController::class, 'form'])->name('form');
    Route::post('/daftar', [PsbController::class, 'store'])->name('store');
    Route::get('/sukses/{registration_number}', [PsbController::class, 'success'])->name('success');
    Route::get('/bukti/{registration_number}', [PsbController::class, 'downloadProof'])->name('proof');
    Route::get('/status', [PsbController::class, 'statusForm'])->name('status');
    Route::post('/status', [PsbController::class, 'checkStatus'])->middleware('throttle:10,60')->name('check-status');
    Route::put('/edit/{registration_number}', [PsbController::class, 'update'])->name('edit');
});

// --- System Setup Helper (Deployment) ---
Route::match(['GET', 'POST'], '/system-setup', [SystemSetupController::class, 'handle'])->middleware('throttle:5,1')->name('system.setup');

// --- Authenticated Dashboard ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'portal.dashboard')->name('dashboard');

    // Admin CMS Routes
    Route::middleware('can:manage-cms')->prefix('admin/cms')->name('admin.cms.')->group(function () {
        Route::get('/', [PortalCmsController::class, 'dashboard'])->name('dashboard');

        // Posts
        Route::get('/posts', [PortalCmsController::class, 'indexPosts'])->name('posts.index');
        Route::get('/posts/create', [PortalCmsController::class, 'createPost'])->name('posts.create');
        Route::post('/posts', [PortalCmsController::class, 'storePost'])->name('posts.store');
        Route::get('/posts/{id}/edit', [PortalCmsController::class, 'editPost'])->name('posts.edit');
        Route::put('/posts/{id}', [PortalCmsController::class, 'updatePost'])->name('posts.update');
        Route::delete('/posts/{id}', [PortalCmsController::class, 'destroyPost'])->name('posts.destroy');

        // Categories
        Route::get('/categories', [PortalCmsController::class, 'indexCategories'])->name('categories.index');
        Route::post('/categories', [PortalCmsController::class, 'storeCategory'])->name('categories.store');
        Route::put('/categories/{id}', [PortalCmsController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/categories/{id}', [PortalCmsController::class, 'destroyCategory'])->name('categories.destroy');

        // Galleries & Photos
        Route::get('/galleries', [PortalCmsController::class, 'indexGalleries'])->name('galleries.index');
        Route::post('/galleries', [PortalCmsController::class, 'storeGallery'])->name('galleries.store');
        Route::get('/galleries/{id}', [PortalCmsController::class, 'showGallery'])->name('galleries.show');
        Route::put('/galleries/{id}', [PortalCmsController::class, 'updateGallery'])->name('galleries.update');
        Route::delete('/galleries/{id}', [PortalCmsController::class, 'destroyGallery'])->name('galleries.destroy');
        Route::post('/galleries/{id}/photos', [PortalCmsController::class, 'storeGalleryPhoto'])->name('galleries.photos.store');
        Route::delete('/galleries/photos/{id}', [PortalCmsController::class, 'destroyGalleryPhoto'])->name('galleries.photos.destroy');

        // Teachers
        Route::get('/teachers', [PortalCmsController::class, 'indexTeachers'])->name('teachers.index');
        Route::post('/teachers', [PortalCmsController::class, 'storeTeacher'])->name('teachers.store');
        Route::put('/teachers/{id}', [PortalCmsController::class, 'updateTeacher'])->name('teachers.update');
        Route::delete('/teachers/{id}', [PortalCmsController::class, 'destroyTeacher'])->name('teachers.destroy');

        // Settings
        Route::middleware('can:manage-settings')->group(function () {
            Route::get('/settings', [PortalCmsController::class, 'indexSettings'])->name('settings.index');
            Route::post('/settings', [PortalCmsController::class, 'updateSettings'])->name('settings.update');
        });
    });

    // Admin PSB Routes
    Route::middleware('can:manage-psb')->prefix('admin/psb')->name('admin.psb.')->group(function () {
        Route::get('/', [PortalPsbController::class, 'dashboard'])->name('dashboard');
        Route::get('/applicants', [PortalPsbController::class, 'indexApplicants'])->name('applicants.index');
        Route::get('/applicants/{id}', [PortalPsbController::class, 'showApplicant'])->name('applicants.show');
        Route::patch('/applicants/{id}/status', [PortalPsbController::class, 'updateStatus'])->name('applicants.update-status');
        Route::get('/export', [PortalPsbController::class, 'export'])->name('export');
    });
});

require __DIR__.'/settings.php';
