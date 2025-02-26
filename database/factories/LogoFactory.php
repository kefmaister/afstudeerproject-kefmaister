<?php

namespace Database\Factories;

use App\Models\Logo;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogoFactory extends Factory
{
    protected $model = Logo::class;

    public function definition(): array
    {
        return [
            'path' => $this->faker->imageUrl(), 
        ];
    }
}
