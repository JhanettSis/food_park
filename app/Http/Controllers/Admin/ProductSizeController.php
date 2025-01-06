<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OptionProduct;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $productId) : View
    {
        $product = Product::FindOrFail($productId);
        $product_options = OptionProduct::where('product_id', $productId)->get();
        $product_sizes = ProductSize::where('product_id', $productId)->get();
        return view('admin.product.product_size.index', compact('product', 'product_sizes', 'product_options'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //: RedirectResponse
    {
        $request->validate([
            'size_name' => ['required', 'max:255'],
            'price' => ['required', 'numeric'],
            'product_id' => ['required', 'integer']
        ]);
        $product_size = new ProductSize();

        $product_size->size_name = $request->size_name;
        $product_size->price = $request->price;
        $product_size->product_id = $request->product_id;
        $product_size->save();
        toastr()->success('Created successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : Response
    {
        try{
            $product_size = ProductSize::FindOrFail($id);
            $product_size->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        }catch(\Exception $e){
            return response(['status' => 'error', 'message' => 'Something went wrong!!']);
        }
    }
}
