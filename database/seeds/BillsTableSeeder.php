<?php

use Illuminate\Database\Seeder;
use App\Models\Bill;
use App\Models\User;

class BillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        // Bills are created in the past
        for ($i = 0; $i < 500; $i++) {
            Bill::create([
                'user_id' => rand(1, 10),
                'description' => $faker->text,
                'total_cost' => rand(1, 15) * 100,
                'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now')
            ]);
        }

        // Current day bills
        for ($i = 0; $i < 10; $i++) {
            foreach (User::get() as $user) {
                Bill::create([
                    'user_id' => $user->id,
                    'description' => $faker->text($maxNbChars = 255),
                    'total_cost' => rand(1, 99) * 100,
                ]);
            }
        }
    }
}
