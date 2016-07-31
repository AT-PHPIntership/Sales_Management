<?php

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $orders = Order::all();
        foreach ($orders as $order) {
            $amount = rand(5, 30);
            for ($j = 0; $j < $amount; $j++) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => rand(1, 200),
                    'amount' => rand(20, 100),
                    'created_at' => $order->created_at,
                ]);
            }
        }
    }
}
