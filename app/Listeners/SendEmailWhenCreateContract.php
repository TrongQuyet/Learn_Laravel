<?php

namespace App\Listeners;

use App\Events\ContractCreate;
use App\Jobs\sendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailWhenCreateContract
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ContractCreate $event): void
    {
        // $emailJob = new sendMail();
        // dispatch($emailJob);
    }
}
