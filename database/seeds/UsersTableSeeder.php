<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $admin = App\User::create([
            'name' => 'admin',
            'email' => 'admin@misijaweb.com',
            'password' => 'secret'
        ]);
        $admin->assignRole('admin');
        $admin->save();

        factory(App\User::class, 10)->create();

        App\User::where('name', '<>', 'admin')->get()->each(function($user) {
            $user->assignRole('user');
            $user->save();
        });
    }
}