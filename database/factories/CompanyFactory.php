<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Mentor;
use App\Models\Logo;
use App\Models\User;
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
            'accepted'       => $this->faker->randomElement([-1, 0, 1, 2]),
            'max_students'   => $this->faker->numberBetween(1, 100),
            'student_amount' => $this->faker->numberBetween(1, 100),
            'logo'           => $this->faker->imageUrl(),
            'user_id'        => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'company_vat'    => $this->faker->regexify('[A-Z]{2}[0-9]{8,12}'),
            'reason'         => '',
        ];
    }
}
