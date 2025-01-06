<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductGalleryController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(string $productId) : View
    {
        $galleryImages = ProductGallery::where('product_id', $productId)->get();
        $product = Product::findOrFail($productId);
        return view('admin.product.gallery.index', compact('product', 'galleryImages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'gallery_image' => ['required', 'image', 'max:3000'],
            'product_id' => ['required']
        ]);

        $imagePath = $this->uploadImage($request, 'gallery_image', '/productImages' );
        $gallery = new ProductGallery();
        $gallery->product_id = $request->product_id;
        $gallery->gallery_image = $imagePath;
        $gallery->save();
        toastr()->success('Created successfully!');
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) //: Response
    {
        try {
            $galleryImage = ProductGallery::FindOrFail($id);
            $this->removeImage($galleryImage->gallery_image);
            $galleryImage->delete();
            return response(['status' => 'success', 'message' => 'Delete successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong!']);
        };
    }
}
