<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppDownloadSectionCreateRequest;
use App\Models\AppDownloadSection;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppDownloadSectionController extends Controller
{
    use FileUploadTrait;

    function index(): View
    {
        $appSection = AppDownloadSection::first();
        return view('admin.app_download_section.index', compact('appSection'));
    }

    function store(AppDownloadSectionCreateRequest $request): RedirectResponse
    {
        $AppDownloads = new AppDownloadSection();

        if ($request->hasFile('image')) {
            if ($AppDownloads->image != '/uploads/imageDefault.jpg') {
                $imagePath = $this->uploadImage($request, 'image', '/sectionAppDownloadsImages', $AppDownloads->image);
            } else {
                $imagePath = $this->uploadImage($request, 'image', '/sectionAppDownloadsImages');
            }
        }
        if ($request->hasFile('background')) {
            if ($AppDownloads->background != '/uploads/imageDefault.jpg') {
                $backgroundPath = $this->uploadImage($request, 'background', '/sectionAppDownloadsImages', $AppDownloads->background);
            } else {
                $backgroundPath = $this->uploadImage($request, 'background', '/sectionAppDownloadsImages');
            }
        }
        AppDownloadSection::updateOrCreate(
            ['id' => $request->id],
            [
                'image' => !empty($imagePath) ?  $imagePath : $request->old_image,
                'background' => !empty($backgroundPath) ?  $backgroundPath : $request->old_background,
                'title' => $request->title,
                'short_description' => $request->short_description,
                'play_store_link' => $request->play_store_link,
                'apple_store_link' => $request->apple_store_link
            ]

        );

        toastr()->success('Updated Successfully!');

        return to_route('admin.app_download.index');
    }
}
