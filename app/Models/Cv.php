<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory;

    protected $table = 'cv';

    protected $fillable = [
        'file',
        'feedback',
        'student_id',
    ];

    // A CV belongs to one student.
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
