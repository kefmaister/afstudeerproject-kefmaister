<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studyfield extends Model
{
    use HasFactory;

    protected $table = 'studyfield';

    protected $fillable = [
        'name',
        'coordinator_id',
    ];

    // A studyfield has one coordinator.
    public function coordinator()
    {
        return $this->belongsTo(Coordinator::class, 'coordinator_id');
    }

    // A studyfield can have many students.
    public function students()
    {
        return $this->hasMany(Student::class, 'studyfield_id');
    }

    // A studyfield can be associated with many stages (internships).
    public function stages()
    {
        return $this->hasMany(Stage::class, 'studyfield_id');
    }
}
