<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Religion extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = [
        'religion',
    ];

    protected $table = 'religions';

    protected $fillable = ['religion'];

    public $timestamps = true;}
