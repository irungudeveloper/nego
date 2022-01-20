<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FailedNegotiation extends Notification
{
    use Queueable;

    // private $user_name
    // private $user_email
    // private $product_name
    // private $percentage_discount

    private $contact_data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contact_data)
    {
        //
        $this->contact_data = $contact_data;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Negotiation Failure Alert')
                    ->line('The negotiations with '.$this->contact_data['user_name'].' have failed. However, they wish to negotiate further with you')
                    ->line('The client wanted a '.$this->contact_data['percentage_discount'].'% discount on '.$this->contact_data['product_name'].' product available at your store.')
                    ->line('To proceed with negotiations, contact the client through '.$this->contact_data['user_email'])
                    ->line('You can also view pending negotiations through the link provided below')
                    ->action('Negotiaitons', url('/merchant/negotiate'))
                    ->line($this->contact_data['thank_you']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
