<?php
namespace Modules\Courses\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Courses\Models\Course;
use Modules\Users\Models\User;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'summary' => $this->faker->sentence,
            'field_of_study' => $this->faker->word,
            'description' => $this->faker->paragraph,
        ];
    }
}

