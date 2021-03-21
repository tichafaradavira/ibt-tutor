<?php

namespace Modules\Assessments\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Assessments\Database\Factories\AssessmentFactory;
use Modules\Courses\Models\Course;

/**
 * Class Assessment
 * @package Modules\Assessments\Models
 */
class Assessment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'description',
        'topics',
    ];

    /**
     * @var string[]
     */
    protected $visible = [
        'label',
        'description',
        'topics',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i:s',
        'updated_at' => 'datetime',
        'topics' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function course()
    {
        return $this->belongsTo(Course::class);
    }

    function fill_in_questions()
    {
        return $this->hasMany(FIQuestion::class);
    }

    function mcsa_questions()
    {
        return $this->hasMany(MCSAQuestion::class);
    }


    function mcma_questions()
    {
        return $this->hasMany(MCMAQuestion::class);
    }

    function free_response_questions()
    {
        return $this->hasMany(FRQuestion::class);
    }

    public static function newFactory()
    {
        return AssessmentFactory::new();
    }


}
