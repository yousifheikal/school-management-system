<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Level extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = [
        'Level_Name',
        'Notes',
        ];

    protected $table = 'Levels';

    protected $fillable = [
      'Level_Name',
      'Notes',
    ];


    public $timestamps = true;

    public function classroom()
    {
        return $this->hasMany(Classroom::class, 'level_id');
    }

    public function Sections()
    {
        return $this->hasMany(Section::class, 'Level_id');
    }
}
