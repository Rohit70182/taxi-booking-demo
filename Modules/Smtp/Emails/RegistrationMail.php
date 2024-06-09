<?php

namespace Modules\Smtp\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $view;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $view)
    {
         $this->data = $data;        
         $this->view = $view;        

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view("smtp::emailqueues.$this->view",['data' => $this->data]);
    }
}