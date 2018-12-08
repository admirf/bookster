<?php

use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Transaction::class, 10)->create();

        \App\Transaction::all()->each(function ($item, $key) {
            $item->books()->attach(\App\Book::inRandomOrder()->first()->id);
        });
    }
}
