<?php

namespace App\Console\Commands;

use App\Mail\TestingEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTestingEmail extends Command
{
    protected $signature = 'app:send-testing-email';

    protected $description = 'Send testing email';

    public function handle()
    {
        $toRecipient = config('mail.to.support');

        Mail::to($toRecipient)->send(new TestingEmail());

        return self::SUCCESS;
    }
}
