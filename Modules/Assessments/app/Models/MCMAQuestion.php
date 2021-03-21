<?php

namespace Modules\Assessments\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Assessments\Database\Factories\MCMAQuestionFactory;

/**
 * Class Assessment
 * @package Modules\Assessments\Models
 */
class MCMAQuestion extends  Model
{

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'assessments_mcma_questions';

    protected $fillable = [
        'question',
        'A',
        'B',
        'C',
        'D',
        'E',
        'F',
        'correct_answers',
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
        'E',
        'F',
        'correct_answers',
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
        'correct_answers' => 'array'
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
        return MCMAQuestionFactory::new();
    }

}
