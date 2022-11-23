<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PackingSlipMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    public $fromMail = 'don@coloradoenvelope.com';
    
    public $fromName = 'Colorado Envelope';

    public $file = '';

    public function __construct( $data )
    {
        $this->data = $data;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail =  $this->view('packing.mail', $this->data )
                      ->from( $this->fromMail, $this->fromName )
                      ->subject( 'COLORADO ENVELOPE PACKING SLIP');


        if (!empty($this->file)) {
            $mail->attach($this->file);
        }

        return $mail;
    }
}
