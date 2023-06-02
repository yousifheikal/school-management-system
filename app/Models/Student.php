<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasFactory, HasTranslations, SoftDeletes;

    public $translatable = ['name', 'Address'];

    protected $table = 'students';

    protected $guarded = [];


    public $timestamps = true;

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationalitie_id');
    }

    public function blood()
    {
        return $this->belongsTo(Type_Blood::class, 'blood_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'Grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'Classroom_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }


    public function parent()
    {
        return $this->belongsTo(My_Parent::class, 'parent_id');
    }


    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
