<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 10; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('12345678'),
                'roles' => rand(0, 1),
                'birthday' => $faker->dateTimeBetween('-40 years', '-18 years'),
                'gender' => rand(0, 1),
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'created_at' => $faker->dateTimeThisYear($max = 'now'),
                'remember_token' => str_random(10)
            ]);
        }
    }
}
