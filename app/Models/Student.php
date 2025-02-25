<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $fillable = [
        'firstname',
        'lastname',
        'password',
        'email',
        'class',
        'studyfield_id',
        'year',
        'proposal_id',
        'cv_id',
    ];

    // A student is associated with one proposal.
    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }

    // A student belongs to one studyfield.
    public function studyfield()
    {
        return $this->belongsTo(Studyfield::class, 'studyfield_id');
    }

    // A student belongs to one CV, since cv_id is stored on the student.
    public function cv()
    {
        return $this->belongsTo(Cv::class, 'cv_id');
    }
}
