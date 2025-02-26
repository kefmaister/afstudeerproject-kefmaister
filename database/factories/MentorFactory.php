<?php

namespace Database\Factories;

use App\Models\Mentor;
use Illuminate\Database\Eloquent\Factories\Factory;

class MentorFactory extends Factory
{
    protected $model = Mentor::class;

    public function definition(): array
    {
        return [
            'firstname'  => $this->faker->firstname,
            'lastname'   => $this->faker->lastname,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
