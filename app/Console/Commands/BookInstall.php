<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BookInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'book:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets up a fresh installation of bookster';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('optimize');
        $this->call('migrate:refresh');
        $this->call('db:seed');
        $this->call('key:generate');
        $this->call('jwt:secret');
    }
}
