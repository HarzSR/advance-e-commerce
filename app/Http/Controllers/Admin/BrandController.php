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

    // Update Brand Status Function

    public function updateBrandsStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();

            if ($data['status'] == "Active")
            {
                $status = 0;
            } else
            {
                $status = 1;
            }

            Brand::where('id', $data['brand_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
    }
}
