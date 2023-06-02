<?php

namespace App\Repository;

interface StudentGraduateInterface
{

    public function AddGraduate();

    public function graduated($request);

    public function showGraduated();

    public function restore($request);

    public function forceDelete($request);

}
