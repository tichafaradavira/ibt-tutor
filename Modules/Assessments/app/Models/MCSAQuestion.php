<?php

namespace Modules\Assessments\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Assessments\Database\Factories\MCMAQuestionFactory;
use Modules\Assessments\Database\Factories\MCSAQuestionFactory;
use Modules\Courses\Models\Course;

/**
 * Class Assessment
 * @package Modules\Assessments\Models
 */
class MCSAQuestion extends  Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'assessments_mcsa_questions';

    protected $fillable = [
        'question',
        'A',
        'B',
        'C',
        'D',
        'correct_answer',
        'comment',
        'points'
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'id',
        'question',
        'A',
        'B',
        'C',
        'D',
        'correct_answer',
        'comment',
        'points',
        'sequence',
        'assessment'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public static function newFactory()
    {
        return MCSAQuestionFactory::new();
    }

}
