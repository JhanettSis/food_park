<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TodaysOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Order;
use App\Models\OrderPlacedNotification;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
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
    public function index(TodaysOrderDataTable $dataTable) : View|JsonResponse {

        $todaysOrders = Order::whereDate('created_at', now()->format('Y-m-d'))->count();
        $todaysEarnings = Order::whereDate('created_at', now()->format('Y-m-d'))->where('order_status', 'delivered')->sum('grand_total');

        $thisMonthsOrders = Order::whereMonth('created_at', now()->month)->count();
        $thisMonthsEarnings = Order::whereMonth('created_at', now()->month)->where('order_status', 'delivered')->sum('grand_total');

        $thisYearOrders = Order::whereYear('created_at', now()->year)->count();
        $thisYearEarnings = Order::whereYear('created_at', now()->year)->where('order_status', 'delivered')->sum('grand_total');

        $totalOrders = Order::count();
        $totalEarnings = Order::where('order_status', 'delivered')->sum('grand_total');

        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();

        $totalProducts = Product::count();
        $totalBlogs = Blog::count();

         // This view is specific to the admin section.
        return $dataTable->render('admin.dashboard.index', compact(
            'todaysOrders',
            'todaysEarnings',
            'thisMonthsOrders',
            'thisMonthsEarnings',
            'thisYearOrders',
            'thisYearEarnings',
            'totalOrders',
            'totalEarnings',
            'totalUsers',
            'totalAdmins',
            'totalProducts',
            'totalBlogs'
        ));
    }

    function clearNotification() {
        $notification = OrderPlacedNotification::query()->update(['seen' => 1]);

        toastr()->success('Notification Cleared Successfully!');
        return redirect()->back();
    }
}
