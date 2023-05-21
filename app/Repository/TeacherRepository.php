<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{

    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function getAllSpecializations()
    {
        return Specialization::all();
    }

    public function getAllGender()
    {
        return Gender::all();
    }

    public function storeTeachers($request)
    {
        try
        {
            $Teacher = new Teacher();
            $Teacher->Email = $request->Email;
            $Teacher->Password = Hash::make($request->Password);
            $Teacher->Name = ['ar' => $request->Name_ar, 'en' => $request->Name_en];
            $Teacher->Specialization_id = $request->Specialization_id;
            $Teacher->Gender_id = $request->Gender_id;
            $Teacher->Joining_Date = $request->Joining_Date;
            $Teacher->Address = $request->Address;
            $Teacher->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('teachers.index');
        }
        catch (\Exception $e)
        {
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function editTeachers($id)
    {
        return Teacher::where('id', $id)->first();
    }

    public function updateTeachers($request)
    {
        try {
            $Teachers = Teacher::findOrFail($request->id);
            $Teachers->Email = $request->Email;
            $Teachers->Password =  Hash::make($request->Password);
            $Teachers->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Joining_Date = $request->Joining_Date;
            $Teachers->Address = $request->Address;
            $Teachers->save();

            toastr()->success(trans('message.update'));
            return redirect()->route('teachers.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroyTeachers($request)
    {
        Teacher::where('id', $request->id)->delete();
        toastr()->error(trans('message.delete'));
        return redirect()->back();
    }


}
