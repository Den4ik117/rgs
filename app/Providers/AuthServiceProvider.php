<?php

namespace App\Providers;

use App\Models\Sample;
use App\Models\User;
use App\Policies\SamplePolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
         Sample::class => SamplePolicy::class,
         User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        Gate::define('see-full-report', function (User $user, Sample $sample) {
            return $user->isSponsor();
        });
    }
}
