<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    function index() : View{
        //this view is coming from resources/view/dashboard/index.blade.php
        // I created a different index for admin
        return view('admin_dashboard.index');
    }
}
