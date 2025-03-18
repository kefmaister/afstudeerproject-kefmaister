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

    // 🔧 Create a Coordinator model for every user with role = coordinator
    $coordinatorUsers = User::where('role', 'coordinator')->get();
    foreach ($coordinatorUsers as $user) {
        Coordinator::firstOrCreate(['user_id' => $user->id]);
    }

    // Create 3 studyfields, each linked to a random coordinator
    $coordinators = Coordinator::all();
    $studyfields = collect();
    foreach (range(1, 3) as $i) {
        $studyfields->push(
            Studyfield::factory()->create([
                'coordinator_id' => $coordinators->random()->id,
            ])
        );
    }

    // Continue seeding
    Company::factory(5)->create();
    Mentor::factory(5)->create();
    Stage::factory(8)->create();
    Cv::factory(10)->create();

    // Create student records for each student user
    $studentUsers = User::where('role', 'student')->get();
    foreach ($studentUsers as $user) {
        $student = Student::firstOrCreate([
            'user_id' => $user->id
        ], [
            'studyfield_id' => $studyfields->random()->id,
            'class' => 'A',
            'year' => now()->year,
        ]);

        // Create proposals for students
        Proposal::factory()->create([
            'student_id'     => $student->id,
            'stage_id'       => Stage::inRandomOrder()->first()->id,
            'coordinator_id' => $student->studyfield->coordinator_id,
            'status'         => collect(['draft', 'pending', 'approved', 'denied'])->random(),
            'feedback'       => 'This is a random feedback.',
        ]);
    }
}

}
