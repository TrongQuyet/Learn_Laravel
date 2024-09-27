<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\NotifySendEmailOneMinute;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendEmailAfterOneMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email-after-one-minute';

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
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new NotifySendEmailOneMinute());
        }
    }
}
