<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        // If you want an "admin" role, update your users migration to allow it.
        // For now, we assign an allowed role (for example, "coordinator").
        User::create([
            'name'     => 'Coordinator',
            'email'    => 'coordinator@mail.com',
            'password' => Hash::make('password'),
            'role'     => 'coordinator',
        ]);

        User::create([
            'name'     => 'Company User',
            'email'    => 'company@mail.com',
            'password' => Hash::make('password'),
            'role'     => 'company',
        ]);

        User::create([
            'name'     => 'Student User',
            'email'    => 'student@mail.com',
            'password' => Hash::make('password'),
            'role'     => 'student',
        ]);

        // Create 10 additional users
        User::factory(10)->create();

        // It is often a good idea to create studyfields first if other models depend on them.
        Studyfield::factory(3)->create();

        // Create coordinators, students, etc.
        Coordinator::factory(5)->create();
        Student::factory(10)->create();
        Cv::factory(10)->create();
        Proposal::factory(7)->create();
        Company::factory(5)->create();
        Mentor::factory(5)->create();
        Stage::factory(8)->create();
        Logo::factory(5)->create();
    }
}
