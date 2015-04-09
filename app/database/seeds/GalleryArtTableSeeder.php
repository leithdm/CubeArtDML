<?php

use Faker\Factory as Faker;

class GalleryArtTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();
        $artists = Artist::lists('id');

        foreach (range(1, 12) as $index)
        {
            GalleryArt::create([
                'gallery_id' => $index,
                'arts_id'   => $faker->randomElement($artists)
            ]);
        }
    }

}