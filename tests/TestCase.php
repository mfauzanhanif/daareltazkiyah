<?php

namespace Tests;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Fortify\Features;

abstract class TestCase extends BaseTestCase
{
    protected function skipUnlessFortifyHas(string $feature, ?string $message = null): void
    {
        if (! Features::enabled($feature)) {
            $this->markTestSkipped($message ?? "Fortify feature [{$feature}] is not enabled.");
        }
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    protected function createUser(array $attributes = []): User
    {
        $user = new User;
        $user->forceFill([
            'name' => $attributes['name'] ?? fake()->name(),
            'email' => $attributes['email'] ?? fake()->unique()->safeEmail(),
            'email_verified_at' => array_key_exists('email_verified_at', $attributes) ? $attributes['email_verified_at'] : now(),
            'password' => $attributes['password'] ?? Hash::make('password'),
            'role' => $attributes['role'] ?? UserRole::AdminCms,
            'remember_token' => $attributes['remember_token'] ?? Str::random(10),
        ])->save();

        return $user;
    }
}
