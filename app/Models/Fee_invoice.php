<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fee_invoice extends Model
{
    use HasFactory;

    protected $table = 'fee_invoices';

    protected $guarded = [];

    public $timestamps = true;

    public function fees()
    {
        return $this->belongsTo(Fee::class, 'fee_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function levels()
    {
        return $this->belongsTo(Level::class, 'Grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'Classroom_id');
    }

}
