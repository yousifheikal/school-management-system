<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = [
        'title',
    ];

    protected $table = 'fees';

    protected $guarded = [];


    public $timestamps = true;

    public function levels()
    {
        return $this->belongsTo(Level::class, 'Grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'Classroom_id');
    }

}
