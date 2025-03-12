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

    public function forCoordinator($coordinator)
{
    return $this->state(function () use ($coordinator) {
        return [
            'coordinator_id' => is_numeric($coordinator) ? $coordinator : $coordinator->id,
        ];
    });
}

    
}
