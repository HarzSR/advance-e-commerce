<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use Session;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    // Sections Function

    public function sections()
    {
        Session::put('page', 'view-sections');
        $sections = Section::get();

        return view('admin.sections.sections')->with(compact('sections'));
    }
}
