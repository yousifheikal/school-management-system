<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Level;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Grades = Level::with(['Sections'])->get();
        $List_Grades = Level::all();
        return view('pages.sections.sections', compact('Grades', 'List_Grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $section = new Section();
            $section->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $section->Status = 1;
            $section->Level_id = $request->Grade_id;
            $section->Class_id = $request->Class_id;
            $section->save();
            toastr()->success(trans('message.success'));
            return redirect()->back();

        }
        catch (\Exception $e)
        {
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        try {
            $section = Section::findOrFail($request->id);

            $section->Name_Section = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
            $section->Level_id = $request->Grade_id;
            $section->Class_id = $request->Class_id;
            if (isset($request->Status))
            {
                $section->Status = 1;
            }
            else
            {
                $section->Status = 2;
            }
            $section->save();
            toastr()->success(trans('message.update'));
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        Section::destroy($request->id);
        toastr()->warning(trans('message.delete'));
        return redirect()->back();
    }

    public function getClasses($id)
    {
        //
        $classes = Classroom::where('level_id', $id)->pluck('classroom', 'id');
        return json_encode($classes);
    }

}
