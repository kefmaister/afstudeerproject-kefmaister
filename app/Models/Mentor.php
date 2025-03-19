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
        'stage_id',
    ];

    // A mentor is bound to one company.
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function stage()
{
    return $this->belongsTo(Stage::class);
}


}
