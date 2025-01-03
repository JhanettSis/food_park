<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCreateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Traits\FileUploadTrait;

class ProductController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        $categories = Category::all();
        return view('admin.product.partials.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        /** Handle product Image  */
        // Handle product image upload
        $imagePath = $this->uploadImage($request, 'product_image', '/productImages');
        $product = new Product();

        // Save product data
        $product->product_image = $imagePath;
        $product->product_name = $request->product_name;
        $product->slug = generateUniqueSlug('Product', $request->product_name);
        $product->category_id = $request->category_id;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->sku = $request->sku;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->show_at_home = $request->show_at_home;
        $product->status = $request->status;
        $product->save();
        toastr()->success('Created successfully!');
        return to_route('admin.product.index');

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
