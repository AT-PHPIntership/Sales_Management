<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Order;

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

        for ($i=0; $i < 10; $i++) {
            $order = Order::create([
                'user_id' => rand(1, 10),
                'description' => $faker->realText($maxNbChars = 255, $indexSize = 2),
                'supplier_id' => rand(1, 5),
                'total_cost' => rand(1, 990) * 100000
            ]);
        }
    }
}
