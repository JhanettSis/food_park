<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderCreateRequest;
use App\Http\Requests\Admin\SliderUpdateRequest;
use App\Models\Slider;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Redirect;

class SliderController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        //return view('admin.slider.index');
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.slider.partials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderCreateRequest $request)
    {
        /** Handle image upload */
        /**
         * the function uploadImage(); is on file
         * App/Trails/FileUploadTrait.php
         *  */
        $imagePath = $this->uploadImage($request, 'image', '/sliderImages');
        $slider = new Slider();
        $slider->offer = $request->offer;
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->short_description = $request->short_description;
        $slider->button_link = $request->button_link;
        $slider->status = $request->status;
        $slider->image = $imagePath;
        $slider->save();
        toastr()->success('Created successfully!');
        return to_route('admin.slider.index');
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
    public function edit(string $id): View
    {
        $slider = Slider::findOrFail($id);

        return view('admin.slider.partials.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request, string $id): RedirectResponse
    {
        $slider = Slider::findOrFail($id);

        /** Handle Image Upload */
        /**
         * the function uploadImage(); is on file
         * App/Trails/FileUploadTrait.php
         *  */
        if ($request->hasFile('image')) {
            if ($slider->image != '/uploads/imageDefault.jpg') {
                $imagePath = $this->uploadImage($request, 'image', '/sliderImages', $slider->image);
            } else {
                $imagePath = $this->uploadImage($request, 'image', '/sliderImages');
            }

            $slider->image = $imagePath;
        }

        // Update other fields
        $slider->offer = $request->offer;
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->short_description = $request->short_description;
        $slider->button_link = $request->button_link;
        $slider->status = $request->status;

        $slider->save();
        toastr()->success('Update successfully!');
        return to_route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $slider = Slider::FindOrFail($id);
            if ($slider->image != '/uploads/imageDefault.jpg') {
                /**
                 * the function uploadImage(); is on file
                 * App/Trails/FileUploadTrait.php
                */
                $this->removeImage($slider->image);
            }
            $slider->delete();
            return response(['status' => 'success', 'message' => 'Delete successfully!']);
        } catch (\Exception $e) {
            return response(['status' => 'error', 'message' => 'Something went wrong!']);
        };
    }
}
