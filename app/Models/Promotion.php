<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'promotions';

    public $timestamps = true;

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function f_grade()
    {
        return $this->belongsTo(Level::class, 'from_grade');
    }


    public function f_classroom()
    {
        return $this->belongsTo(Classroom::class, 'from_classroom');
    }


    public function f_section()
    {
        return $this->belongsTo(Section::class, 'from_section');
    }

    public function t_grade()
    {
        return $this->belongsTo(Level::class, 'to_grade');
    }


    public function t_classroom()
    {
        return $this->belongsTo(Classroom::class, 'to_classroom');
    }


    public function t_section()
    {
        return $this->belongsTo(Section::class, 'to_section');
    }

}
