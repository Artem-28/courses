<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class SendEmailService
{
    private string $fromEmail;
    private string $appName;

    public function __construct()
    {
        $this->fromEmail = env('MAIL_USERNAME');
        $this->appName = env('APP_NAME');
    }


    public function sendConfirmMessage(string $toEmail, string $code)
    {
        $toName = '';
        $data = array('code' => $code);
        Mail::send('emails.confirm', $data, function ($message) use ($toName, $toEmail) {

            $message->to($toEmail, $toName)
                ->subject('Подтверждение действия на ' . $this->appName);

            $message->from( $this->fromEmail,  $this->appName);
        });
    }
}
