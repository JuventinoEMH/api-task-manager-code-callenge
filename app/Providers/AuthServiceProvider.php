<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;
use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
        Task::class => TaskPolicy::class,
    ];

    /**
     * Register services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('create-task', function (User $user, Project $project) {
            return $user->id === $project->user_id;
        });




    }
}
