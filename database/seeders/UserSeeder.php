<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Factory::create();

        for ($index = 0; $index <= 10; $index++) {
            $plainPassword = "password123";
            $email = $faker->unique()->email();

            DB::table('users')->insert([
                'first_name' => 'default' . $index,
                'last_name' => 'default' . $index,
                'email' => $email,
                'cellphone' => substr($faker->numerify('###########'), 0, 12),
                'password' => Hash::make($plainPassword), // Hashear la contraseña
                'state_id' => rand(1,4),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        }
    }
}
