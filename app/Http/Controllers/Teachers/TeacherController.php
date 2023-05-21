<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeachers;
use App\Models\Teacher;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $Teacher;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()///
    {
        //
        $Teachers = $this->Teacher->getAllTeachers();
        return view('pages.teachers.teacher', compact('Teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $specializations = $this->Teacher->getAllSpecializations();
        $genders = $this->Teacher->getAllGender();
        return view('pages.teachers.create', compact('specializations', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeachers $request)
    {
        //
        return $this->Teacher->storeTeachers($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $specializations = $this->Teacher->getAllSpecializations();
        $genders = $this->Teacher->getAllGender();
        $Teachers = $this->Teacher->editTeachers($id);

        return view('pages.teachers.edit', compact('Teachers', 'specializations', 'genders'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        return $this->Teacher->updateTeachers($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        return $this->Teacher->destroyTeachers($request);
    }
}
