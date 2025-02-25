<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    use HasFactory;

    protected $table = 'logo';

    protected $fillable = [
        'path',
        // Add other logo-related fields as needed
    ];

    // Optionally, if each company has a unique logo:
    public function company()
    {
        return $this->hasOne(Company::class, 'logo_id');
    }

    // A logo can be used in many stages.
    public function stages()
    {
        return $this->hasMany(Stage::class, 'logo_id');
    }
}
