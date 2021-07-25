<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Section;
use Image;
use Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Categories Function

    public function viewCategories()
    {
        Session::put('page', 'view-categories');
        $categories = Category::with('section', 'parentCategory')->get();

        return view('admin.categories.view_categories')->with(compact('categories'));
    }

    // Update Category Status Function

    public function updateCategoryStatus(Request $request)
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

            Category::where('id', $data['category_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    // Add/Edit Category Function

    public function addEditCategory(Request $request, $id = null)
    {
        Session::put('page', 'add-edit-category');
        if($id == null)
        {
            $title = "Add Category";
            $categoryData = '';
            $getCategory = '';

            if($request->isMethod('POST'))
            {
                $data = $request->all();

                $validator = Validator::make($request->all(), [
                        'category_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                        'section_id' => 'required',
                        'image' => 'sometimes|mimes:jpeg,png,jpg',
                        'category_description' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                        // 'meta_description' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                        'category_url' => 'required|regex:/^([a-z0-9]+-)*[a-z0-9]+$/i|max:255',
                        'parent_id' => 'required|numeric',
                        'category_discount' => 'required|numeric|between:0,99.99',
                        // 'meta_title' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                        // 'meta_keywords' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                    ]
                );

                if($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput($request->input());
                }

                $category = new Category();

                $category->parent_id = $data['parent_id'];
                $category->section_id = $data['section_id'];
                $category->category_name = $data['category_name'];
                $category->category_discount = $data['category_discount'];
                $category->description = $data['category_description'];
                $category->url = $data['category_url'];
                $category->meta_description = $data['meta_description'];
                if(!empty($data['meta_title']))
                {
                    $category->meta_title = $data['meta_title'];
                }
                else
                {
                    $category->meta_title = '';
                }
                if(!empty($data['meta_keywords']))
                {
                    $category->meta_keywords = $data['meta_keywords'];
                }
                else
                {
                    $category->meta_keywords = '';
                }
                if(!empty($data['meta_description']))
                {
                    $category->meta_description = $data['meta_description'];
                }
                else
                {
                    $category->meta_description = '';
                }

                if($request->hasFile('image'))
                {
                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid())
                    {
                        // $extension = $image_tmp->getClientOriginalExtension();
                        $extension = $image_tmp->extension();
                        $fileName = time() . mt_rand() . '.' . $extension;

                        $large_image_path = 'images/category_images/large/' . $fileName;
                        $medium_image_path = 'images/category_images/medium/' . $fileName;
                        $small_image_path = 'images/category_images/small/' . $fileName;

                        Image::make($image_tmp)->save($large_image_path);
                        Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                        $category->category_image = $fileName;
                    }
                }
                else
                {
                    $category->category_image = '';
                }

                if(empty($data['status']))
                {
                    $category->status = 0;
                }
                else if($data['status'])
                {
                    $category->status = 1;
                }

                $category->save();

                Session::flash('success_message', 'Category Added Successfully');

                return redirect('/admin/view-categories');
            }
        }
        else
        {
            $title = "Edit Category";

            if($request->isMethod('POST'))
            {
                $data = $request->all();

                $validator = Validator::make($request->all(), [
                        'category_name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                        'section_id' => 'required',
                        'image' => 'sometimes|mimes:jpeg,png,jpg',
                        'category_description' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                        // 'meta_description' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                        'category_url' => 'required|regex:/^([a-z0-9]+-)*[a-z0-9]+$/i|max:255',
                        'parent_id' => 'required|numeric',
                        'category_discount' => 'required|numeric|between:0,99.99',
                        // 'meta_title' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                        // 'meta_keywords' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
                    ]
                );

                if($validator->fails())
                {
                    return redirect()->back()->withErrors($validator)->withInput($request->input());
                }

                dd($data);
            }

            $categoryData = Category::where('id', $id)->first();
            $getCategory = Category::with('subCategories')->where(['parent_id' => 0, 'section_id' => $categoryData->section_id])->get();
        }

        $getSections = Section::get();

        return view('admin.categories.add_edit_category')->with(compact('title', 'getSections', 'categoryData', 'getCategory'));
    }

    // Append Category Level Function

    public function appendCategoryLevel(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();

            $getCategories = Category::with('subCategories')->where(['section_id' => $data['section_id'], 'parent_id' => 0, 'status' => 1])->get();

            return view('admin.categories.append_categories_level')->with(compact('getCategories'));
        }
    }
}
