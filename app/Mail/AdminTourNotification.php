<?php

namespace App\Mail;

use App\Models\Package;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminTourNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $tour;
    public $totalAmount;
    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $tour, $totalAmount,$booking)
    {
        $this->user = $user;
        $this->tour = $tour;
        $this->totalAmount = $totalAmount;
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Tour Booking Notification')
            ->view('pages.emails.adminTourNotification');
    }
}
