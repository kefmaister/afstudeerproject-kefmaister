<?php

namespace Database\Factories;

use App\Models\Proposal;
use App\Models\Stage;
use App\Models\Coordinator;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProposalFactory extends Factory
{
    protected $model = Proposal::class;

    public function definition(): array
    {
        return [
            'stage_id'       => Stage::inRandomOrder()->first()->id ?? Stage::factory()->create()->id,
            'student_id'     => Student::inRandomOrder()->first()->id ?? Student::factory()->create()->id,
            'tasks'          => $this->faker->text,
            'motivation'     => $this->faker->paragraph,
            'status'         => $this->faker->RandomElement(['draft', 'pending', 'approved', 'denied']),
            'feedback'       => $this->faker->sentence,
            'coordinator_id' => Coordinator::inRandomOrder()->first()->id ?? Coordinator::factory()->create()->id,
        ];
    }
}
