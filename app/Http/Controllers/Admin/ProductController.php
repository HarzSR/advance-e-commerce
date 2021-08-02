<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{
    // View Categories Function

    public function viewProducts()
    {
        Session::put('page', 'view-products');
        $products = Product::get();

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
}
