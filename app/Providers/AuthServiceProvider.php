<?php

namespace MixCode\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;
use MixCode\Feature;
use MixCode\Language;
use MixCode\Card;
use MixCode\Policies\FeaturePolicy;
use MixCode\Policies\LanguagePolicy;
use MixCode\Policies\CardPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Feature::class => FeaturePolicy::class,
        Language::class => LanguagePolicy::class,
        Card::class => CardPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Expires Tokens After 2 Weeks Only

        // Get Or Set When Tokens Are Expires
        Passport::tokensExpireIn(now()->addWeeks(2));

        // Get Or Set When Refreshed Tokens Are Expires
        Passport::refreshTokensExpireIn(now()->addMonth());
    }
}
