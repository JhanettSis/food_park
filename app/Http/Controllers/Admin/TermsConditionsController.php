<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsConditions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TermsConditionsController extends Controller
{
    function index(): View
    {
        $termsConditions = TermsConditions::first();
        return view('admin.terms_and_condition.index', compact('termsConditions'));
    }

    function update(Request $request): RedirectResponse
    {
        $request->validate([
            'content' => ['required']
        ]);

        TermsConditions::updateOrCreate(
            ['id' => $request->id],
            [
                'content' => $request->content
            ]
        );
        toastr()->success('Updated Successfully');

        return redirect()->back();
    }
}
