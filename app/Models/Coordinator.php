<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    use HasFactory;

    protected $table = 'coordinator';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'studyfield_id',
    ];

    // A coordinator belongs to one studyfield.
    public function studyfield()
    {
        return $this->belongsTo(Studyfield::class, 'studyfield_id');
    }

    // A coordinator can review many proposals.
    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'coordinator_id');
    }
}
