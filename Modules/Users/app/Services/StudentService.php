<?php

namespace Modules\Users\Services;


use Modules\Courses\Repositories\CourseRepository;
use Modules\Students\Repositories\StudentRepository;
use Modules\Users\Models\Student;

class StudentService
{
    protected $repository;
    protected $user;

    function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
        $this->user = auth()->guard('api')->user();
    }

    function browse($inputs)
    {
        $students = $this->repository->browse($inputs);

        return $students;
    }


    function add($inputs)
    {
        $students = $this->repository->add($inputs);

        if ($students) {
            return $students;
        } else {
            return false;
        }
    }


    function edit($inputs, $id)
    {
        $student = $this->getStudent($id);

        if ($student) {
            $student = $this->repository->edit($inputs, $student);
            return true;
        } else {
            return false;
        }

    }

    function read($id)
    {
        if ($id) {
            $student = $this->repository->read($id);
            return $student;
        } else {
            return false;
        }
    }


    function delete($id)
    {
        $student = $this->getStudent($id);

        if ($student) {
            $student = $this->repository->delete($student);
            return $student;
        } else {
            return false;
        }
    }


    function courseProgress($student, $course)
    {
        $course_repository = resolve(CourseRepository::class);
        $student = $this->getStudent($student);
        $course = $course_repository->getPlainCourse($course);

        if ($student) {
            $progress = $this->repository->courseProgress($student, $course);
            return $progress;
        } else {
            return false;
        }
    }

    function assessmentProgress($student, $course)
    {
        $course_repository = resolve(CourseRepository::class);
        $student = $this->getStudent($student);
        $course = $course_repository->getPlainCourse($course);

        if ($student) {
            $progress = $this->repository->assessmentProgress($student, $course);
            return $progress;
        } else {
            return false;
        }
    }

    function getStudent($id)
    {
        $student = Student::query()
            ->join('student_tutor', 'students.id', '=', 'student_tutor.student_id')
            ->where('student_tutor.user_id', $this->user->id)
            ->where('students.id', $id)
            ->first();

        return $student;
    }

}
