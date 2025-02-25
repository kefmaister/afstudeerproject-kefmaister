<?php

namespace Database\Factories;

use App\Models\Stage;
use App\Models\Company;
use App\Models\Logo;
use App\Models\Studyfield;
use Illuminate\Database\Eloquent\Factories\Factory;

class StageFactory extends Factory
{
    protected $model = Stage::class;

    public function definition(): array
    {
        return [
            'company_id'    => Company::factory(),
            'active'        => $this->faker->boolean,
            'logo_id'       => Logo::factory(),
            'title'         => $this->faker->sentence,
            'tasks'         => $this->faker->paragraph,
            'studyfield_id' => Studyfield::factory(),
        ];
    }
}
