<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $fillable = [
        'user_id',
        'class',
        'studyfield_id',
        'year',
    ];

    // A student belongs to one studyfield.
    public function studyfield()
    {
        return $this->belongsTo(Studyfield::class);
    }

    public function proposal()
{
    return $this->hasOne(Proposal::class);
}


    // A student belongs to one CV, since cv_id is stored on the student.
    public function cv()
    {
        return $this->hasOne(Cv::class);
    }

    // A student belongs to a user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
