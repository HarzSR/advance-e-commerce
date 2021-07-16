<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Session;
use Validator;

class AdminController extends Controller
{
    // Dashboard Function

    public function dashboard()
    {
        Session::put('page', 'dashboard');

        return view('admin.admin_dashboard');
    }

    // Login Function

    public function login(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();

            // V0.1 Validator

            $validator = Validator::make($request->all(), [
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|max:255',
                // 'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'password' => 'required|min:6',
            ]
            // [
            //     'password.regex' => 'Incorrect Password Strength',
            // ]
            );

            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput($request->input());
            }

            /*

            // V0.2 Validator

            $rules = [
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|max:255',
                // 'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'password' => 'required|min:6',
            ];
            $customMessages = [
                'email.required' => 'Please enter Email',
                'email.regex' => 'Please enter Valid Email',
                'password.required' => 'Please enter Password',
            ];

            $this->validate($request, $rules, $customMessages);
            */

            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']]))
            {
                return redirect('/admin/dashboard');
            }
            else
            {
                Session::flash('error_message', 'Invalid Credentials');
                return redirect()->back()->withInput($request->input());
            }

            // dd($data);
        }

        return view('admin.admin_login');
    }

    // Logout Function

    public function logout()
    {
        Session::flush();
        Auth::guard('admin')->logout();
        Session::flash('success_message', 'Logged Out Successfully');

        return redirect('/admin');
    }

    // Settings Function

    public function settings()
    {
        Session::put('page', 'settings');
        $userDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();

        return view('admin.admin_settings')->with(compact('userDetails'));
    }

    // Check Current Password Function

    public function checkCurrentPassword(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();

            // echo "<pre>"; print_r($data["current_pwd"]);

            if(Hash::check($data["current_pwd"], Auth::guard('admin')->user()->password))
            {
                echo "True";
            }
            else
            {
                echo "False";
            }
        }
    }

    // Update Settings Function

    public function updateSettings(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();

            // V0.1 Validator

            $validator = Validator::make($request->all(), [
                    'username' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|max:255',
                    'current_password' => 'required|min:6',
                    'new_password' => 'required|min:6',
                    'confirm_password' => 'required|same:new_password|min:6',
                ]
            // [
            //     'password.regex' => 'Incorrect Password Strength',
            // ]
            );

            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput($request->input());
            }

            if(Hash::check($data["current_password"], Auth::guard('admin')->user()->password))
            {
                if($data["new_password"] == $data["confirm_password"])
                {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['username'], 'password' => bcrypt($data["new_password"])]);
                    Session::flash('success_message', "Settings updated successfully");
                }
                else
                {
                    Session::flash('error_message', 'Your New Password and Confirm Password doesn\'t match. Please try again');
                    return redirect()->back();
                }
            }
            else
            {
                Session::flash('error_message', 'Your Current Password is Incorrect, Please try again');
                return redirect()->back();
            }

            return redirect()->back();
        }
    }

    // Update Admin Details Function

    public function updateAdminDetails(Request $request)
    {
        Session::put('page', 'account');

        if($request->isMethod('POST'))
        {
            $data = $request->all();

            $validator = Validator::make($request->all(), [
                    'username' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|max:255',
                    'mobile' => 'required|regex:/^[+]?[0-9][0-9]{6,14}$/|min:6',
                    // 'image' => 'required_without:current_image|mimes:jpeg,jpg,png|max:1000'
                ]
            );

            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput($request->input());
            }

            if ($request->hasFile('image'))
            {
                $image_tmp = $request->file('image');

                if ($image_tmp->isValid())
                {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = time() . mt_rand() . '.' . $extension;

                    $imagePath = "images/admin_images/admin_photos/" . $imageName;

                    Image::make($image_tmp)->resize(300, 400)->save($imagePath);
                }
            }
            else if(!empty($data['current_image']))
            {
                $imageName = $data['current_image'];
            }
            else
            {
                $imageName = "";
            }

            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['username'], 'mobile' => $data['mobile'], 'image' => $imageName]);
            Session::flash('success_message', "Details updated successfully");
        }

        $userDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();

        return view('admin.admin_update_details')->with(compact('userDetails'));
    }
}
