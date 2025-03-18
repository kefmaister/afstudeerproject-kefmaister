<?php
namespace Database\Factories;

use App\Models\Studyfield;
use App\Models\Coordinator;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudyfieldFactory extends Factory
{
    protected $model = Studyfield::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'coordinator_id' => Coordinator::factory(), // default fallback
        ];
    }

    public function forCoordinator(Coordinator $coordinator)
    {
        return $this->state(function () use ($coordinator) {
            return [
                'coordinator_id' => $coordinator->id,
            ];
        });
    }
}
