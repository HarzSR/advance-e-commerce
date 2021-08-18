<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Fabric;
use App\Fit;
use App\Http\Controllers\Controller;
use App\Occasion;
use App\Pattern;
use App\Product;
use App\Section;
use App\Sleeve;
use Illuminate\Http\Request;
use Session;
use Validator;

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

            if($request->isMethod('POST'))
            {
                $data = $request->all();

                $validator = Validator::make($request->all(), [
                        'category_id' => 'required|integer',
                        'product_name' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|max:255',
                        'product_code' => 'required|alpha_num',
                        'product_color' => 'required|regex:/(^[A-Za-z ]+$)+/',
                        'fabric_id' => 'required',
                        'sleeve_id' => 'required',
                        'wash_care' => 'required|string|min:1|max:1000',
                        'occasion' => 'required',
                        'product_weight' => 'required|numeric|between:0,99.99',
                        'product_price' => 'required|numeric',
                        'product_discount' => 'required|numeric|between:0,99.99',
                        'pattern_id' => 'required',
                        'fit_id' => 'required',
                        'main_image' => 'sometimes|mimes:jpeg,png,jpg',
                        'product_video' => 'sometimes|mimes:jpeg,png,jpg',
                        'category_description' => 'required|string|min:1|max:1000',
                        // 'meta_description' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                        // 'meta_title' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                        // 'meta_keywords' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                    ]
                );

                if ($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput($request->input());
                }

                $categoryDetails = Category::find($data['category_id']);

                $product = new Product;

                $product->category_id = $data['category_id'];
                $product->section_id = $categoryDetails->section_id;
                $product->product_name = $data['product_name'];
                $product->product_code = $data['product_code'];
                $product->product_color = $data['product_color'];
                $product->product_price = $data['product_price'];
                $product->product_discount = $data['product_discount'];
                $product->product_weight = $data['product_weight'];
                $product->description = $data['category_description'];
                $product->wash_care = $data['wash_care'];
                $product->fabric = $data['fabric_id'];
                $product->pattern = $data['pattern_id'];
                $product->sleeve = $data['sleeve_id'];
                $product->fit = $data['fit_id'];
                $product->occasion = $data['occasion'];

                if(!empty($data['meta_title']))
                {
                    $product->meta_title = $data['meta_title'];
                }
                else
                {
                    $product->meta_title = '';
                }
                if(!empty($data['meta_description']))
                {
                    $product->meta_description = $data['meta_description'];
                }
                else
                {
                    $product->meta_description = '';
                }
                if(!empty($data['meta_keywords']))
                {
                    $product->meta_keywords = $data['meta_keywords'];
                }
                else
                {
                    $product->meta_keywords = '';
                }
                if(!empty($data['is_featured']))
                {
                    $product->is_featured = $data['is_featured'];
                }
                else
                {
                    $product->is_featured = 0;
                }
                if(!empty($data['status']))
                {
                    $product->status = $data['status'];
                }
                else
                {
                    $product->status = 0;
                }

                $product->product_video = '';
                $product->main_image = '';
            }
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

        $categories = Section::with('categories')->get();

        return view('admin.products.add_edit_product')->with(compact('title', 'categories', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray'));
    }

    // Delete Product Function

    public function deleteProduct($id = null)
    {
        Product::where('id', $id)->delete();

        Session::flash('success_message', 'Product Removed Successfully');

        return redirect()->back();
    }
}
