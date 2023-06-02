<?php

namespace App\Repository;

use App\Models\Level;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentPromotion implements StudentPromotionInterface
{

    public function index()
    {
        $Grades = Level::all();
        return view('pages.students.promotion.index', compact('Grades'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {

            $students = Student::where('Grade_id', $request->Grade_id)->where('Classroom_id', $request->Classroom_id)->where('section_id', $request->section_id)->where('academic_year', $request->academic_year)->get();

            if ($students->count() < 1) {
                toastr()->warning(' error_promotions | لاتوجدط بيانات في جدول الطلاب');
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }

            // update in table student
            foreach ($students as $student) {

                $ids = explode(',', $student->id);
                // conditions for more student
                student::whereIn('id', $ids)
                    ->update([
                        'Grade_id' => $request->Grade_id_new,
                        'Classroom_id' => $request->Classroom_id_new,
                        'section_id' => $request->section_id_new,
                        'academic_year' => $request->academic_year_new,
                    ]);

                // insert in to promotions
                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->Grade_id,
                    'from_Classroom' => $request->Classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->Grade_id_new,
                    'to_Classroom' => $request->Classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new,
                ]);

            }

            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function create()
    {
        $promotions = Promotion::all();
        return view('pages.students.promotion.management', compact('promotions'));
    }

public function destroy($request, $id)
{
    //

    DB::beginTransaction();

    try {
// التراجع عن الكل
        if($request->page_id ==1) {

            $Promotions = Promotion::all();
            foreach ($Promotions as $Promotion) {

                //التحديث في جدول الطلاب
                $ids = explode(',', $Promotion->student_id);
                Student::whereIn('id', $ids)
                    ->update([
                        'Grade_id' => $Promotion->from_grade,
                        'Classroom_id' => $Promotion->from_classroom,
                        'section_id' => $Promotion->from_section,
                        'academic_year' => $Promotion->academic_year,
                    ]);

                //حذف جدول الترقيات
                Promotion::truncate();

            }
            DB::commit();
            toastr()->error(trans('messages.delete'));
            return redirect()->back();
        }
        else
        {
            $promotion = Promotion::findorfail($id);

            Student::where('id', $promotion->student_id)->update([
                'Grade_id' => $promotion->from_grade,
                'Classroom_id' => $promotion->from_classroom,
                'section_id' => $promotion->from_section,
                'academic_year' => $promotion->academic_year,
            ]);

            Promotion::destroy($id);
            DB::commit();
            toastr()->error(trans('message.delete'));
            return redirect()->back();
        }

    } catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}





}

