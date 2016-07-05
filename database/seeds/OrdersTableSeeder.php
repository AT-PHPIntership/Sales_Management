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
                'description' => $faker->text,
                'supplier_id' => rand(1, 5),
                'total_cost' => rand(1, 3000),
                'created_at' => $faker->dateTimeThisYear($max = 'now'),
                'updated_at' => $faker->dateTimeThisYear($max = 'now')
            ]);
        }
    }
}
