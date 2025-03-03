<?php

namespace Database\Factories;

use App\Models\Cv;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class CvFactory extends Factory
{
    protected $model = Cv::class;

    public function definition(): array
    {
        return [
            'file'     => $this->faker->imageUrl(),
            'feedback' => $this->faker->sentence,
            'student_id' => Student::inRandomOrder()->first()->id ?? Student::factory()->create()->id,
        ];
    }
}
