<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Validator;

class AdminController extends Controller
{
    // Dashboard Function

    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }

    // Login Function

    public function login(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();

            $validator = Validator::make($request->all(), [
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                // 'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'password' => 'required|min:6',
            ]
            /*
            [
                'password.regex' => 'Incorrect Password Strength',
            ]
            */
            );

            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput($request->input());
            }

            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']]))
            {
                return redirect('/admin/dashboard');
            }
            else
            {
                Session::flash('error_message', 'Invalid Credentials');
                return redirect()->back()->withInput($request->input());
            }

            dd($data);
        }

        return view('admin.admin_login');
    }

    // Logout Function

    public function logout()
    {
        Auth::guard('admin')->logout();
        Session::flash('success_message', 'Logged Out Successfully');

        return redirect('/admin');
    }
}
