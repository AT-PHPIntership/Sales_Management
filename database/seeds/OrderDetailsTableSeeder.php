<?php

use Illuminate\Database\Seeder;
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

        for ($i = 1; $i <= 10 ; $i++) {
            $amount = rand(1, 10);
            for ($j = 0; $j < $amount; $j++) {
                OrderDetail::create([
                    'order_id' => $i,
                    'product_id' => rand(1, 200),
                    'amount' => rand(20, 100),
                    'created_at' => $faker->dateTimeThisYear($max = 'now'),
                    'updated_at' => $faker->dateTimeThisYear($max = 'now')
                ]);
            }
        }
    }
}
