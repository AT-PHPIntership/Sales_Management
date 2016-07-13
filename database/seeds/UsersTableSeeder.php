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

        $user = new User();
        $user->name = 'Super Admin';
        $user->email = 'superadmin@salesmanagement.com';
        $user->password = '123456';
        $user->roles = 2;
        $user->birthday = '1994-10-03';
        $user->gender = 0;
        $user->address = 'Asian Tech Inc';
        $user->phone_number = '0123456789';
        $user->save();

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@salesmanagement.com';
        $user->password = '123456';
        $user->roles = 1;
        $user->birthday = '1994-10-03';
        $user->gender = 0;
        $user->address = 'Asian Tech Inc';
        $user->phone_number = '0123456789';
        $user->save();

        $user = new User();
        $user->name = 'Quan Ly';
        $user->email = 'quanly@salesmanagement.com';
        $user->password = '123456';
        $user->roles = 0;
        $user->birthday = '1994-10-03';
        $user->gender = 0;
        $user->address = 'Asian Tech Inc';
        $user->phone_number = '0123456789';
        $user->save();

        for ($i=0; $i < 7; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => '12345678',
                'roles' => rand(0, 1),
                'birthday' => $faker->dateTimeBetween('-40 years', '-18 years'),
                'gender' => rand(0, 1),
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'remember_token' => str_random(60),
                'created_at' => $faker->dateTimeThisYear($max = 'now')
            ]);
        }
    }
}
