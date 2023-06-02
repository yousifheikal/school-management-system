<?php

namespace App\Repository;


use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Image;
use App\Models\Level;
use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\Section;
use App\Models\Student;
use App\Models\Type_Blood;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{

    public function getAllStudents()
    {
        $students =  Student::all();
        return view('pages.students.index', compact('students'));
    }

    public function getAllGender()
    {
        return Gender::all();
    }

    public function getAllBlood()
    {
        return Type_Blood::all();
    }

    public function getAllNationalities()
    {
        return Nationality::all();
    }

    public function getAllReligions()
    {
        return Religion::all();
    }

    public function getAllLevels()
    {
        return Level::all();
    }

    public function getAllParent()
    {
        return My_Parent::all();
    }

    public function storeStudent($request)
    {
        DB::beginTransaction();

        try {
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();

            // insert img
            if($request->hasfile('photos'))
            {
                foreach($request->file('photos') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('student_attachment/'.$students->name, $file->getClientOriginalName(),'upload_attachments');

                    // insert in image_table
                    $images= new Image();
                    $images->filename=$name;
                    $images->imageable_id= $students->id;
                    $images->imageable_type = Student::class;
                    $images->save();
                }
            }

            // all good - insert in database all tables
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('Students.create');
        }

        catch (\Exception $e){
            DB::rollback();
            // something went wrong
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function editStudent($id)
    {
        $students = Student::where('id', $id)->first();
        $Genders = Gender::all();
        $nationals = Nationality::all();
        $bloods = Type_Blood::all();
        $Grades = Level::all();
        $parents = My_Parent::all();
        return view('pages.students.edit', compact('students', 'Genders', 'nationals', 'bloods', 'Grades', 'parents'));
    }

    public function updateStudent($request)
    {
        try {
            $students = Student::where('id', $request->id)->first();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('Students.index');
        }

        catch (\Exception $e){
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        Student::withTrashed()->where('id', $request->id)->forceDelete();
        toastr()->error(trans('message.delete'));
        return redirect()->back();
    }


    public function show($id)
    {
        $Student =  Student::where('id', $id)->first();
        $image = Image::where('imageable_id', $id)->first();
        return view('pages.students.show', compact('Student', 'image'));
    }

    public function upload_Attachment($request)
    {
        // insert img
        if($request->hasfile('photos'))
        {
            foreach($request->file('photos') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->storeAs('student_attachment/'.$request->student_name, $file->getClientOriginalName(),'upload_attachments');

                // insert in image_table
                $images= new Image();
                $images->filename=$name;
                $images->imageable_id= $request->student_id;
                $images->imageable_type = Student::class;
                $images->save();
            }
            toastr()->success(trans('message.success'));
            return redirect()->back();
        }
    }

    public function Download_attachment($studentname, $filename)
    {
        $file = Storage::disk('student_attachments')->download($studentname.'/'.$filename);
        return $file;
    }

    public function open_attachment($studentname, $filename)
    {
        $dir="img/student_attachment";
        $file = public_path($dir.'/'.$studentname.'/'.$filename);
        return response()->file($file);
    }

    public function Delete_attachment($request)
    {
        Storage::disk('student_attachments')->delete($request->student_name.'/'.$request->filename);
        Image::where('id', $request->id)->delete();
        toastr()->warning(trans('message.delete'));
        return redirect()->back();
    }

    public function Get_classrooms($id)
    {
        $classes = Classroom::where('level_id', $id)->pluck('classroom', 'id');
        return json_encode($classes);
    }

    public function Get_Sections($id)
    {
        $classes = Section::where('Class_id', $id)->pluck('Name_Section', 'id');
        return json_encode($classes);
    }

}
