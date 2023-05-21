<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Specialization extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = [
        'Name',
    ];

    protected $table = 'specializations';

    protected $fillable = ['Name'];

    public $timestamps = true;
}
