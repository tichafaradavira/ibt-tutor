<?php

namespace Modules\Courses\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Modules\Courses\Database\Factories\CourseFactory;
use Modules\Courses\Database\Factories\LessonFactory;
use Modules\Courses\Models\Course;

class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'topic',
        'objectives',
        'content',
        'sequence_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'topic',
        'objectives',
        'content',
        'sequence_id',
        'course'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'objectives' => 'array',
        'content' => 'array',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    public function getCompletedAttribute(){
        $student = auth()->guard('api-students')->user();

        if($student){
            $result = DB::table('student_lessons_completed')
                ->where('student_id', $student->id)
                ->where('lesson_id', $this->id)
                ->first();
            return (!!$result);
        }
        return null;
    }

    protected static function newFactory()
    {
        return LessonFactory::new();
    }

}
