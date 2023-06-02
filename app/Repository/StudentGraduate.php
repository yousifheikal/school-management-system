<?php

namespace App\Repository;

use App\Models\Level;
use App\Models\Student;

class StudentGraduate implements StudentGraduateInterface
{
    public function AddGraduate()
    {
        $Grades = Level::all();
        return view('pages.students.graduate.create', compact('Grades'));
    }


    public function graduated($request)
    {
        try
        {
            $students = Student::where('Grade_id', $request->Grade_id)->get();

            foreach ($students as $student)
            {
                $ids = explode(',', $student->id);
                Student::whereIn('id', $ids)->delete();
            }

            toastr()->success(trans('message.success'));
            return redirect()->back();
        }
        catch (\Exception $e){

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function showGraduated()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.students.graduate.index', compact('students'));
    }

    public function restore($request)
    {
        Student::withTrashed()->where('id', $request->id)->restore();
        toastr()->warning(trans('message.restore'));
        return redirect()->back();
    }

    public function forceDelete($request)
    {
        Student::withTrashed()->where('id', $request->id)->forceDelete();
        toastr()->error(trans('message.delete'));
        return redirect()->back();
    }




}
