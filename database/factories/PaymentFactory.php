<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Payment;
use App\Models\Membership;
use App\Models\User;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'memberships_id' => Membership::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}