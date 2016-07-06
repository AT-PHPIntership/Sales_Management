<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Supplier;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 5; $i++) {
            $supplier = Supplier::create([
                'name' => $faker->company,
                'description' => $faker->realText(255, 2),
                'created_at' => $faker->dateTimeThisYear($max = 'now')
            ]);
        }
    }
}
