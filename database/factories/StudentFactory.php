<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Studyfield;
use App\Models\Cv;
use App\Models\Coordinator;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'user_id'       => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'class'         => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'year'          => $this->faker->numberBetween(date('Y') - 5, date('Y')),
            'studyfield_id' => Studyfield::inRandomOrder()->first()->id ?? Studyfield::factory()->create()->id,

        ];
    }
}
