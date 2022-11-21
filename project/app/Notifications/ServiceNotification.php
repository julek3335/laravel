<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServiceNotification extends Notification
{
    use Queueable;

    private $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $preferences = json_decode($notifiable->notification);
        $preferencesMail = $preferences->vehicle[0]->email;
        $preferencesDatabase = $preferences->vehicle[1]->database;
        $returnTable = [];
        if ($preferencesMail == true) {
            $returnTable[] = 'mail';
        }
        if ($preferencesDatabase == true) {
            $returnTable[] = 'database';
        }
        return $returnTable;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        // return [
        //     'message' => $this->message
        // ];
        $preferences = json_decode($notifiable->notification);
        return [
            'message' => $preferences->vehicle[0]->email
        ];
    }
}
