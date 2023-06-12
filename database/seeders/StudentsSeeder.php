<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Level;
use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use App\Models\Type_Blood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('students')->delete();
        $students = new Student();
        $students->name = ['ar' => 'رؤي', 'en' => 'Roaa'];
        $students->email = 'roaahani@yahoo.com';
        $students->password = Hash::make('01004121711');
        $students->gender_id = 1;
        $students->nationalitie_id = Nationality::latest('created_at')->first();
        $students->blood_id = Type_Blood::latest('created_at')->first();
        $students->Date_Birth = date('1995-01-01');
        $students->Grade_id = Level::latest('created_at')->first();
        $students->Classroom_id = Classroom::latest('created_at')->first();
        $students->section_id = Section::latest('created_at')->first();
        $students->parent_id = My_Parent::latest('created_at')->first();
        $students->academic_year ='2021';
        $students->save();
    }
}
