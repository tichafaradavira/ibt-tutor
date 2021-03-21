<?php
namespace Modules\Users\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Communications\Models\StudentMessage;
use Modules\Courses\Models\Course;
use Modules\Courses\Models\Lesson;
use Modules\Users\Database\Factories\StudentFactory;

class Student extends Authenticatable
{
    use Notifiable,HasApiTokens;
    use HasFactory;

    protected  $table = "students";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name' ,
        'last_name' ,
        'email',
        'language',
        'phone_number',
        'password',
        'recovery_token',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'first_name' ,
        'last_name' ,
        'email',
        'language',
        'phone_number',
        'tutors',
        'recovery_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The roles that belong to the user.
     */

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses', 'student_id', 'course_id');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'student_lessons_completed', 'student_id', 'lesson_id')
            ->withPivot('completed_at');
    }

    public function messages()
    {
        return $this->belongsToMany(StudentMessage::class, 'communications_message_students', 'student_id', 'message_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tutors()
    {
        return $this->belongsToMany(User::class, 'student_tutor', 'student_id', 'user_id');
    }


    public function getCompletedLessonsAttribute(){
        return $this->lessons()->pluck('lesson_id')->toArray();
    }

    protected static function newFactory()
    {
        return StudentFactory::new();
    }

}
