<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $fillable = [
        'company_name',
        'street',
        'streetNr',
        'town',
        'zip',
        'mentor_id',
        'accepted',
        'max_students',
        'student_amount',
        'logo_id',
        // 'stage_id', // If this is not used because stages are linked via company_id in Stage, consider removing it.
    ];

    // A company has a mentor.
    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id');
    }

    // A company may have a logo (this is optional).
    public function logo()
    {
        return $this->belongsTo(Logo::class, 'logo_id');
    }

    // A company can create many stages (internships) across different studyfields.
    public function stages()
    {
        return $this->hasMany(Stage::class, 'company_id');
    }
}
