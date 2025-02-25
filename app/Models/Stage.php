<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $table = 'stage';

    protected $fillable = [
        'company_id',
        'active',
        'logo_id',
        'title',
        'tasks',
        // 'student_id', // If this column is no longer used to indicate assignments, you might remove it.
        'studyfield_id',
    ];

    // A stage belongs to one company.
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // A stage uses a logo for display.
    public function logo()
    {
        return $this->belongsTo(Logo::class, 'logo_id');
    }

    // A stage is designated for a specific studyfield.
    public function studyfield()
    {
        return $this->belongsTo(Studyfield::class, 'studyfield_id');
    }

    // A stage can be referenced in many proposals.
    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'stage_id');
    }
}
