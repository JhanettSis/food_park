<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\DeliveryArea;
use App\Models\Area;
use App\Models\Address;
use App\Http\Requests\Frontend\AddressCreateRequest;
use App\Models\Order;
use Auth;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    // Display the user's addresses
    function index(): View
    {
        $user = Auth::user();
        $supportedAreas = DeliveryArea::where('status', 1)->get();
        $userAddresses = Address::where('user_id', $user->id)->get();
        $orders = Order::where('user_id', $user->id)->get();

        return view('frontend.dashboard.index', compact('supportedAreas', 'userAddresses', 'orders'));
    }

    // Store a new address
    function createAddress(AddressCreateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $address = new Address();
        $address->user_id = $user->id;
        $address->delivery_area_id = $request->area;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->address = $request->address;
        $address->type = $request->type;
        $address->save();

        toastr()->success('Address created successfully!');
        return redirect()->back();
    }

    // Edit an existing address
    function edit(int $id): View
    {
        $address = Address::findOrFail($id);
        $supportedAreas = DeliveryArea::where('status', 1)->get();

        return view('frontend.dashboard.index', compact('address', 'supportedAreas'));
    }

    // Update an existing address
    function updateAddress(AddressCreateRequest $request, int $id): RedirectResponse
    {
        $address = Address::findOrFail($id);
        $address->delivery_area_id = $request->area;
        $address->first_name = $request->first_name;
        $address->last_name = $request->last_name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->address = $request->address;
        $address->type = $request->type;
        $address->save();

        toastr()->success('Address updated successfully!');
        return redirect()->route('dashboard');
    }

    // Delete an existing address
    public function destroyAddress(int $id)
    {
        $address = Address::findOrFail($id);
        $user = Auth::user();
        if($address && $address->user_id === $user->id){
            $address->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        }
        return response(['status' => 'error', 'message' => 'Something went wrong!']);
    }

}
