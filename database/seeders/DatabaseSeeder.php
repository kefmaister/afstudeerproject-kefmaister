<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Coordinator;
use App\Models\Student;
use App\Models\Studyfield;
use App\Models\Proposal;
use App\Models\Company;
use App\Models\Mentor;
use App\Models\Cv;
use App\Models\Stage;
use App\Models\Logo;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create specific users for each role
        $coordinatorUser = User::create([
            'firstname'         => 'Coordinator',
            'lastname'          => 'User',
            'email'             => 'coordinator@mail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'remember_token'    => Str::random(10),
            'role'              => 'coordinator',
        ]);

        User::create([
            'firstname'         => 'Company',
            'lastname'          => 'User',
            'email'             => 'company@mail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'remember_token'    => Str::random(10),
            'role'              => 'company',
        ]);

        User::create([
            'firstname'         => 'Student',
            'lastname'          => 'User',
            'email'             => 'student@mail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'remember_token'    => Str::random(10),
            'role'              => 'student',
        ]);
        
        // Create additional users
        User::factory(10)->create();
        Mentor::factory(5)->create();
        Logo::factory(5)->create();

        // Create a coordinator record for the coordinator user.
        // This record is needed so that studyfields can reference a valid coordinator.
        $coordinator = Coordinator::factory()->create([
            'user_id' => $coordinatorUser->id,
        ]);

        // Seed studyfields using the forCoordinator state so that each studyfield gets a valid coordinator_id.
        $studyfields = Studyfield::factory(3)
            ->forCoordinator($coordinator)
            ->create();

        // Create additional records for other models.
        Cv::factory(10)->create();
        Proposal::factory(7)->create();
        Company::factory(5)->create();
        Stage::factory(8)->create();

        // Loop through all users with role 'student' and create corresponding student records if they don't already exist.
        $studentUsers = User::where('role', 'student')->get();
        foreach ($studentUsers as $user) {
            if (!$user->student) {
                // Use one of the seeded studyfields at random.
                $student = Student::factory()->create([
                    'user_id'       => $user->id,
                    'studyfield_id' => $studyfields->random()->id,
                    'class'         => 'A', // Default class
                    'year'          => now()->year,
                    'cv_id'         => null,
                ]);
            } else {
                $student = $user->student;
            }

            // Create a proposal for each student with a random status.
            Proposal::factory()->create([
                'student_id'     => $student->id,
                'coordinator_id' => $student->studyfield->coordinator_id,
                'status'         => collect(['draft', 'pending', 'approved', 'denied'])->random(),
                'feedback'       => 'This is a random feedback.',
            ]);
        }
    }
}
