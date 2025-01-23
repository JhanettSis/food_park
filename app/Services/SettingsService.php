<?php
namespace App\Services;
/**
 * If you've recently added the class,
 * you might need to run 'composer dump-autoload' to regenerate the
 * Composer autoload files.
 */
use App\Models\Setting;
use Cache;
class SettingsService {
    function getSettings() : array {
        return Cache::rememberForever('settings', function(){
            return Setting::pluck('value', 'key')->toArray(); //['key' => 'value']
        });
    }

    function setGlobalSettings() : void {
        $settings = $this->getSettings();
        config()->set('settings', $settings);
    }

    function clearCachedSettings() : void {
        Cache::forget('settings');
    }

}
