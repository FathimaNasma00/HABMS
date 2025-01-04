<?php

namespace Database\Factories;

use App\Models\appointment;
use App\Models\payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class paymentFactory extends Factory
{
    protected $model = payment::class;

    public function definition(): array
    {
        return [
            'amount' => $this->faker->word(),
            'currency' => $this->faker->word(),
            'status' => $this->faker->word(),
            'method' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'appointment_id' => appointment::factory(),
        ];
    }
}
