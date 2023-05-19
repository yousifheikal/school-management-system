<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Nationality extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = [
        'nationality',
    ];

    protected $table = 'nationalities';

    protected $fillable = ['nationality'];

    public $timestamps = true;
}
