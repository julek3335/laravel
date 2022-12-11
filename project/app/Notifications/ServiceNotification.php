<?php

namespace App\Notifications;

use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ServiceNotification extends Notification
{
    use Queueable;

    private Service $service;
    private Vehicle $vehicle;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Service $service,Vehicle $vehicle)
    {
        $this->service = $service;
        $this->vehicle = $vehicle;
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
            ->line('Zbliża się termin realizacji akcji serwisowej '.$this->service->name)
            ->line('Termin realizacji '.$this->service->next_time)
            ->line('Dla pojazdu o numerze rejestracyjnym '.$this->vehicle->license_plate);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {

    }
}
