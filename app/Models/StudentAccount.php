<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    use HasFactory;


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function levels()
    {
        return $this->belongsTo(Level::class, 'Grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'Classroom_id');
    }
}
