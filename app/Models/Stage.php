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
        'title',
        'tasks',
        'studyfield_id',
        'reason'
    ];

    // A stage belongs to one company.
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // A stage is designated for a specific studyfield.
    public function studyfield()
    {
        return $this->belongsTo(Studyfield::class);
    }

    // A stage can be referenced in many proposals.
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function mentor()
{
    return $this->hasOne(Mentor::class);
}

}
