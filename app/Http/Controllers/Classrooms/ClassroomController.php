<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Level;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::all();
        $levels = Level::all();
        return view('pages.classrooms.classroom', compact('classrooms', 'levels'));
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
        $List_Classes = $request->List_Classes;

        try {

            foreach ($List_Classes as $List_Class)
            {
                $My_Classes = new Classroom();
                $My_Classes->classroom = ['en' => $List_Class['Name_class_en'],'ar' => $List_Class['Name']];
                $My_Classes->level_id = $List_Class['level_id'];
                $My_Classes->save();
            }
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
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
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

            $classrooms = Classroom::find($request->id);
            $classrooms->update([

                'classroom' => ['ar' => $request->Name_ar, 'en' => $request->Name_enn],
                'level_id' => $request->level_id,
            ]);
            toastr()->success(trans('messages.update'));
            return redirect()->back();
        }

        catch
        (\Exception $e) {
            toastr()->error(trans('messages.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        //
        Classroom::destroy($request->id);
        toastr()->success(trans('message.delete'));
        return redirect()->back();
    }

    public function delete_selected(Request $request)
    {

        //
        $class_selected = explode(',' , $request->delete_all_id);
        Classroom::whereIn('id', $class_selected)->Delete();
        toastr()->error(trans('message.delete_selected'));
        return redirect()->back();
    }

    public function filter(Request $request)
    {
        $details = Classroom::select('*')->where('level_id', $request->level_id)->get();
        $classrooms = Classroom::all();
        $levels = Level::all();
        return view('pages.classrooms.classroom', compact('classrooms', 'levels'))->withDetails($details);
    }
}
