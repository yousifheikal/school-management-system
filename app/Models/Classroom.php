<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = [
        'classroom',
    ];

    protected $table = 'classrooms';


    protected $fillable = [
        'classroom',
        'level_id'
    ];

    public $timestamps = true;

    public function levels()
    {
       return $this->belongsTo(Level::class, 'level_id');
    }
}
