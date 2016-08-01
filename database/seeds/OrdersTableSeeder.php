<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Order;
use App\Models\User;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // Orders in the past
        for ($i = 0; $i < 100; $i++) {
            Order::create([
                'user_id' => rand(1, 10),
                'description' => $faker->realText($maxNbChars = 255, $indexSize = 2),
                'supplier_id' => rand(1, 5),
                'total_cost' => rand(1, 990) * 100,
                'created_at' => $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now')
            ]);
        }

        // Orders today
        foreach (User::get() as $user) {
            $amount = rand(0, 10);
            for ($i = 0; $i < $amount; $i++) {
                Order::create([
                    'user_id' => $user->id,
                    'description' => $faker->text($maxNbChars = 255),
                    'supplier_id' => rand(1, 5),
                    'total_cost' => rand(1, 990) * 10,
                ]);
            }
        }
    }
}
