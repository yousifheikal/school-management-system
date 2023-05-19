<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class My_Parent extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['Name_Father','Job_Father','Name_Mother','Job_Mother'];

    protected $table = 'my__parents';

    protected $guarded = [];


    public $timestamps = true;

    public function nationalities()
    {
        return $this->hasMany(Nationality::class);
    }

    public function religions()
    {
        return $this->hasMany(Religion::class);
    }

    public function type__bloods()
    {
        return $this->hasMany(Type_Blood::class);
    }
}
