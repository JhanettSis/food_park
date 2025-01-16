<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCreateRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Traits\FileUploadTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable): View|JsonResponse
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
    public function store(ProductCreateRequest $request) : RedirectResponse
    {
        /** Handle product Image  */
        /**
         * the function uploadImage(); is on file
         * App/Trails/FileUploadTrait.php
         *  */
        $imagePath = $this->uploadImage($request, 'product_image', '/productImages');

        $product = new Product();
        // Save product data
        /** The function generateUniqueSlug(); is on the file
         * App/Helpers/global_helper.php
          */
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
        $product->product_image = $imagePath;
        $product->save();

        toastr()->success('Created successfully!');
        return to_route('admin.products.index');

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
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('admin.product.partials.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id) : RedirectResponse
    {
        $product = Product::findOrFail($id);

        /** Handle Image Upload */
        /**
         * the function uploadImage(); is on file
         * App/Trails/FileUploadTrait.php
         *  */
        if ($request->hasFile('product_image')) {
            if ($product->product_image != '/uploads/imageDefault.jpg') {
                $imagePath = $this->uploadImage($request, 'product_image', '/productImages', $product->product_image);
            } else {
                $imagePath = $this->uploadImage($request, 'product_image', '/productImages');
            }

            $product->product_image = $imagePath;
        }

        // Update other fields
        /** The function generateUniqueSlug(); is on the file
         * App/Helpers/global_helper.php
          */
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
        toastr()->success('Update successfully!');
        return to_route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $product = Product::findOrFail($id);
            if($product->product_image != '/uploads/imageDefault.jpg'){
                /**
                 * the function uploadImage(); is on file
                 * App/Trails/FileUploadTrait.php
                */
                $this->removeImage($product->product_image);
            }
            $product->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
        }catch(\Exception $e){
            return response(['status' => 'error', 'message' => 'something went wrong!']);
        }
    }
}
