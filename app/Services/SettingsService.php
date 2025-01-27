<?php
namespace App\Services;
/**
 * If you've recently added the class,
 * you might need to run 'composer dump-autoload' to regenerate the
 * Composer autoload files.
 */
use App\Models\Setting;
use Cache;
use Illuminate\Support\Facades\Config;

class SettingsService {
    /**Purpose: Fetches the settings from the cache or the database.
     * The Cache::rememberForever method checks if the settings
     * key exists in the cache.
     * If it exists, it returns the cached value.
     * If it doesn't exist, it executes the closure function,
     * which retrieves the settings from the Setting model and caches the result forever.
     * Setting::pluck('value', 'key')->toArray()
     * retrieves all settings and returns them as an associative array
     * where the key is the setting key and the value is the setting value. */
    function getSettings() : array {

        return Cache::rememberForever('settings', function(){
            return Setting::pluck('value', 'key')->toArray(); //['key' => 'value']
        });
    }

    /**Purpose: Sets the global configuration settings.
     * Calls the getSettings method to retrieve the settings.
     * Uses config()->set('settings', $settings) to set
     * the global configuration settings. */
    function setGlobalSettings() : void {
        $settings = $this->getSettings();
        config()->set('settings', $settings);
    }

    function clearCachedSettings() : void {
        Cache::forget('settings');
    }


    /**
     * Dynamically set the Pusher configuration using settings from the database.
     */
    public static function setPusherConfig()
    {
        // Fetch settings from the SettingsService
        $settingsService = new SettingsService();
        $settingsService->setGlobalSettings(); // Ensure settings are loaded into config()

        // Retrieve Pusher credentials from settings (from the global config)
        $pusherConfig = [
            'driver' => 'pusher',
            'key' => config('settings.pusher_key'), // Get from 'settings' table
            'secret' => config('settings.pusher_secret'),
            'app_id' => config('settings.pusher_app_id'),
            'options' => [
                'cluster' => config('settings.pusher_cluster'),
                'useTLS' => true,
            ],
        ];

        // Set the full Pusher configuration in the broadcasting config
        Config::set('broadcasting.connections.pusher', $pusherConfig);
    }

}
