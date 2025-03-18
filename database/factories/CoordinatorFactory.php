<?php

    namespace Database\Factories;

    use App\Models\Coordinator;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Facades\Hash;

    class CoordinatorFactory extends Factory
    {
        protected $model = Coordinator::class;

        public function definition()
        {
            return [
                'user_id'        => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            ];
        }
    }

