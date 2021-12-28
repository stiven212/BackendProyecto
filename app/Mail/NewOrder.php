<?php

namespace App\Mail;

use App\Models\BuyDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $buyDetail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BuyDetail $buyDetail)
    {
        //
        $this->buyDetail= $buyDetail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.details.new')->attach('storage/laravel.pdf', [
            'as' => 'laravel_doc.pdf',
            'mime' => 'application/pdf',])
;
    }
}
