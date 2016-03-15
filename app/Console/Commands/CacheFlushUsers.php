<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CacheFlushUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:flush:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear User Cache';

    /**
     * Create a new command instance.
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
        $cachedUsers = \Redis::keys('*user*');

        if (count($cachedUsers) > 0) {
            foreach ($cachedUsers as $key) {
                $this->info('Deleting Key '.$key);
                \Redis::del($key);
            }
        }
    }
}
