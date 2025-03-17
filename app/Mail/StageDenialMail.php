<?php
namespace App\Mail;

use App\Models\Stage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StageDenialMail extends Mailable
{
    use Queueable, SerializesModels;

    public Stage $stage;
    public string $reason;

    /**
     * Create a new message instance.
     */
    public function __construct(Stage $stage, string $reason)
    {
        $this->stage = $stage;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Stage afgekeurd')
            ->view('emails.stages.denied')
            ->with([
                'stage' => $this->stage,
                'reason' => $this->reason,
            ]);
    }
}
