<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $company;

    public function __construct($company)
    {
        $this->company = $company;
    }

    public function build()
    {
        return $this->subject('Jouw bedrijf is goedgekeurd!')
                    ->markdown('emails.company.approved');
    }
}
