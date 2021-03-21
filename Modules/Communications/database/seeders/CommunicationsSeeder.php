<?php

namespace Modules\Communications\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Modules\Communications\Models\StudentMessage;
use Modules\Communications\Models\TutorMessage;
use Modules\Courses\Models\Course;
use Modules\Courses\Models\Lesson;
use Modules\Courses\Models\LessonPlan;
use Modules\Users\Database\Seeders\UsersSeeder;
use Modules\Users\Models\Student;
use Modules\Users\Models\User;

class CommunicationsSeeder extends Seeder
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
            ->get();

        $students = Student::query()->with(['tutors'])->get();

        foreach ($tutors as $tutor) {
            $messages = StudentMessage::factory()
                ->count(5)
                ->create([
                    'tutor_id' => $tutor->id
                ]);

            $student_ids = Arr::pluck($tutor->students, 'id');

            foreach ($messages as $message) {
                $message->reicevers()->sync(Arr::random($student_ids, 1));
            }
        }

        foreach ($students as $student) {
            $messages = TutorMessage::factory()
                ->count(5)
                ->create([
                    'tutor_id' => $student->tutors->first()->id,
                    'student_id' => $student->id
                ]);

        }


    }
}
