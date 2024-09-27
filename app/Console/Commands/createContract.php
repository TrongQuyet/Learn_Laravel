<?php

namespace App\Console\Commands;

use App\Models\Contract;
use Illuminate\Console\Command;

class createContract extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-contract';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Contract::create(['name' => 'Traveling to Europe', 'user_id' => 1]);
    }
}
