<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ThanhToanDonHangMail extends Mailable
{
    use Queueable, SerializesModels;

    public $bien_1;
    
    public function __construct($bien_1)
    {
        $this->bien_1   = $bien_1;
    }

    public function build()
    {
        return $this->subject("Thanh toán đơn đặt hàng của DZFullStack 16")
                    ->view('mail_thanh_toan_don_hang', ['bien_1' => $this->bien_1]);
    }
}
