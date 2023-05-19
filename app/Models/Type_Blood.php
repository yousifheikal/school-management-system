<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Type_Blood extends Model
{
    use HasFactory;


    protected $table = 'type__bloods';

    protected $fillable = [
        'type_blood',
    ];

    public $timestamps = true;

}
