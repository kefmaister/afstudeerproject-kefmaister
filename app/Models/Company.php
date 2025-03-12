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
        'logo',
        'user_id',
    ];

    // A company has a mentor.
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
    // A company can create many stages (internships) across different studyfields.
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    // A company belongs to a user.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
