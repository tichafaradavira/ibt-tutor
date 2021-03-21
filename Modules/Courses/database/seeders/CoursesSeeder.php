<?php

namespace Modules\Courses\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Modules\Courses\Models\Course;
use Modules\Courses\Models\Lesson;
use Modules\Courses\Models\LessonPlan;
use Modules\Users\Database\Seeders\UsersSeeder;
use Modules\Users\Models\Student;
use Modules\Users\Models\User;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $tutors = User::query()
            ->where('is_admin', false)
            ->with(['students'])
            ->get();


        foreach ($tutors as $tutor) {

            /**
             * Create courses for each tutor
             */
            $courses = Course::factory()
                ->count(3)
                ->create([
                    'tutor_id' => $tutor->id
                ]);

            /**
             * Add lessons for each of the courses
             */
            foreach ($courses as $course) {
                Lesson::factory()
                    ->count(5)
                    ->create([
                        'course_id' => $course->id
                    ]);
            }

            $students = $tutor->students->pluck('id');

            foreach ($courses as $course) {
                LessonPlan::factory()
                    ->count(7)
                    ->create([
                        'course_id' => $course->id
                    ]);

                $course->students()->sync($students);
            }
        }


    }
}
