<?php

use Illuminate\Database\Seeder;
use App\Models\Bill;
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

        $bills = Bill::all();
        foreach ($bills as $bill) {
            $amount = rand(1, 10);
            for ($j = 0; $j < $amount; $j++) {
                BillDetail::create([
                    'bill_id' => $bill->id,
                    'product_id' => rand(1, 200),
                    'amount' => rand(1, 10),
                    'cost' => 0,
                    'created_at' => $bill->created_at
                ]);
            }
        }
    }
}
