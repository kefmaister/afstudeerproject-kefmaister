<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Studyfield;
use App\Models\Cv;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'firstname'     => $this->faker->firstName,
            'lastname'      => $this->faker->lastName,
            'password'      => bcrypt('password'),
            'email'         => $this->faker->unique()->safeEmail,
            'class'         => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'year'          => $this->faker->numberBetween(date('Y') - 5, date('Y')),
            'proposal_id'   => null, // By default, the student may not have submitted a proposal.
            'cv_id'         => Cv::factory()->create()->id, // Create a CV and assign its id.
            'studyfield_id' => Studyfield::inRandomOrder()->first()->id ?? Studyfield::factory()->create()->id,

        ];
    }
}
