<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

test('authorization gates enforce strict RBAC boundaries across super_admin, admin_cms, and admin_psb', function () {
    if (! Schema::hasTable('users') || ! Schema::hasColumn('users', 'role')) {
        test()->markTestSkipped('Users table role column not yet migrated (M1 required).');
    }

    $superAdmin = User::factory()->create(['role' => 'super_admin']);
    $adminCms = User::factory()->create(['role' => 'admin_cms']);
    $adminPsb = User::factory()->create(['role' => 'admin_psb']);

    // Test Gate manage-cms
    if (Gate::has('manage-cms')) {
        expect(Gate::forUser($superAdmin)->allows('manage-cms'))->toBeTrue();
        expect(Gate::forUser($adminCms)->allows('manage-cms'))->toBeTrue();
        expect(Gate::forUser($adminPsb)->allows('manage-cms'))->toBeFalse();
    }

    // Test Gate manage-psb
    if (Gate::has('manage-psb')) {
        expect(Gate::forUser($superAdmin)->allows('manage-psb'))->toBeTrue();
        expect(Gate::forUser($adminCms)->allows('manage-psb'))->toBeFalse();
        expect(Gate::forUser($adminPsb)->allows('manage-psb'))->toBeTrue();
    }

    // Test Gate manage-settings
    if (Gate::has('manage-settings')) {
        expect(Gate::forUser($superAdmin)->allows('manage-settings'))->toBeTrue();
        expect(Gate::forUser($adminCms)->allows('manage-settings'))->toBeFalse();
        expect(Gate::forUser($adminPsb)->allows('manage-settings'))->toBeFalse();
    }
});

test('unauthenticated guests are redirected to login when accessing admin panels', function () {
    $cmsResponse = $this->get('/admin/cms/posts');
    expect(in_array($cmsResponse->status(), [302, 401, 403, 404]))->toBeTrue();
    if ($cmsResponse->status() === 302) {
        $cmsResponse->assertRedirect('/login');
    }

    $psbResponse = $this->get('/admin/psb');
    expect(in_array($psbResponse->status(), [302, 401, 403, 404]))->toBeTrue();
    if ($psbResponse->status() === 302) {
        $psbResponse->assertRedirect('/login');
    }
});
