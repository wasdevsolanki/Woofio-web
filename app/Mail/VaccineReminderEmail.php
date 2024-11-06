<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Pet;
use App\Models\Vaccine;

class VaccineReminderEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public $pet;
    public $vaccines;
    public $sendStatus;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Pet $pet, $vaccines, $sendStatus)
    {
        $this->user = $user;
        $this->pet = $pet;
        $this->vaccines = $vaccines;
        $this->sendStatus = $sendStatus;
    }

    /**
     * Build the message.
     */
    public function build(): Mailable
    {
        $mail = $this->view('emails.vaccine_reminder')
            ->subject('Se aproxima la siguiente Vacuna para tu mascota');

        if ($this->sendStatus) {
            // Update the database if the email was successfully sent
            foreach ($this->vaccines as $vaccine) {
                $vaccine->update(['send_mail_status' => 1]);
            }
        }

        return $mail;
    }
}
