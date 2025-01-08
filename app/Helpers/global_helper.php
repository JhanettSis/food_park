<?php

use Illuminate\Support\Str;
/** We have to register this file
 *      global_helper.php
 * in the   composer.json
 *
 * autoload
 * with this, the file will autoload
 * after add the file global_helper.php in the file composer.json
 * run the code composer du in the consola
 *
*/

/**
 * Create a unique slug
*/

if(!function_exists('generateUniqueSlug')){
    function generateUniqueSlug($model, $name) : string{
        $modelClass = "App\\Models\\".$model;
        if(!class_exists($modelClass)){
            throw new \InvalidArgumentException("Model $modelClass not found");
        }
        $slug = Str::slug($name);
        $count = 2;
        while($modelClass::where('slug', $slug)->exists()){
            $slug = Str::slug($name) . '-' . $count;
            $count++;
        }

        return $slug;
    }
}

if(!function_exists('currencyPosition')){
    function currencyPosition($price) : string {
        if(config('settings.site_currency_icon_position') === 'left'){
            return config('settings.site_currency_icon')." ".$price;
        }else{
            return $price." ".config('settings.site_currency_icon');
        }
    }
}

if(!function_exists('currencyIconInput')){
    function currencyIconInput() : string {
        return config('settings.site_currency_icon');
    }
}
