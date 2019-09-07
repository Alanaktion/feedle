<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    const TOKEN_COOKIE = 'feedle_cookie';

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\Feed::class => \App\Policies\FeedPolicy::class,
        \App\Models\FeedPost::class => \App\Policies\FeedPostPolicy::class,
        \App\Models\FeedSubscription::class => \App\Policies\FeedSubscriptionPolicy::class,
        \App\Models\User::class => \App\Policies\UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::cookie(self::TOKEN_COOKIE);
    }
}
