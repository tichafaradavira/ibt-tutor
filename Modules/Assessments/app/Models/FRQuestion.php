<?php

namespace Modules\Assessments\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Assessments\Database\Factories\FRQuestionFactory;
use Modules\Courses\Models\Course;

/**
 * Class Assessment
 * @package Modules\Assessments\Models
 */
class FRQuestion extends  Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'assessments_free_response_questions';

    protected $fillable = [
        'question',
        'comment',
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'question',
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
        return FRQuestionFactory::new();
    }


}
