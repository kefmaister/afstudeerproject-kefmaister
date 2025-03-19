<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

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
        $magicUrl = URL::temporarySignedRoute(
            'magic.login',  // name of the route
            now()->addMinutes(30),  // valid for 30 minutes
            ['user' => $this->company->user->id]  // route parameter
        );

        return $this->subject('Jouw bedrijf is goedgekeurd!')
                    ->markdown('emails.company.approved', ['magicUrl' => $magicUrl]);
    }

}
