<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class BrandController extends Controller
{
    // View Brand Function

    public function viewBrands()
    {
        Session::put('page', 'view-brands');

        $brands = Brand::get();

        return view('admin.brands.view_brands')->with(compact('brands'));
    }
}
