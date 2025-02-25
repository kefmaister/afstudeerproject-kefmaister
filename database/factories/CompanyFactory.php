<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Mentor;
use App\Models\Logo;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'company_name'   => $this->faker->company,
            'street'         => $this->faker->streetName,
            'streetNr'       => $this->faker->numberBetween(1, 300),
            'town'           => $this->faker->city,
            'zip'            => $this->faker->postcode,
            'mentor_id'      => Mentor::factory(),
            'accepted'       => $this->faker->boolean,
            'max_students'   => $this->faker->numberBetween(1, 100),
            'student_amount' => $this->faker->numberBetween(0, 100),
            'logo_id'        => Logo::factory(),
        ];
    }
}
