<?php
namespace Modules\Courses\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Courses\Database\Factories\LessonPlanFactory;
use Modules\Courses\Models\Course;

class LessonPlan extends Model
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
        'study_material',
        'learning_aids',
        'activities',
        'lesson_outcomes',
        'lesson_at'
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
        'study_material',
        'learning_aids',
        'activities',
        'lesson_outcomes',
        'lesson_at',
        'course'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'objectives' => 'array',
        'lesson_outcomes' => 'array',
        'learning_aids' => 'array',
        'study_material' => 'array',
        'activities' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'lesson_at' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo( Course::class);
    }

    protected static function newFactory()
    {
        return LessonPlanFactory::new();
    }
}
