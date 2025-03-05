<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    use HasFactory;

    protected $table = 'coordinator';

    protected $fillable = [
        'user_id',
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

    // A coordinator belongs to a user.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
