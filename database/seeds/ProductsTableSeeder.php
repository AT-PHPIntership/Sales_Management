<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 200; $i++) {
            $order = Product::create([
                'category_id' => rand(1, 15),
                'name' => $faker->word,
                'description' => $faker->text,
                'price' => rand(1, 100),
                'remaining_amount' => rand(0, 50),
                'is_on_sale' => rand(0, 10) > 0 ? 1 : 0,
                'created_at' => $faker->dateTimeThisYear($max = 'now')
            ]);
        }
    }
}
