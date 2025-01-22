<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\DeliveryArea;
use Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    function index()
    {
        $user = Auth::user();
        $addresses = Address::where(['user_id' => $user->id])->get();
        $supportedAreas = DeliveryArea::where('status', 1)->get();
        return view('frontend.pages.checkout', compact('addresses', 'supportedAreas'));
    }

    function CalculateDeliveryCharge(string $id)
    {
        try {
            $address = Address::findOrFail($id);
            $deliveryFee = $address->deliveryArea?->delivery_fee;

            // Use regular expression to find numbers and decimals
            preg_match_all('/\d+(\.\d+)?/', grandCartTotal(), $matches);

            // Flatten the matches array to get all the found numbers and decimals
            $numbers = array_map('floatval', $matches[0]);

            $grandTotal = $numbers[0] + $deliveryFee;

            return response(['delivery_fee' => currencyPosition($deliveryFee),
            'grand_total' => $grandTotal,
            'message' => 'Added fee for delivery']);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong!'], 422);
        }
    }
}
