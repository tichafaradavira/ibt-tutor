<?php

namespace Modules\Users\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Modules\Users\Models\Student;
use Modules\Users\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@ibttutor.com',
                'is_admin' => true
            ]);

        $tutor1 = User::factory()
            ->count(1)
            ->create([
                'email' => 'tutor1@gmail.com'
            ]);

        $student1 = Student::factory()
            ->count(1)
            ->create([
                'email' => 'student1@gmail.com'
            ]);

        $student2 = Student::factory()
            ->count(1)
            ->create([
                'email' => 'student2@gmail.com'
            ]);

        $tutor1->first()->students()->attach([$student1->first()->id,$student2->first()->id ]);


        $tutor2 = User::factory()
            ->count(1)
            ->create([
                'email' => 'tutor2@gmail.com'
            ]);

        $student3 = Student::factory()
            ->count(1)
            ->create([
                'email' => 'student3@gmail.com'
            ]);

        $student4 = Student::factory()
            ->count(1)
            ->create([
                'email' => 'student4@gmail.com'
            ]);
        $tutor2->first()->students()->attach([$student3->first()->id, $student4->first()->id]);



    }
}
