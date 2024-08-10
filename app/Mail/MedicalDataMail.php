<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MedicalDataMail extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $data;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $data, $name)
    {
        $this->username = $username;
        $this->name = $name;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("{$this->username} medical data")
            ->view('emails.medical_data')
            ->with([
                'username' => $this->username,
                'data' => $this->data,
                'name' => $this->name,
            ]);
    }
}
