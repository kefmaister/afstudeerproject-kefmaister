<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Studyfield;
use App\Models\Cv;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'user_id'       => User::factory(),
            'class'         => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'year'          => $this->faker->numberBetween(date('Y') - 5, date('Y')),
            'cv_id'         => null, // By default, the student may not have uploaded a CV.
            'studyfield_id' => Studyfield::factory()->forCoordinator(
                \App\Models\Coordinator::factory()->create()
            )->create()->id,
            
        ];
    }
}
