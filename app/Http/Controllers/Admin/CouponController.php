<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Http\Requests\Admin\CouponCreateRequest;
use App\Http\Requests\Admin\CouponUpdateRequest;
use App\DataTables\CouponDataTable;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CouponDataTable $dataTable)
    {
        return $dataTable->render('admin.coupon.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.coupon.partials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // Store a newly created coupon in the database
    public function store(CouponCreateRequest $request)
    {
        // Create a new Coupon instance
        $coupon = new Coupon();

        // Manually assign the validated attributes to the coupon
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->quantity = $request->quantity;
        $coupon->min_purchase_amount = $request->min_purchase_amount;
        $coupon->expire_date = $request->expire_date;
        $coupon->discount_type = $request->discount_type;
        $coupon->discount = $request->discount;
        $coupon->status = $request->status;

        // Save the coupon to the database
        $coupon->save();

        // Redirect back with success message
        toastr()->success('Created successfully!');
        return to_route('admin.coupons.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.partials.edit', compact('coupon')); // Pass coupon data to the view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponUpdateRequest $request, string $id) : RedirectResponse
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update($request->validated());
        toastr()->success('Update Successfully!');
        return to_route('admin.coupons.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();
            return response(['status'=> 'success', 'message' => 'Deleted Successfully!']);
        }
        catch(\Exception $e){
            /**
             *This other kind of sending a message error $e->getMessage()
             * is for development trying to find the real erro and for best practice
             * The developers can not display any information about the application
             *
             * return response(['status'=> 'error', 'message' => $e->getMessage()]);
             */

            return response(['status'=> 'error', 'message' => 'Something went wrong!']);
        }
    }
}
