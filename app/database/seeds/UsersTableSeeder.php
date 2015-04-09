<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

    public function run()
    {
            User::create([
                'username'  => 'admin',
                'password' => Hash::make('admin'),
                'email' => 'admin@admin.com'
            ]);
    }

}