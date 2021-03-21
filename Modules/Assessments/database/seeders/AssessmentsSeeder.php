<?php

namespace Modules\Assessments\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Modules\Assessments\Models\Assessment;
use Modules\Assessments\Models\FIQuestion;
use Modules\Assessments\Models\FRQuestion;
use Modules\Assessments\Models\MCMAQuestion;
use Modules\Assessments\Models\MCSAQuestion;
use Modules\Courses\Database\Seeders\CoursesSeeder;
use Modules\Courses\Models\Course;
use Modules\Courses\Models\Lesson;
use Modules\Courses\Models\LessonPlan;
use Modules\Users\Models\User;

class AssessmentsSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Since seeeders are for testing, it does not make sense to include assessment responses
         * because they are better tested while interacting with the system
         */
        $this->call(CoursesSeeder::class);

        $courses = Course::query()->get();

        foreach ($courses as $course) {

            /**
             * Create courses for each tutor
             */
            $assessments = Assessment::factory()
                ->count(3)
                ->create([
                    'course_id' => $course->id
                ]);

            /**
             * Add lessons for each of the courses
             */
            foreach ($assessments as $assessment) {
                MCSAQuestion::factory()
                    ->count(2)
                    ->create([
                        'assessment_id' => $assessment->id
                    ]);

                MCMAQuestion::factory()
                    ->count(2)
                    ->create([
                        'assessment_id' => $assessment->id
                    ]);

                FIQuestion::factory()
                    ->count(2)
                    ->create([
                        'assessment_id' => $assessment->id
                    ]);

                FRQuestion::factory()
                    ->count(2)
                    ->create([
                        'assessment_id' => $assessment->id
                    ]);
            }

        }


    }
}
