<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\WhyChooseUsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WhyChooseUsCreateRequest;
use App\Models\SectionTitle;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Redirect;

class WhyChooseUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WhyChooseUsDataTable $dataTable)
    {
        $keys = ['why_choose_us_top_title', 'why_choose_us_main_title', 'why_choose_us_sub_title'];
        $titles = SectionTitle::whereIn('key', $keys)->pluck('value', 'key'); //['key' => 'value']
        return $dataTable->render('admin.why_choose_us.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        //
        return view('admin.why_choose_us.partials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WhyChooseUsCreateRequest $request) : RedirectResponse
    {
        WhyChooseUs::create($request->validated());
        toastr()->success('Created Successfully!');
        return to_route('admin.why_choose_us.index');
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
        $whyChooseUs = WhyChooseUs::findOrFail($id);
        return view('admin.why_choose_us.partials.edit', compact('whyChooseUs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WhyChooseUsCreateRequest $request, string $id) : RedirectResponse
    {
        $whyChooseUs = WhyChooseUs::findOrFail($id);
        $whyChooseUs->update($request->validated());
        toastr()->success('Created Successfully!');
        return to_route('admin.why_choose_us.index');

    }

    public function updateTitle(Request $request){
        $request->validate([
            'why_choose_us_top_title' => ['max:100'],
            'why_choose_us_main_title' => ['max:200'],
            'why_choose_us_sub_title' => ['max:500'],
        ]);

        SectionTitle::updateOrCreate(
            ['key' => 'why_choose_us_top_title'],
            ['value' => $request->why_choose_us_top_title]
        );
        SectionTitle::updateOrCreate(
            ['key' => 'why_choose_us_main_title'],
            ['value' => $request->why_choose_us_main_title]
        );
        SectionTitle::updateOrCreate(
            ['key' => 'why_choose_us_sub_title'],
            ['value' => $request->why_choose_us_sub_title]
        );

        toastr()->success('Update Successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $whyChooseUs = WhyChooseUs::findOrFail($id);
            $whyChooseUs->delete();
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
