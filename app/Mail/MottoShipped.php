<?php

namespace App\Mail;

use App\Models\Motto;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MottoShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    private $motto;

    public function __construct(Motto $motto)
    {
        $this->motto = $motto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject = '【开发部】'.$this->motto->user->name.'的每日一图 👍';

        return $this->view('email.motto', ['motto' => $this->motto]);
    }
}
