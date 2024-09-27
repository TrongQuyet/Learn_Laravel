<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\NewMessage;

class SendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-message';

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
        broadcast(new NewMessage('Hello, World!'));
    }
}
