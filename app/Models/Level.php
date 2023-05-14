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

}
