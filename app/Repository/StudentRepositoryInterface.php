<?php

namespace App\Repository;

use App\Models\Classroom;

interface StudentRepositoryInterface
{
    public function getAllStudents();

    public function getAllGender();

    public function getAllBlood();

    public function getAllNationalities();

    public function getAllReligions();

    public function getAllLevels();

    public function getAllParent();

    public function storeStudent($request);

    public function editStudent($id);

    public function updateStudent($request);

    public function destroy($request);

    public function show($id);

    public function upload_Attachment($request);

    public function Download_attachment($studentname, $filename);

    public function open_attachment($studentname, $filename);

    public function Delete_attachment($request);
    public function Get_classrooms($id);

    public function Get_Sections($id);








}
