<?php

namespace App\Console\Commands;

use App\Models\Service;
use App\Notifications\ServiceTodayNotification;
use App\Notifications\ServiceNotification;
use DateInterval;
use DateTimeImmutable;
use Illuminate\Console\Command;

class ServiceActionReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service-action:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind car users about service';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $date = new DateTimeImmutable(now());
        $this->notify($date->add( new DateInterval('P7D')));
        $this->notify($date->add( new DateInterval('P14D')));
        return 0;
    }

    private function notify(DateTimeImmutable $date){
        $services = Service::whereDate('next_time', '=',$date)->get();
        $services->load('vehicles');
        foreach ($services as $service){
            $cars = $service->vehicles;
            $cars->load('user');
            foreach ($cars as $car){
                $car->user->notify(new ServiceNotification($service,$car));
            }
        }
    }

}
