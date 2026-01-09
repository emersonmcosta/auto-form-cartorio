<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyService extends Mailable  implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject;
    public $destination;
    public $template;
    public $params;
    public $file;

    public function __construct($subject,$destination,$template,$params,$file)
    {
        $this->subject     = $subject;
        $this->destination = $destination;
        $this->template    = $template;
        $this->params        = $params;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $anexo = new File($this->file);
        return $this->view($this->template,$this->params)
        ->attach($anexo->getRealPath());
    }

    public function sendMail() {
        $this->build();
        return Mail::to($this->destination)->queue($this);
    }

    public function sendMailJob(){
        Mail::queue($this->template, $this->params, function ($message){
            $message->from(env("MAIL_USERNAME"), env("APP_TITLE")); 
            $message->to($this->destination)->subject($this->subject);
      });
      
    }
}
