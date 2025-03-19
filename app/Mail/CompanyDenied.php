<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class CompanyDenied extends Mailable
{
    use Queueable, SerializesModels;

    public $company;
    public $reason;

    public function __construct($company, $reason)
    {
        $this->company = $company;
        $this->reason = $reason;

        $this->magicUrl = URL::temporarySignedRoute(
            'magic.login',
            now()->addMinutes(30),
            ['user' => $company->user->id]
        );

        // Get the first coordinator (or select based on logic)
        $this->coordinator = \App\Models\Coordinator::with('user')->first();
    }

    public function build()
    {
        return $this->subject('Bedrijf geweigerd')
                    ->markdown('emails.company.denied')
                    ->with([
                        'company' => $this->company,
                        'reason' => $this->reason,
                        'magicUrl' => $this->magicUrl,
                        'coordinator' => $this->coordinator,
                    ]);
    }
}
