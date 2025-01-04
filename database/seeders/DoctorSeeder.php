<?php

namespace Database\Seeders;

use App\Models\appointment;
use App\Models\Availability;
use App\Models\doctor;
use App\Models\payment;
use App\Models\specialty;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0 ; $i < 10; $i++) {

            $speciality = specialty::inRandomOrder()->first();
            $user = User::factory()->create([
                'role' => User::ROLE_DOCTOR,
                'specialtie_id' => $speciality->id,
                'mobile_number' => '0741111'.fake()->numberBetween(400, 999),
                'amount' => fake()->numberBetween(1000, 5000)
            ]);

            $availability = [
                [
                    'user_id' => $user->id,
                    'day' => Availability::monday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ],
                [
                    'user_id' => $user->id,
                    'day' =>Availability::tuesday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ],
                [
                    'user_id' => $user->id,
                    'day' =>Availability::wednesday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ],
                [
                    'user_id' => $user->id,
                    'day' =>Availability::thursday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ],
                [
                    'user_id' => $user->id,
                    'day' =>Availability::friday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ],
                [
                    'user_id' => $user->id,
                    'day' =>Availability::saturday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ],
                [
                    'user_id' => $user->id,
                    'day' =>Availability::sunday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ]
            ];

            foreach ($availability as $item) {
                Availability::updateOrInsert(
                    [
                        'user_id' =>  $item['user_id'],
                        'day' => $item['day']
                    ],
                    [
                        'start_time' => $item['start_time'],
                        'end_time' => $item['end_time'],
                    ]
                );
            }

            $ap = appointment::updateOrCreate([
                'doctor_id' => $user->id,
                'name' => fake()->name,
                'email' => fake()->email,
                'age' => fake()->randomElement([25, 30, 45, 60, 20, 18]),
                'mobile_number' => '0711111'.fake()->numberBetween(200, 999),
                'date' => Carbon::now()->addWeeks(fake()->randomDigit())->toDateString(),
                'time' => fake()->time,
                'amount' => $user->amount,
                'status' => 'active'
            ]);

            payment::create([
               'appointment_id' => $ap->id,
               'amount' => $user->amount,
               'card' => '3432*************',
               'currency' => 'LKR',
               'status' => 'Success',
               'method' => 'CARD',
            ]);
        }

        for ($i = 0 ; $i < 10; $i++) {

            $speciality = specialty::inRandomOrder()->first();
            $user = User::factory()->create([
                'role' => User::ROLE_DOCTOR,
                'specialtie_id' => $speciality->id,
                'mobile_number' => '0751111'.fake()->numberBetween(500, 999),
                'amount' => fake()->numberBetween(1000, 5000)
            ]);

            $availability = [
                [
                    'user_id' => $user->id,
                    'day' => Availability::monday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ],
                [
                    'user_id' => $user->id,
                    'day' =>Availability::tuesday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ],
                [
                    'user_id' => $user->id,
                    'day' =>Availability::wednesday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ],
                [
                    'user_id' => $user->id,
                    'day' =>Availability::thursday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ],
                [
                    'user_id' => $user->id,
                    'day' =>Availability::friday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ],
                [
                    'user_id' => $user->id,
                    'day' =>Availability::saturday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ],
                [
                    'user_id' => $user->id,
                    'day' =>Availability::sunday,
                    'start_time' => '08:00:00',
                    'end_time' => '05:00:00',
                ]
            ];

            foreach ($availability as $item) {
                Availability::updateOrInsert(
                    [
                        'user_id' =>  $item['user_id'],
                        'day' => $item['day']
                    ],
                    [
                        'start_time' => $item['start_time'],
                        'end_time' => $item['end_time'],
                    ]
                );
            }

            $pUser = User::factory()->create();

            $ap = appointment::updateOrCreate([
                'doctor_id' => $user->id,
                'user_id' => $pUser->id,
                'name' => $pUser->name,
                'email' => $pUser->email,
                'age' => fake()->randomElement([25, 30, 45, 60, 20, 18]),
                'mobile_number' => '0721111'.fake()->numberBetween(300, 999),
                'date' => Carbon::now()->addWeeks(fake()->randomDigit())->toDateString(),
                'time' => fake()->time,
                'amount' => $user->amount,
                'status' => 'active'
            ]);

            payment::create([
                'appointment_id' => $ap->id,
                'amount' => $user->amount,
                'card' => '3432*************',
                'currency' => 'LKR',
                'status' => 'Success',
                'method' => 'CARD',
            ]);
        }
    }
}
