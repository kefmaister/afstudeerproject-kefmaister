<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    protected $table = 'mentor';

    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'email',
    ];

    // A mentor is bound to one company.
    public function company()
    {
        return $this->hasOne(Company::class, 'mentor_id');
    }
}
