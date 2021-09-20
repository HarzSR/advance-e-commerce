<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Validator;

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

    // Add/Edit Brand Function

    public function addEditBrand(Request $request,$id = null)
    {
        Session::put('page', 'add-edit-brand');

        if($id == null)
        {
            $title = "Add Brand";

            if($request->isMethod('POST'))
            {
                $data = $request->all();

                $validator = Validator::make($request->all(), [
                        'brand_name' => 'required|regex:/(^[A-Za-z ]+$)+/|max:255',
                    ]
                );

                if ($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput($request->input());
                }

                $brand = new Brand;

                $brand->name = $data['brand_name'];
                if(!empty($data['status']))
                {
                    $brand->status = $data['status'];
                }
                else
                {
                    $brand->status = 0;
                }

                $brand->save();

                Session::flash('success_message', 'Brand Added Successfully');

                return redirect('/admin/view-brands');
            }

            return view('admin.brands.add_edit_brand')->with(compact('title'));
        }
        else
        {
            $title = "Edit Brand";

            if($request->isMethod('POST'))
            {
                $data = $request->all();

                $validator = Validator::make($request->all(), [
                        'brand_name' => 'required|regex:/(^[A-Za-z ]+$)+/|max:255',
                    ]
                );

                if ($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput($request->input());
                }

                if(!empty($data['status']))
                {
                    $status = $data['status'];
                }
                else
                {
                    $status = 0;
                }

                Brand::where('id', $id)->update(['name' => $data['brand_name'], 'status' => $status]);

                Session::flash('success_message', 'Brand Updated Successfully');

                return redirect('/admin/view-brands');
            }

            $brandDetails = Brand::find($id);

            return view('admin.brands.add_edit_brand')->with(compact('title', 'brandDetails'));
        }
    }

    // Delete Brand Function

    public function deleteBrand($id = null)
    {
        Brand::where('id', $id)->delete();

        Session::flash('success_message', 'Brand Removed Successfully');

        return redirect()->back();
    }
}
