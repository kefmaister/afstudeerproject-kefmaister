<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $fillable = [
        'user_id',
        'company_name',
        'street',
        'streetNr',
        'town',
        'zip',
        'country',
        'website',
        'phone',           // Add phone if needed
        'employee_count',  // Add employee_count if needed
        'logo',
        'accepted',
        'max_students',
        'student_amount',
        'company_vat',
        'reason'
    ];

    // A company has a mentor.
    public function mentor()
    {
        return $this->hasOne(Mentor::class);
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
