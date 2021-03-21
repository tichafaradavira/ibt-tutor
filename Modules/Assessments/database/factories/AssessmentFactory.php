<?php
namespace Modules\Assessments\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Assessments\Models\Assessment;
use Modules\Courses\Models\Course;
use Modules\Users\Models\User;

class AssessmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Assessment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'topics' => $this->getArrayField(5,'sentence'),
        ];
    }


    public function getArrayField($number, $type = 'word')
    {
        $items = [];
        if ($type == 'word') {
            $item = $this->faker->word;
        } else if ($type == 'sentence') {
            $item = $this->faker->sentence;
        } else if ($type == 'paragraph') {
            $item = $this->faker->paragraph;

        }

        for ($i = 0; $i < $number; $i++) {
            array_push($items, $item);
        }

        return $items;
    }
}

