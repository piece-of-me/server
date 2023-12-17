<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as FakerFactory;

class UserSeeder extends Seeder
{
    protected const PASSWORD = 'password_password';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();
        for ($i = 0; $i < 5; $i++) {
            User::create([
                'login' => 'login' . ($i + 1),
                'password' => Hash::make(static::PASSWORD),
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
                'birthdate' => $faker->dateTimeThisDecade()->format('Y-m-d'),
                'register_at' => $faker->dateTimeThisMonth()->format('Y-m-d'),
            ]);
        }
    }
}
