<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = [
        'name',
    ];

    protected $table = 'subjects';

    protected $guarded = [];

    public $timestamps = true;

    public function levels()
    {
        return $this->belongsTo(Level::class, 'grade_id');
    }

    public function classrooms()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    // علاقة ميني تو ميني مع جدول المدرسين والجدول المشترك بينهم teacher_section
    public function teachers()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
