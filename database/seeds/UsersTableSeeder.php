<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@misijaweb.com',
            'password' => 'secret'
        ]);

        factory(User::class, 10)->create();
    }
}