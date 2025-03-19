<?php

namespace Database\Factories;

use App\Models\Stage;
use App\Models\Company;
use App\Models\Logo;
use App\Models\Studyfield;
use App\Models\Coordinator;
use Illuminate\Database\Eloquent\Factories\Factory;

class StageFactory extends Factory
{
    protected $model = Stage::class;

    public function definition(): array
    {
        return [
            'company_id'    => Company::inRandomOrder()->first()->id ?? Company::factory()->create()->id,
            'active'        => $this->faker->tinyInteger,
            'title'         => $this->faker->sentence,
            'tasks'         => $this->faker->paragraph,
            'studyfield_id' => Studyfield::inRandomOrder()->first()->id ?? Studyfield::factory()->create()->id,
        ];
    }
}
