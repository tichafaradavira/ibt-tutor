<?php

namespace Modules\Students\Repositories;


use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Modules\Assessments\Models\AssessmentResponse;
use Modules\Courses\Models\Lesson;
use Modules\Users\Emails\AddStudentVerifyEmail;
use Modules\Users\Models\Student;

class StudentRepository
{
    public static function browse($browse_inputs)
    {
        $user = auth()->guard('api')->user();

        $query = Student::query()
            ->join('student_tutor', 'students.id', '=', 'student_tutor.student_id')
            ->where('student_tutor.user_id', $user->id);

        $students = $query->paginate(15);

        return $students;
    }


    function add($data)
    {
        $user = auth()->guard('api')->user();
        $students = [];

        foreach ($data as $student_data) {
            $temporary_password = Str::random(8);
            $student_data['password'] = Hash::make($temporary_password);
            $student_data['dob'] = Carbon::now();
            $student_data['Student_type'] = 'tutor';
            $student = Student::create($student_data);

            if ($student->save()) {
                array_push($students, $student);
                $user->students()->attach($student->id);

                Mail::to($student->email)
                    ->send(new AddStudentVerifyEmail($student, $temporary_password));

            }
        }


        return $students;


    }

    function edit($data, $student)
    {
        $saved = Student::where('id', $student->id)
            ->update($data);

        if ($saved) {
            return $student;
        } else {
            return false;
        }


    }

    function read($id)
    {
        $user = auth()->guard('api')->user();

        $student = Student::query()
            ->join('student_tutor', 'students.id', '=', 'student_tutor.student_id')
            ->where('student_tutor.user_id', $user->id)
            ->where('students.id', $id)
            ->first();

        if ($student) {
            return $student;
        }

    }


    function delete($student)
    {
        $user = auth()->guard('api')->user();
        $user->students()->detach($student->id);

        if ($student) {
            return $student;
        }

    }


    function courseProgress($student, $course)
    {
        $completed_lessons = DB::table('lessons')
            ->join('student_lessons_completed','lessons.id','=','student_lessons_completed.lesson_id')
            ->where('student_lessons_completed.student_id', $student->id)
            ->where("lessons.course_id", $course->id)
            ->select('lessons.id','lessons.topic', 'student_lessons_completed.completed_at')
            ->paginate(15);
        return  $completed_lessons;

    }

    function assessmentProgress($student, $course)
    {

        $assessment_responses = AssessmentResponse::query()
            ->where('student_id', $student->id)
            ->where("course_id", $course->id)
            ->with(['assessment'])
            ->paginate(15);

        return  $assessment_responses;

    }


}
