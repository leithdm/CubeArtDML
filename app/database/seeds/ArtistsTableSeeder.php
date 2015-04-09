<?php

use Faker\Factory as Faker;

class ArtistsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 250) as $index)
        {
            Artist::create([
                'title'       => 'Mr.',
                'first_name'  => $faker->firstName,
                'middle_name'  => $faker->firstName,
                'second_name' => $faker->lastName,
                'address1'    => $faker->streetName,
                'address2'    => $faker->streetName,
                'address3'    => $faker->streetName,
                'city'        => $faker->city,
                'country'     => $faker->country,
                'about'       => $faker->paragraph(15),
                'quote'       => $faker->paragraph(1),
                'email'       => $faker->email,
                'phone1'       => $faker->phoneNumber,
                'phone2'       => $faker->phoneNumber,
            ]);
        }
    }

}