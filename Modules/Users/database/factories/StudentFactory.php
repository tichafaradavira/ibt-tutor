<?php
namespace Modules\Users\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Users\Models\Student;
use Modules\Users\Models\User;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->lastName,
            'password' =>  Hash::make('test12345'),
            'language' => $this->faker->languageCode,
            'phone_number' => $this->faker->phoneNumber,
            'email_verified_at' => Carbon::now(),
            'activated_at' => Carbon::now(),
            'remember_token' => Str::random(10),
        ];
    }
}

