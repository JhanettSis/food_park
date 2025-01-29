<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderPlacedNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class AdminDashboardController
 *
 * Manages the admin dashboard view and related actions.
 */
class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard page.
     *
     * URL: /admin/dashboard
     * Method: GET
     *
     * @return View
     *
     * This method returns the admin dashboard view.
     * The view file is located at 'resources/views/admin/dashboard/index.blade.php'.
     *
     * This dashboard is separate from the regular user dashboard,
     * allowing for different layouts and data tailored for admin users.
     */
    public function index() : View {
        // Render the admin dashboard page.
        // This view is specific to the admin section.
        return view('admin.dashboard.index');
    }

    function clearNotification() {
        $notification = OrderPlacedNotification::query()->update(['seen' => 1]);

        toastr()->success('Notification Cleared Successfully!');
        return redirect()->back();
    }
}
