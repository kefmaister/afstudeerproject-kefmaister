<?php

    namespace Database\Factories;

    use App\Models\Coordinator;
    use App\Models\Studyfield; // assuming a Coordinator needs a studyfield_id
    use Illuminate\Database\Eloquent\Factories\Factory;
    use Illuminate\Support\Facades\Hash;

    class CoordinatorFactory extends Factory
    {
        protected $model = Coordinator::class;

        public function definition()
        {
            return [
                'firstname'      => $this->faker->firstName,
                'lastname'       => $this->faker->lastName,
                'email'          => $this->faker->unique()->safeEmail,
                'password'       => Hash::make('password'),
                'studyfield_id'  => Studyfield::factory(), // creates a studyfield automatically
            ];
        }
    }

