<?php

use Faker\Factory as Faker;

class OrdersTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();
        $customers = Customer::lists('id');
//        $arts = Art::lists('id');

        foreach (range(1, 5) as $index)
        {
            Order::create([
                'customer_id' => $faker->randomElement($customers)
//                'arts_id' => $faker->randomElement($arts)
            ]);
        }
    }

}