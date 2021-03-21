<?php

namespace Modules\Courses\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Courses\Models\Course;
use Modules\Courses\Models\Lesson;
use Modules\Courses\Models\LessonPlan;
use Modules\Users\Models\User;

class LessonPlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LessonPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'topic' => $this->faker->word,
            'objectives' => $this->getArrayField(5, 'sentence'),
            'study_material' => $this->getArrayField(5, 'sentence'),
            'activities' => $this->getArrayField(5, 'sentence'),
            'lesson_outcomes' =>$this->getArrayField(5, 'sentence'),
            'learning_aids' => $this->getArrayField(5, 'sentence'),
            'lesson_at' => Carbon::tomorrow(),
        ];
    }

    public function getArrayField($number, $type = 'word')
    {
        $items = [];


        for ($i = 0; $i < $number; $i++) {
            if ($type == 'word') {
                $item = $this->faker->word;
            } else if ($type == 'sentence') {
                $item = $this->faker->sentence;
            } else if ($type == 'paragraph') {
                $item = $this->faker->paragraph;

            }
            array_push($items, $item);
        }

        return $items;
    }
}

