<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyDenied extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $reason;

    public function __construct($company, $reason)
    {
        $this->company = $company;
        $this->reason = $reason;
    }

    public function build()
    {
        return $this->subject('Jouw bedrijf is geweigerd')
                    ->markdown('emails.company.denied');
    }
}
