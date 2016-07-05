<?php

use Illuminate\Database\Seeder;
use App\Models\Bill;

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

        for ($i = 0; $i < 50; $i++) {
            $order = Bill::create([
                'user_id' => rand(1, 10),
                'description' => $faker->text,
                'total_cost' => rand(1, 15) * 100000,
                'created_at' => $faker->dateTimeThisYear($max = 'now'),
                'updated_at' => $faker->dateTimeThisYear($max = 'now')
            ]);
        }
    }
}
