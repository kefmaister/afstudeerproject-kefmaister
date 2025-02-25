<?php

namespace Database\Factories;

use App\Models\Studyfield;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudyfieldFactory extends Factory
{
    protected $model = Studyfield::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->word,        ];
    }
}
