<?php

use Faker\Factory as Faker;

class ArtsTableSeeder extends Seeder {

  public function run()
  {
    $faker = Faker::create();
    $artists = Artist::lists('id');

    foreach (range(1, 300) as $index)
    {
      Art::create([
          'title'     => $faker->word,
          'status'    => 'Available',
          'year'      => $faker->numberBetween($min = 1980, $max = 2015),
          'height'    => $faker->numberBetween($min = 1, $max = 200),
          'width'     => $faker->numberBetween($min = 1, $max = 200),
          'depth'     => $faker->numberBetween($min = 1, $max = 200),
          'category'  => $faker->randomElement($array = array('Painting', 'Photography', 'Drawing', 'Sculpture', 'Collage')),
          'subject'   => $faker->word,
          'medium'    => $faker->word,
          'price'     => $faker->numberBetween($min = 50, $max = 100000),
          'details'   => $faker->paragraph(8),
          'artist_id' => $faker->randomElement($artists),
          'views'     => 0
      ]);
    }
  }

}