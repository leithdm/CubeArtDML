<?php

use Faker\Factory as Faker;

class GalleryTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();
        $arts = Art::lists('id');

        foreach (range(1, 12) as $index)
        {
            Gallery::create([
                'arts_id'   => $faker->randomElement($arts)
            ]);
        }
    }

}