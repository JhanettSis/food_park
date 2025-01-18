<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DeliveryAreaDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryArea;

class DeliveryAreaController extends Controller
{
    public function index(DeliveryAreaDataTable $dataTable)
    {
        return $dataTable->render('admin.deliveryArea.index');
    }

    public function create()
    {
        // Show the form for creating a new delivery area
        return view('admin.deliveryArea.partials.create');
    }

    public function store(Request $request)
    {
        // Store a newly created delivery area in storage
        $validatedData = $request->validate([
            'area_name' => 'required|string|max:255',
            'min_delivery_time' => 'required|string|max:255',
            'max_delivery_time' => 'required|string|max:255',
            'delivery_fee' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        DeliveryArea::create($validatedData);

        // Other way to return function it display diferent message success
        // return redirect()->route('admin.delivery_areas.index')
        // ->with('success', 'Delivery Area created successfully.');
        toastr()->success('Created Successfully!');
        return to_route('admin.delivery_areas.index');
    }

    public function edit(DeliveryArea $deliveryArea)
    {
        // Show the form for editing the specified delivery area
        return view('admin.deliveryArea.partials.edit', compact('deliveryArea'));
    }

    public function update(Request $request, DeliveryArea $deliveryArea)
    {
        // Update the specified delivery area in storage
        $validatedData = $request->validate([
            'area_name' => 'required|string|max:255',
            'min_delivery_time' => 'required|string|max:255',
            'max_delivery_time' => 'required|string|max:255',
            'delivery_fee' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        $deliveryArea->update($validatedData);
        // Other way to return function it display diferent message success
        // return redirect()->route('admin.delivery_areas.index')
        // ->with('success', 'Delivery Area updated successfully.');

        toastr()->success('Update Successfully!');
        return to_route('admin.delivery_areas.index');
    }

    // Other way to delete function
    // public function destroy(DeliveryArea $deliveryArea)
    // {
    //     // Remove the specified delivery area from storage
    //     $deliveryArea->delete();

    //     return redirect()->route('admin.delivery_areas.index')->with('success', 'Delivery Area deleted successfully.');
    // }
    public function destroy(string $id)
    {
        try{
            $deliveryArea = DeliveryArea::findOrFail($id);
            $deliveryArea->delete();
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
