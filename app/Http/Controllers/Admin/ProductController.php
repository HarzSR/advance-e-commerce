<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Fabric;
use App\Fit;
use App\Http\Controllers\Controller;
use App\Occasion;
use App\Pattern;
use App\Product;
use App\ProductsAttribute;
use App\ProductsImage;
use App\Section;
use App\Sleeve;
use Illuminate\Http\Request;
use Session;
use Validator;
use Image;

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

            $productDetail = "";

            if($request->isMethod('POST'))
            {
                $data = $request->all();

                $validator = Validator::make($request->all(), [
                        'category_id' => 'required|integer',
                        'product_name' => 'required|regex:/(^[A-Za-z0-9 -_]+$)+/|max:255',
                        'product_code' => 'required|alpha_num',
                        'product_color' => 'required|regex:/(^[A-Za-z ]+$)+/',
                        'fabric_id' => 'required',
                        'sleeve_id' => 'required',
                        'wash_care' => 'required|string|min:1|max:1000',
                        'brand' => 'required',
                        'occasion' => 'required',
                        'product_weight' => 'required|numeric|between:0,999999.99',
                        'product_price' => 'required|numeric',
                        'product_discount' => 'required|numeric|between:0,99.99',
                        'pattern_id' => 'required',
                        'fit_id' => 'required',
                        'main_image' => 'sometimes|mimes:jpeg,png,jpg',
                        'product_video' => 'sometimes|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime',
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
                $product->brand = $data['brand'];
                $product->occasion = $data['occasion'];

                if($request->hasFile('main_image'))
                {
                    $image_tmp = $request->file('main_image');
                    if($image_tmp->isValid())
                    {
                        // $extension = $image_tmp->getClientOriginalExtension();
                        $extension = $image_tmp->extension();
                        $fileName = time() . mt_rand() . '.' . $extension;

                        $large_image_path = 'images/product_images/large/' . $fileName;
                        $medium_image_path = 'images/product_images/medium/' . $fileName;
                        $small_image_path = 'images/product_images/small/' . $fileName;

                        Image::make($image_tmp)->save($large_image_path);
                        Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                        $product->main_image = $fileName;
                    }
                }
                else
                {
                    $product->main_image = '';
                }
                if($request->hasFile('product_video'))
                {
                    $video_temp = $request->file('product_video');
                    if($video_temp->isValid())
                    {
                        // $video_name = $video_temp->getClientOriginalName();
                        $video_extension = $video_temp->getClientOriginalExtension();
                        $video_name = time() . mt_rand() . '.' . $video_extension;

                        $video_path = public_path() . '/videos/product_videos';

                        $video_temp->move($video_path, $video_name);

                        $product->product_video = $video_name;
                    }
                }
                else
                {
                    $product->product_video = '';
                }

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

                if(!empty($data['is_featured']) && $data['is_featured'] == 1)
                {
                    $product->is_featured = "Yes";
                }
                else
                {
                    $product->is_featured = "No";
                }
                if(!empty($data['status']))
                {
                    $product->status = $data['status'];
                }
                else
                {
                    $product->status = 0;
                }

                $product->save();

                Session::flash('success_message', 'Product Added Successfully');

                return redirect('/admin/view-products');
            }
        }
        else
        {
            $title = "Edit Product";

            if($request->isMethod('POST'))
            {
                $data = $request->all();

                $validator = Validator::make($request->all(), [
                        'category_id' => 'required|integer',
                        'product_name' => 'required|regex:/(^[A-Za-z0-9 -_]+$)+/|max:255',
                        'product_code' => 'required|alpha_num',
                        'product_color' => 'required|regex:/(^[A-Za-z ]+$)+/',
                        'fabric_id' => 'required',
                        'sleeve_id' => 'required',
                        'wash_care' => 'required|string|min:1|max:1000',
                        'brand' => 'required',
                        'occasion' => 'required',
                        'product_weight' => 'required|numeric|between:0,999999.99',
                        'product_price' => 'required|numeric',
                        'product_discount' => 'required|numeric|between:0,99.99',
                        'pattern_id' => 'required',
                        'fit_id' => 'required',
                        'main_image' => 'sometimes|mimes:jpeg,png,jpg',
                        'product_video' => 'sometimes|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime',
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

                $category_id = $data['category_id'];
                $section_id = $categoryDetails->section_id;
                $product_name = $data['product_name'];
                $product_code = $data['product_code'];
                $product_color = $data['product_color'];
                $product_price = $data['product_price'];
                $product_discount = $data['product_discount'];
                $product_weight = $data['product_weight'];
                $description = $data['category_description'];
                $wash_care = $data['wash_care'];
                $fabric = $data['fabric_id'];
                $pattern = $data['pattern_id'];
                $sleeve = $data['sleeve_id'];
                $fit = $data['fit_id'];
                $brand = $data['brand'];
                $occasion = $data['occasion'];

                if(!empty($data['current_image']) && empty($data['main_image']))
                {
                    $main_image = $data['current_image'];
                }
                else if(empty($data['current_image']) && !empty($data['main_image']))
                {
                    if($request->hasFile('main_image'))
                    {
                        $image_tmp = $request->file('main_image');
                        if($image_tmp->isValid())
                        {
                            // $extension = $image_tmp->getClientOriginalExtension();
                            $extension = $image_tmp->extension();
                            $fileName = time() . mt_rand() . '.' . $extension;

                            $large_image_path = 'images/product_images/large/' . $fileName;
                            $medium_image_path = 'images/product_images/medium/' . $fileName;
                            $small_image_path = 'images/product_images/small/' . $fileName;

                            Image::make($image_tmp)->save($large_image_path);
                            Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                            Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                            $main_image = $fileName;
                        }
                    }
                }
                else if(!empty($data['current_image']) && !empty($data['main_image']))
                {
                    $this->deleteProductImage($id);

                    if($request->hasFile('main_image'))
                    {
                        $image_tmp = $request->file('main_image');
                        if($image_tmp->isValid())
                        {
                            // $extension = $image_tmp->getClientOriginalExtension();
                            $extension = $image_tmp->extension();
                            $fileName = time() . mt_rand() . '.' . $extension;

                            $large_image_path = 'images/product_images/large/' . $fileName;
                            $medium_image_path = 'images/product_images/medium/' . $fileName;
                            $small_image_path = 'images/product_images/small/' . $fileName;

                            Image::make($image_tmp)->save($large_image_path);
                            Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                            Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                            $main_image = $fileName;
                        }
                    }
                }
                else if(empty($data['current_image']) && empty($data['main_image']))
                {
                    $main_image = '';
                }

                if(!empty($data['current_video']) && empty($data['product_video']))
                {
                    $product_video = $data['current_video'];
                }
                else if(empty($data['current_video']) && !empty($data['product_video']))
                {
                    if($request->hasFile('product_video'))
                    {
                        $video_temp = $request->file('product_video');
                        if($video_temp->isValid())
                        {
                            // $video_name = $video_temp->getClientOriginalName();
                            $video_extension = $video_temp->getClientOriginalExtension();
                            $video_name = time() . mt_rand() . '.' . $video_extension;

                            $video_path = public_path() . '/videos/product_videos';

                            $video_temp->move($video_path, $video_name);

                            $product_video = $video_name;
                        }
                    }
                }
                else if(!empty($data['current_video']) && !empty($data['product_video']))
                {
                    $this->deleteProductVideo($id);

                    if($request->hasFile('product_video'))
                    {
                        $video_temp = $request->file('product_video');
                        if($video_temp->isValid())
                        {
                            // $video_name = $video_temp->getClientOriginalName();
                            $video_extension = $video_temp->getClientOriginalExtension();
                            $video_name = time() . mt_rand() . '.' . $video_extension;

                            $video_path = public_path() . '/videos/product_videos';

                            $video_temp->move($video_path, $video_name);

                            $product_video = $video_name;
                        }
                    }
                }
                else if(empty($data['current_video']) && empty($data['product_video']))
                {
                    $product_video = '';
                }

                if(!empty($data['meta_title']))
                {
                    $meta_title = $data['meta_title'];
                }
                else
                {
                    $meta_title = '';
                }
                if(!empty($data['meta_description']))
                {
                    $meta_description = $data['meta_description'];
                }
                else
                {
                    $meta_description = '';
                }
                if(!empty($data['meta_keywords']))
                {
                    $meta_keywords = $data['meta_keywords'];
                }
                else
                {
                    $meta_keywords = '';
                }

                if(!empty($data['is_featured']) && $data['is_featured'] == 1)
                {
                    $is_featured = "Yes";
                }
                else
                {
                    $is_featured = "No";
                }
                if(!empty($data['status']))
                {
                    $status = $data['status'];
                }
                else
                {
                    $status = 0;
                }

                Product::where('id', $id)->update(['category_id' => $category_id, 'section_id' => $section_id, 'brand_id' => $brand, 'product_name' => $product_name, 'product_code' => $product_code, 'product_color' => $product_color, 'product_price' => $product_price, 'product_discount' => $product_discount, 'product_weight' => $product_weight, 'main_image' => $main_image, 'product_video' => $product_video, 'description' => $description, 'wash_care' => $wash_care, 'fabric' => $fabric, 'pattern' => $pattern, 'sleeve' => $sleeve, 'fit' => $fit, 'occasion' => $occasion, 'meta_title' => $meta_title,  'meta_description' => $meta_description,  'meta_keywords' => $meta_keywords,  'is_featured' => $is_featured,  'status' => $status]);

                Session::flash('success_message', 'Product Updated Successfully');

                return redirect('/admin/view-products');
            }

            $productDetail = Product::find($id);

            if($productDetail == null)
            {
                Session::flash('error_message', 'Invalid Product ID, Please try again.');

                return redirect()->back();
            }
        }

        $fabricArray = Fabric::where(['status' => 1])->get();
        $sleeveArray = Sleeve::where(['status' => 1])->get();
        $patternArray = Pattern::where(['status' => 1])->get();
        $fitArray = Fit::where(['status' => 1])->get();
        $occasionArray = Occasion::where(['status' => 1])->get();
        $brandArray = Brand::where(['status' => 1])->get();

        $categories = Section::with('categories')->get();

        return view('admin.products.add_edit_product')->with(compact('title', 'productDetail', 'categories', 'fabricArray', 'sleeveArray', 'patternArray', 'fitArray', 'occasionArray', 'brandArray'));
    }

    // Delete Product Image Function

    public function deleteProductImage($id = null)
    {
        // Hard Delete

        $productImage = Product::select('main_image')->where(['id' => $id])->first();

        if(!empty($productImage))
        {
            $large_image_path = 'images/product_images/large/' . $productImage->main_image;
            $medium_image_path = 'images/product_images/medium/' . $productImage->main_image;
            $small_image_path = 'images/product_images/small/' . $productImage->main_image;

            // File::delete($large_image_path, $medium_image_path, $small_image_path);
            if (file_exists($large_image_path) && !empty($productImage->main_image))
            {
                unlink($large_image_path);
            }
            if (file_exists($medium_image_path) && !empty($productImage->main_image))
            {
                unlink($medium_image_path);
            }
            if (file_exists($small_image_path) && !empty($productImage->main_image))
            {
                unlink($small_image_path);
            }

            // Soft Delete

            Product::where(['id' => $id])->update(['main_image' => '']);

            Session::flash('success_message', 'Product Image Removed Successfully');

            return redirect()->back();
        }
    }

    // Delete Product Video Function

    public function deleteProductVideo($id = null)
    {
        // Hard Delete

        $productVideo = Product::select('product_video')->where(['id' => $id])->first();

        if(!empty($productVideo))
        {
            $video_path = 'videos/product_videos/' . $productVideo->product_video;

            // File::delete($video_path);
            if (file_exists($video_path) && !empty($productVideo->product_video))
            {
                unlink($video_path);
            }

            // Soft Delete

            Product::where(['id' => $id])->update(['product_video' => '']);

            Session::flash('success_message', 'Product Video Removed Successfully');

            return redirect()->back();
        }
    }

    // Delete Product Function

    public function deleteProduct($id = null)
    {
        $this->deleteProductImage($id);
        $this->deleteProductVideo($id);

        $additionalImages = ProductsImage::where(['product_id' => $id])->get();

        foreach ($additionalImages as $additionalImage)
        {
            $this->deleteProductImages($additionalImage->id);
        }

        $attributeData = ProductsAttribute::where(['product_id' => $id])->get();

        if(!empty($attributeData))
        {
            foreach ($attributeData as $attribute)
            {
                $this->deleteAttributes($attribute->id);
            }
        }

        Product::where('id', $id)->delete();

        Session::flash('success_message', 'Product Removed Successfully');

        return redirect()->back();
    }

    // Add Product Attributes Function

    public function addAttributes(Request $request, $id = null)
    {
        Session::put('page', 'add-attributes');

        $title = "Add/Edit Product Attributes";

        if($request->isMethod('POST'))
        {
            $data = $request->all();

            foreach($data['sku'] as $key => $value)
            {
                if(!empty($value))
                {
                    // Prevent duplicate SKU

                    $skuCount = ProductsAttribute::where(['sku' => $value, 'product_id' => $id])->count();

                    if($skuCount > 0)
                    {
                        Session::flash('error_message', 'SKU Already Exists, Please update SKU or try different SKU');

                        return redirect()->back();
                    }

                    $sizeCount = ProductsAttribute::where(['size' => $data['size'][$key], 'product_id' => $id])->count();

                    if($sizeCount > 0)
                    {
                        Session::flash('error_message', 'Size Already Exists, Please update Size or try different Size');

                        return redirect()->back();
                    }

                    $attribute = new ProductsAttribute;

                    $attribute->product_id = $id;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->sku = $value;
                    $attribute->status = 1;

                    $attribute->save();
                }
            }

            Session::flash('success_message', 'Product Attributes Added Successfully');

            return redirect()->back();
        }

        $productData = Product::with('attributes')->find($id);
        $categoryData = Category::find($productData->category_id);
        $sectionData = Section::find($productData->section_id);

        return view('admin.products.add_attributes')->with(compact('title', 'productData', 'categoryData', 'sectionData'));
    }

    // Update Attribute Values Function

    public function updateAttributes(Request $request, $id = null)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();

            foreach($data['sku'] as $key => $value)
            {
                if(!empty($value))
                {
                    ProductsAttribute::where(['product_id' => $id, 'sku' => $value])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }

            Session::flash('success_message', 'Product Attributes Updated Successfully');

            return redirect()->back();
        }
    }

    // Update Attribute Status Function

    public function updateAttributeStatus(Request $request)
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

            ProductsAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }

    // Delete Attribute Function

    public function deleteAttributes($id = null)
    {
        ProductsAttribute::where('id', $id)->delete();

        Session::flash('success_message', 'Product Attributes Removed Successfully');

        return redirect()->back();
    }

    // Add Additional Images to Product Function

    public function addImages(Request $request, $id = null)
    {
        Session::put('page', 'add-images');

        $title = "Add/Edit Product Images";

        if($request->isMethod('POST'))
        {
            $data = $request->file('images');

            foreach($data as $key => $image)
            {
                $productImage = new ProductsImage;

                $productImage->product_id = $id;

                // $extension = $image_tmp->getClientOriginalExtension();
                $extension = $image->extension();
                $fileName = time() . mt_rand() . '.' . $extension;

                $large_image_path = 'images/product_images/large/' . $fileName;
                $medium_image_path = 'images/product_images/medium/' . $fileName;
                $small_image_path = 'images/product_images/small/' . $fileName;

                Image::make($image)->save($large_image_path);
                Image::make($image)->resize(600, 600)->save($medium_image_path);
                Image::make($image)->resize(300, 300)->save($small_image_path);

                $productImage->image = $fileName;
                $productImage->status = 1;

                $productImage->save();
            }

            Session::flash('success_message', 'Product Images Added Successfully');

            return redirect()->back();
        }

        $productData = Product::with('images')->find($id);
        $categoryData = Category::find($productData->category_id);
        $sectionData = Section::find($productData->section_id);

        return view('admin.products.add_images')->with(compact('title', 'productData', 'categoryData', 'sectionData'));
    }

    // Update Additional Image Status Function

    public function updateImageStatus(Request $request)
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

            ProductsImage::where('id', $data['image_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
        }
    }

    // Delete Attribute Function

    public function deleteProductImages($id = null)
    {
        // Hard Delete

        $productImage = ProductsImage::select('image')->where(['id' => $id])->first();

        if(!empty($productImage))
        {
            $large_image_path = 'images/product_images/large/' . $productImage->image;
            $medium_image_path = 'images/product_images/medium/' . $productImage->image;
            $small_image_path = 'images/product_images/small/' . $productImage->image;

            // File::delete($large_image_path, $medium_image_path, $small_image_path);
            if (file_exists($large_image_path) && !empty($productImage->image))
            {
                unlink($large_image_path);
            }
            if (file_exists($medium_image_path) && !empty($productImage->image))
            {
                unlink($medium_image_path);
            }
            if (file_exists($small_image_path) && !empty($productImage->image))
            {
                unlink($small_image_path);
            }

            // Soft Delete

            ProductsImage::where('id', $id)->delete();

            Session::flash('success_message', 'Product Images Removed Successfully');

            return redirect()->back();
        }
    }
}
