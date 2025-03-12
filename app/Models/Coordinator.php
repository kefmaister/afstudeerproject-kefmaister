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
    ];

    // A coordinator belongs to one studyfield.
    public function studyfields()
    {
        return $this->hasMany(Studyfield::class);
    }

    // A coordinator can review many proposals.
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    // A coordinator belongs to a user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
