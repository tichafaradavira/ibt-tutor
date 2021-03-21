<?php

namespace Modules\Assessments\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Assessments\Models\FIQuestion;
use Modules\Assessments\Models\MCMAQuestion;
use Modules\Assessments\Models\MCSAQuestion;
use Modules\Courses\Models\Course;
use Modules\Courses\Models\Lesson;
use Modules\Users\Models\User;

class MCSAQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MCSAQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $options = ['A','B','C','D'];

        return [
            'question' => $this->faker->sentence,
            'A' => $this->faker->word,
            'B' => $this->faker->word,
            'C' => $this->faker->word,
            'D' => $this->faker->word,
            'correct_answer' => Arr::random($options),
            'comment' => $this->faker->paragraph,
            'points' => 2,
            'sequence' => 0,
        ];
    }

}

