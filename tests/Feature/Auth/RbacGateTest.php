<?php

declare(strict_types=1);

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class RbacGateTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_has_all_abilities(): void
    {
        $superAdmin = User::factory()->superAdmin()->create();

        $this->actingAs($superAdmin);

        $this->assertTrue(Gate::allows('manage-cms'));
        $this->assertTrue(Gate::allows('manage-psb'));
        $this->assertTrue(Gate::allows('manage-settings'));
        $this->assertTrue(Gate::allows('manage-users'));
    }

    public function test_admin_cms_can_only_manage_cms(): void
    {
        $adminCms = User::factory()->adminCms()->create();

        $this->actingAs($adminCms);

        $this->assertTrue(Gate::allows('manage-cms'));
        $this->assertFalse(Gate::allows('manage-psb'));
        $this->assertFalse(Gate::allows('manage-settings'));
        $this->assertFalse(Gate::allows('manage-users'));
    }

    public function test_admin_psb_can_only_manage_psb(): void
    {
        $adminPsb = User::factory()->adminPsb()->create();

        $this->actingAs($adminPsb);

        $this->assertFalse(Gate::allows('manage-cms'));
        $this->assertTrue(Gate::allows('manage-psb'));
        $this->assertFalse(Gate::allows('manage-settings'));
        $this->assertFalse(Gate::allows('manage-users'));
    }

    public function test_guest_or_regular_user_cannot_access_any_management_gates(): void
    {
        $this->assertFalse(Gate::allows('manage-cms'));
        $this->assertFalse(Gate::allows('manage-psb'));
        $this->assertFalse(Gate::allows('manage-settings'));
        $this->assertFalse(Gate::allows('manage-users'));
    }

    public function test_public_registration_is_disabled(): void
    {
        $response = $this->get('/register');
        $response->assertNotFound();

        $postResponse = $this->post('/register', [
            'name' => 'Intruder',
            'email' => 'intruder@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);
        $postResponse->assertNotFound();
    }
}
