<?php

namespace Modules\Assessments\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Assessments\Models\FIQuestion;
use Modules\Courses\Models\Course;
use Modules\Courses\Models\Lesson;
use Modules\Users\Models\User;

class FIQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FIQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->sentence,
            'correct_answer' => $this->faker->word,
            'comment' => $this->faker->paragraph,
            'points' => 2,
            'sequence' => 0,
        ];
    }

}

