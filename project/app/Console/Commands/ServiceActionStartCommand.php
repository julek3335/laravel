<?php

namespace App\Console\Commands;

use App\Models\Service;
use App\Notifications\ServiceTodayNotification;
use Illuminate\Console\Command;

class ServiceActionStartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'service-action:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activates service action';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $services = Service::whereDate('next_time', '=',now())->get();
        $services->load('vehicles');
        foreach ($services as $service){
            $this->changeDates($service);
            $cars = $service->vehicles;
            $cars->load('user');
            foreach ($cars as $car){
               $car->user->notify(new ServiceTodayNotification('FIX your car!! ASAP'));
            }
        }
        return 0;
    }

    private function changeDates(Service $service){

        $currentAction = new \DateTimeImmutable($service->next_time);
        $service->last_time = $currentAction;
        $interval = $service->interval;
        $service->next_time  = $currentAction->add(new \DateInterval('P'.$interval.'D'));
        $service->save();
    }
}
