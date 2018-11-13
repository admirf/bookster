<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        App\User::create([
            'name' => 'Admin',
            'email' => 'admin@misijaweb.com',
            'password' => 'secret'
        ]);

        factory(App\User::class, 10)->create();
    }
}