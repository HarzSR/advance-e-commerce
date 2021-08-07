<?php

namespace App\Http\Controllers\Admin;

use App\Fabric;
use App\Fit;
use App\Http\Controllers\Controller;
use App\Occasion;
use App\Pattern;
use App\Product;
use App\Sleeve;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{
    // View Categories Function

    public function viewProducts()
    {
        Session::put('page', 'view-products');
        $products = Product::with(['category' => function($query) {
            $query->select('id', 'category_name');
        }, 'section' => function($query) {
            $query->select('id', 'name');
        }])->get();

        return view('admin.products.view_products')->with(compact('products'));
    }

    // Update Product Status Function

    public function updateProductStatus(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();

            if($data['status'] == "Active")
            {
                $status = 0;
            }
            else
            {
                $status = 1;
            }

            Product::where('id', $data['product_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    // Add/Edit Product Function

    public function addEditProduct(Request $request, $id = null)
    {
        Session::put('page', 'add-edit-product');
        if($id == null)
        {
            $title = "Add Product";
        }
        else
        {
            $title = "Edit Product";
        }

        $fabricArray = Fabric::get();
        $sleeveArray = Sleeve::get();
        $patternArray = Pattern::get();
        $fitArray = Fit::get();
        $occasionArray = Occasion::get();

        return view('admin.products.add_edit_product')->with(compact('title', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray'));
    }

    // Delete Product Function

    public function deleteProduct($id = null)
    {
        Product::where('id', $id)->delete();

        Session::flash('success_message', 'Product Removed Successfully');

        return redirect()->back();
    }
}
