<?php

declare(strict_types=1);

namespace App\Providers;

use App\Enums\UserRole;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Testing\TestResponse;
use Illuminate\Validation\Rules\Password;
use Livewire\Blaze\Blaze;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->configureBlaze();
        $this->configureGates();

        if (class_exists(TestResponse::class)) {
            TestResponse::macro('status', function () {
                /** @var TestResponse $this */
                return $this->getStatusCode();
            });
        }
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }

    /**
     * Configure Livewire Blaze component optimization.
     */
    protected function configureBlaze(): void
    {
        Blaze::optimize()->in(resource_path('views/components'));
    }

    /**
     * Configure RBAC authorization gates.
     */
    protected function configureGates(): void
    {
        // Super Admin blanket authorization bypass
        Gate::before(function (User $user, string $ability): ?bool {
            return $user->role === UserRole::SuperAdmin ? true : null;
        });

        // CMS Management: Articles, Categories, Galleries, Teachers
        Gate::define('manage-cms', function (User $user): bool {
            return $user->canManageCms();
        });

        // PSB Online Admissions: Applicants, Review, Status Updates, Export
        Gate::define('manage-psb', function (User $user): bool {
            return $user->canManagePsb();
        });

        // Site Settings Management: Contact, Social, Bank, Fees
        Gate::define('manage-settings', function (User $user): bool {
            return $user->canManageSettings();
        });

        // Admin User Account Management
        Gate::define('manage-users', function (User $user): bool {
            return $user->role === UserRole::SuperAdmin;
        });
    }
}
