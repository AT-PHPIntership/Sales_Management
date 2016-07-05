<?php

use Illuminate\Database\Seeder;
use App\Models\BillDetail;

class BillsDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 50 ; $i++) {
            $amount = rand(1, 10);
            for ($j = 0; $j < $amount; $j++) {
                BillDetail::create([
                    'bill_id' => $i,
                    'product_id' => rand(1, 200),
                    'amount' => rand(1, 5),
                    'cost' => 0,
                    'created_at' => $faker->dateTimeThisYear($max = 'now'),
                    'updated_at' => $faker->dateTimeThisYear($max = 'now')
                ]);
            }
        }
    }
}
