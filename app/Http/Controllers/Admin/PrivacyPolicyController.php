<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PrivacyPolicyController extends Controller
{
    function index(): View
    {
        $privacyPolicy = PrivacyPolicy::first();
        return view('admin.privacy_policy.index', compact('privacyPolicy'));
    }

    function update(Request $request): RedirectResponse
    {
        $request->validate([
            'content' => ['required']
        ]);

        PrivacyPolicy::updateOrCreate(
            ['id' => $request->id],
            [
                'content' => $request->content
            ]
        );
        toastr()->success('Updated Successfully');

        return redirect()->back();
    }
}
