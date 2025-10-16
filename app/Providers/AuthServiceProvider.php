<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Project;
use App\Policies\TeamPolicy;
use App\Policies\EventPolicy;
use App\Policies\ProjectPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
        Event::class => EventPolicy::class,
        Team::class => TeamPolicy::class, // Tambahkan baris ini
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}