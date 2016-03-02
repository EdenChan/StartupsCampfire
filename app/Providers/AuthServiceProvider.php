<?php

namespace StartupsCampfire\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use StartupsCampfire\Models\Comment;
use StartupsCampfire\Models\Event;
use StartupsCampfire\Models\Post;
use StartupsCampfire\Policies\CommentPolicy;
use StartupsCampfire\Policies\EventPolicy;
use StartupsCampfire\Policies\PostPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Comment::class => CommentPolicy::class,
        Event::class => EventPolicy::class,
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        //
    }
}
