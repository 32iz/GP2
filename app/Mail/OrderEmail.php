<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subcategory, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subcategory, $user)
    {
        $this->subcategory = $subcategory;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /**
         * Replace the "from" field with your valid sender email address.
         * The "email-template" is the name of the file present inside
         * "resources/views" folder. If you don't have this file, then
         * create it.
         */
        return $this->from("azeez142111@gmail.com")->view('email-template');
    }
}