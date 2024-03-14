<?php
namespace Database\Factories;

use App\Models\Lection;
use App\Models\User;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

class LectionFactory extends Factory
{
    protected $model = Lection::class;

    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'instructor_id' => Instructor::all()->random()->id,
            'assistance' => $this->faker->boolean,
            'date' => $this->faker->date(),
            'schedule' => $this->faker->time('H:i'),
        ];
    }
}