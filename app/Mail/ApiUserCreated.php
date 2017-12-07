<?php

namespace App\Mail;

use App\ApiUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApiUserCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $apiUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ApiUser $apiUser)
    {
        $this->apiUser = $apiUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('no-reply@chileatiende.gob.cl')
            ->subject('API Key ChileAtiende')
            ->view('emails/api-user-created');
    }
}
