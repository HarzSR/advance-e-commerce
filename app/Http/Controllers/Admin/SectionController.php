<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use Session;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    // View Sections Function

    public function viewSections()
    {
        Session::put('page', 'view-sections');

        $sections = Section::get();

        return view('admin.sections.view_sections')->with(compact('sections'));
    }

    // Update Section Status Function

    public function updateSectionStatus(Request $request)
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

            Section::where('id', $data['section_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'section_id' => $data['section_id']]);
        }
    }
}
