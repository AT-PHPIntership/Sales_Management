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
        $user->email = 'superadmin@salesmanage.ment';
        $user->password = '12345678';
        $user->role_id = 1;
        $user->birthday = '03/10/1994';
        $user->gender = 0;
        $user->address = 'Asian Tech Inc';
        $user->phone_number = '0123456789';
        $user->save();

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@salesmanage.ment';
        $user->password = '12345678';
        $user->role_id = 2;
        $user->birthday = '03/10/1994';
        $user->gender = 0;
        $user->address = 'Asian Tech Inc';
        $user->phone_number = '0123456789';
        $user->save();

        for ($i=0; $i < 50; $i++) {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => '12345678',
                'role_id' => rand(2, 3),
                'birthday' => $faker->dateTimeBetween('-40 years', '-18 years')->format('d/m/Y'),
                'gender' => rand(0, 1),
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'remember_token' => str_random(60),
                'created_at' => $faker->dateTimeThisYear($max = 'now')
            ]);
        }
    }
}
