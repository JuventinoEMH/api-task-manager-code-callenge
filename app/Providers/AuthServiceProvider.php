<?php

namespace App\Providers;

use App\Models\Project;
use App\Policies\ProjectPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
    ];

    /**
     * Register services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

    }
}
