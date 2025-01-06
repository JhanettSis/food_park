<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionProduct;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OptionProductController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'option_name' => ['required', 'max:255'],
            'price' => ['required', 'numeric'],
            'product_id' => ['required', 'integer']
        ],
        [
            'option_name.required' => 'An Option name for Product is required',
            'price.required' => 'A Price value numeric for Product is required'
        ]);
        $product_option = new OptionProduct();

        $product_option->option_name = $request->option_name;
        $product_option->price = $request->price;
        $product_option->product_id = $request->product_id;
        $product_option->save();
        toastr()->success('Created successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        try{
            $product_option = OptionProduct::FindOrFail($id);
            $product_option->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        }catch(\Exception $e){
            return response(['status' => 'error', 'message' => 'Something went wrong!!']);
        }
    }
}
