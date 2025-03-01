<?php

use Faker\Factory as Faker;

class EmployeeTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index)
        {
            Employee::create([
                'title'       => 'Mr.',
                'first_name'  => $faker->firstName,
                'middle_name' => $faker->firstName,
                'second_name' => $faker->lastName,
                'address1'    => $faker->streetName,
                'address2'    => $faker->streetName,
                'address3'    => $faker->streetName,
                'city'        => $faker->city,
                'country'     => $faker->country,
                'email'       => $faker->email,
                'phone1'      => $faker->phoneNumber,
                'phone2'      => $faker->phoneNumber
            ]);
        }
    }

}