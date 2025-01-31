<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CounterUpdateRequest;
use App\Models\Counter;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CounterController extends Controller
{
    use FileUploadTrait;

    function index() : View {
        $counter = Counter::first();
        return view('admin.counter.index', compact('counter'));
    }

    function update(CounterUpdateRequest $request) {
        // Upload the new background image if present
        $imagePath = $this->uploadImage($request, 'background', '/settingImages');

        // Remove old background image if a new one is uploaded
        if (!empty($imagePath)) {
            $oldPath = $request->old_background;
            if ($oldPath != null) {
                $this->removeImage($oldPath);
            }
        }

        // Use updateOrCreate to either update the existing record or create a new one
        Counter::updateOrCreate(
            ['id' => $request->id],  // Assuming you're identifying the record by 'id'
            [
                'background' => !empty($imagePath) ? $imagePath : $request->old_background,
                'counter_icon_one' => $request->counter_icon_one,
                'counter_count_one' => $request->counter_count_one,
                'counter_name_one' => $request->counter_name_one,

                'counter_icon_two' => $request->counter_icon_two,
                'counter_count_two' => $request->counter_count_two,
                'counter_name_two' => $request->counter_name_two,

                'counter_icon_three' => $request->counter_icon_three,
                'counter_count_three' => $request->counter_count_three,
                'counter_name_three' => $request->counter_name_three,

                'counter_icon_four' => $request->counter_icon_four,
                'counter_count_four' => $request->counter_count_four,
                'counter_name_four' => $request->counter_name_four,
            ]
        );

        // Show success message
        toastr()->success('Updated Successfully!');

        // Redirect back
        return redirect()->back();
    }
}
