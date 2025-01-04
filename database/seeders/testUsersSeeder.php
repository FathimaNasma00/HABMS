<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class testUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin user',
                'email' => 'admin@mail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('secret'),
                'role' => User::ROLE_ADMIN,
                'mobile_number' => '0711111111',
            ],
            [
                'name' => 'Doctor user',
                'email' => 'doctor@mail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('secret'),
                'role' => User::ROLE_DOCTOR,
                'specialtie_id' => 1,
                'mobile_number' => '0711111112',
                'amount' => fake()->numberBetween(1000, 5000)
            ],
            [
                'name' => 'Patient user',
                'email' => 'patient@mail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('secret'),
                'role' => User::ROLE_PATIENT,
                'mobile_number' => '0711111113',
            ]
        ];

        foreach ($users as $user) {
            User::updateOrInsert(
                ['email' => $user['email']], // Match on email
                $user // Update or insert these values
            );
        }
    }
}
