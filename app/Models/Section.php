<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = [
        'Name_Section',
    ];

    protected $table = 'sections';

    protected $guarded = [];

    public $timestamps = true;

    public function levels()
    {
        return $this->belongsTo(Level::class, 'Level_id');
    }

    public function classroms()
    {
        return $this->belongsTo(Classroom::class, 'Class_id');
    }


}
