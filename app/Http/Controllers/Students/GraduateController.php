<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Repository\StudentGraduateInterface;
use Illuminate\Http\Request;

class GraduateController extends Controller
{
    //
    protected $graduate;

    public function __construct(StudentGraduateInterface $graduate)
    {
        $this->graduate = $graduate;
    }

    public function AddGraduate()
    {
        return $this->graduate->AddGraduate();
    }

    public function graduated(Request $request)
    {
        return $this->graduate->graduated($request);
    }

    public function showGraduated()
    {
        return $this->graduate->showGraduated();
    }

    public function restore(Request $request)
    {
        return $this->graduate->restore($request);
    }

    public function forceDelete(Request $request)
    {
        return $this->graduate->forceDelete($request);
    }
}
