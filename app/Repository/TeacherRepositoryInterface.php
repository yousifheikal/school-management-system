<?php

namespace App\Repository;

interface TeacherRepositoryInterface
{
    // getAllTeachers
    public function getAllTeachers();

    //getAllSpecializations
    public function getAllSpecializations();
    //getAllGender
    public function getAllGender();

    public function storeTeachers($request);

    public function editTeachers($id);

    public function updateTeachers($request);

    public function destroyTeachers($request);


}
