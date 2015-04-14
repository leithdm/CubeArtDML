<?php

use Faker\Factory as Faker;

class ExhibitionTableSeeder extends Seeder {

  public function run()
  {
    $faker = Faker::create();

    foreach (range(1, 50) as $index)
    {
      Exhibition::create([
          'title'      => $faker->word,
          'date_event' => $faker->dateTimeBetween('+1 days', '+2 years'),
          'about'      => $faker->paragraph(1)
      ]);
    }
  }

}