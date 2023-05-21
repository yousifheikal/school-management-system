<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['Name', 'Address'];

    protected $table = 'teachers';

    protected $guarded = [];


    public $timestamps = true;

    public function specializations()
    {
        return $this->belongsTo(Specialization::class, 'Specialization_id');
    }

    public function genders()
    {
        return $this->belongsTo(Gender::class, 'Gender_id');
    }

    // علاقة ميني تو ميني مع جدول السكاشن والجدول المشترك بينهم teacher_section

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'teacher_section');
    }


}
