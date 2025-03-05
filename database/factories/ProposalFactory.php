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
            'stage_id'       => Stage::factory(),
            'student_id'     => Student::factory(),
            'tasks'          => $this->faker->text,
            'motivation'     => $this->faker->paragraph,
            'status'         => $this->faker->numberBetween(0, 1), // e.g. 0 = pending, 1 = approved/denied
            'feedback'       => $this->faker->sentence,
            'coordinator_id' => \App\Models\Coordinator::factory(),
        ];
    }
}
