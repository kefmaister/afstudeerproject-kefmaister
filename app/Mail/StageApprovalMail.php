<?php

namespace App\Mail;

use App\Models\Stage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StageApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $stage;

    /**
     * Create a new message instance.
     */
    public function __construct(Stage $stage)
    {
        $this->stage = $stage;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Stage goedgekeurd')
                    ->view('emails.stages.approved');
    }
}
