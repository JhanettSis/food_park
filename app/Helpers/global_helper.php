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

/** Calculate cart total */
    if(!function_exists('cartTotal')) {
        function cartTotal(){
            $total = 0;


            foreach(Cart::content() as $item) {
                $priceProduct = $item->price;
                $priceSize = $item->options?->sizeProduct['price'] ?? 0;
                $optionsPrice = 0;
                foreach($item->options->optionsProduct as $option) {
                        $optionsPrice += $option['price'] ?? 0;
                }

                $total += $item->qty * ($priceProduct + $priceSize + $optionsPrice);
            }

            $total = round($total, 2);

            return $total;
        }
    }
/**
 * Calculate product total
 */
if(!function_exists('productCartViewTotal')) {
    function productCartViewTotal($rowId){
        $total = 0;
        $product = Cart::get($rowId);
        $priceProduct = $product->price;
        $priceSize = $product->options?->sizeProduct['price'] ?? 0;
        $optionsPrice = 0;
        foreach($product->options->optionsProduct as $option) {
                $optionsPrice += $option['price'] ?? 0;
        }
        $total += $product->qty * ($priceProduct + $priceSize + $optionsPrice);
        return $total;
    }
}
/**
  * Grand cart total
  */


    if(!function_exists('grant_total')){
        function grandCartTotal(){
            $total = 0;
            $discount = 0;
            $subTotal = cartTotal();
            // Remove commas from the number1 if it's a string and Convert string to float
            //$convertSubtotal = (float) str_replace(',', '', $subTotal);
            if(session()->has('coupon')){
                $discount = session()->get('coupon')['discount'];
                $total = $subTotal - $discount;
                return $total;
            }
            return $subTotal;
        }
    }

    /** Generate Invoice Id */
    if (!function_exists('generateInvoiceId')) {
        function generateInvoiceId()
        {
            $randomNumber = rand(1, 9999);
            $currentDateTime = now();

            $invoiceId = $randomNumber . $currentDateTime->format('yd') . $currentDateTime->format('s');

            return $invoiceId;
        }
    }

    /** get product discount in percent */
    if (!function_exists('discountInPercent')) {
        function discountInPercent($originalPrice, $discountPrice)
        {
            $result = (($originalPrice - $discountPrice) / $originalPrice) * 100;
            return round($result, 2);
        }
    }

    /** get product discount in percent */
    if (!function_exists('getYtThumbnail')) {
        function getYtThumbnail($link, $size = 'medium')
        {
            try {
                $videoId = explode("?v=", $link);
                $videoId = $videoId[1];

                $finalSize = match ($size) {
                    'low' => 'sddefault',
                    'medium' => 'mqdefault',
                    'high' => 'hqdefault',
                    'max' => 'maxresdefault'
                };
                return "https://img.youtube.com/vi/$videoId/$finalSize.jpg";
            } catch (\Exception $e) {
                logger($e);
                return NULL;
            }
        }
    }

    /** This custom truncate function is essentially a convenience wrapper around
     * Laravel's built-in Str::limit method, which allows you to truncate strings
     * easily and append an ellipsis.
     * It is useful for situations where I need to display a preview of a longer
     * string (like an excerpt of a blog post or a comment), while ensuring that
     * it doesn't exceed a set number of characters. */
    if (!function_exists('truncate')) {
        function truncate(string $string, int $limit = 100)
        {
            return \Str::limit($string, $limit, '...');
        }
    }
