<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Section;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryControlller extends Controller
{
    // Categories Function

    public function viewCategories()
    {
        Session::put('page', 'view-categories');
        $categories = Category::get();

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
        }
        else
        {
            $title = "Edit Category";
        }

        $getSections = Section::get();

        return view('admin.categories.add_edit_category')->with(compact('title', 'getSections'));
    }
}
