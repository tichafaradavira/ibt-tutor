<?php

namespace Modules\Courses\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Courses\Database\Factories\CourseFactory;
use Modules\Users\Models\Student;
use Modules\Users\Models\User;

class Course extends  Model
{

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'summary',
        'description',
        'field_of_study',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'name',
        'summary',
        'description',
        'field_of_study',
        'tutor',
        'students'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_courses', 'course_id', 'student_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    protected static function newFactory()
    {
        return CourseFactory::new();
    }


}
