<?php
namespace App\Services;
use App\Models\PaymentGatewaySetting;
use Cache;

/**
 * If you've recently added the class,
 * you might need to run 'composer dump-autoload' to regenerate the
 * Composer autoload files.
 */
class PaymentGatewaySettingService {

    function getSettings() {
        return Cache::rememberForever('gatewaySettings', function(){
            return PaymentGatewaySetting::pluck('value', 'key')->toArray(); // ['key' => 'value']
        });
    }

    function setGlobalSettings() : void {
        $settings = $this->getSettings();
        config()->set('gatewaySettings', $settings);
    }

    function clearCachedSettings() : void {
        Cache::forget('gatewaySettings');
    }

}
