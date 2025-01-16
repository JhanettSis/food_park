<?php

namespace App\Providers;
/**
 * I add this file class SettingsServiceProvider on
 * botstrap/providers.php file
 */
use App\Services\SettingsService;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingsService::class, function(){
            return new SettingsService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $settingsService = $this->app->make(SettingsService::class);
        /**
         * The function setGlobalSettings(); is on the
         *  App\Services\SettingsService file
         */
        $settingsService->setGlobalSettings();
    }
}
