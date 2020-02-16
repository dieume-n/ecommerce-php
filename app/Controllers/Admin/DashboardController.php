<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Utilities\Helpers\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}
