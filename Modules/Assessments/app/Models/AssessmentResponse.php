<?php

namespace Modules\Assessments\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Courses\Models\Course;
use Modules\Users\Models\Student;

/**
 * Class Assessment
 * @package Modules\Assessments\Models
 */
class AssessmentResponse extends Model
{
    protected $table = 'student_assessment_responses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_response',
        'assessment_result',
        'asssessment_at',
        'submitted_at',
        'saved_at',
        'attempted_at',


    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'id',
        'student_response',
        'assessment_result',
        'student',
        'assessment',
        'asssessment_at',
        'submitted_at',
        'saved_at',
        'attempted_at',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'asssessed_at' => 'datetime',// when did the tutor mark the assignment
        'submitted_at' => 'datetime',// when did the student finish the assignment
        'saved_at' => 'datetime', // if the student did not finish the assement, when did he save progress
        'student_response' => 'array',
        'assessment_result' => 'array',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function student()
    {
        return $this->belongsTo(Student::class);
    }

}
