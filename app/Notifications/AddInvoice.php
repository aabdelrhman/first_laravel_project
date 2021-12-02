<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\invoices;
use Illuminate\Support\Facades\Auth;

class AddInvoice extends Notification
{
    use Queueable;
    private $invoices ;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(invoices $invoices)
    {
        $this->invoices = $invoices;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable){
        return [
            'id' => $this->invoices->id,
            'title' => 'تم أضافة فاتورة جديدة بواسطة : ',
            'user' => Auth::user()->name,
        ];
    }
}
