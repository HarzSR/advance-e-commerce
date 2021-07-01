<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard Function

    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }

    // Login Function

    public function login()
    {
        return view('admin.admin_login');
    }
}
