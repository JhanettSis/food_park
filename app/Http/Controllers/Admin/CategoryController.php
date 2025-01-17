<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Str;
use Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.product.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() :View
    {
        return view('admin.product.category.partials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request) : RedirectResponse
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->show_at_home = $request->show_at_home;
        $category->save();

        toastr()->success('Created Successfully!');
        return to_route('admin.categories.index');
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
        $category = Category::findOrFail($id);
        return view('admin.product.category.partials.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id) : RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());
        toastr()->success('Created Successfully!');
        return to_route('admin.categories.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $category = Category::findOrFail($id);
            $category->delete();
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
