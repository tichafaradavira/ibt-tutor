<?php

namespace Modules\Courses\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Courses\Models\Course;
use Modules\Courses\Models\Lesson;
use Modules\Users\Models\User;

class LessonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lesson::class;

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
            'content' => $this->getArrayField(40, 'paragraph'),
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
                $item = [
                    "type" => 'text',
                    "content" => $this->faker->paragraph
                ];
            }
            array_push($items, $item);
        }

        return $items;
    }
}

