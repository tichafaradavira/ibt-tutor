<?php

namespace Modules\Communications\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Communications\Models\StudentMessage;
use Modules\Communications\Models\TutorMessage;
use Modules\Courses\Models\Course;
use Modules\Courses\Models\Lesson;
use Modules\Users\Models\User;

class TutorMessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TutorMessage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->word,
            'message' => $this->faker->paragraph,
        ];
    }

}

