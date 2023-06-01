<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudent;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Student;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $Student;


    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
//        $student = Student::find(1);
//        dd($student);
        return $this->Student->getAllStudents();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $Genders = $this->Student->getAllGender();
        $nationals = $this->Student->getAllNationalities();
        $bloods = $this->Student->getAllBlood();
        $my_classes = $this->Student->getAllLevels();
        $parents = $this->Student->getAllParent();

        return view('pages.students.add', compact('Genders', 'nationals', 'bloods', 'my_classes', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudent $request)
    {
        //
        return $this->Student->storeStudent($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        return $this->Student->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        return $this->Student->editStudent($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        return $this->Student->updateStudent($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        return $this->Student->destroy($request);
    }

    public function upload_Attachment(Request $request)
    {
        return $this->Student->upload_Attachment($request);
    }

    public function Download_attachment($studentname, $filename)
    {
        return $this->Student->Download_attachment($studentname, $filename);
    }

    public function open_attachment($studentname, $filename)
    {
        return $this->Student->open_attachment($studentname, $filename);
    }

    public function Delete_attachment(Request $request)
    {
        return $this->Student->Delete_attachment($request);
    }

    public function Get_classrooms($id)
    {
        return $this->Student->Get_classrooms($id);
    }

    public function Get_Sections($id)
    {
        return $this->Student->Get_Sections($id);
    }
}
