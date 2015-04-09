<?php

use Faker\Factory as Faker;

class CarouselTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();
        $arts = Art::lists('id');

        foreach (range(1, 3) as $index)
        {
            Carousel::create([
                'arts_id'   => $faker->randomElement($arts)
            ]);
        }
    }

}