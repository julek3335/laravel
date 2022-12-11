<?php

namespace App\Console\Commands;

use App\Enums\ServiceEventStatusEnum;
use App\Models\Service;
use App\Models\ServiceEvent;
use App\Notifications\ServiceTodayNotification;
use Illuminate\Console\Command;
use Throwable;

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
        $services = Service::whereDate('next_time', '<=', now())->get();
        $services->load('vehicles');
        foreach ($services as $service) {
            $currentServiceDate = $service->next_time;
            $this->changeDates($service);
            $cars = $service->vehicles()->get();
            $cars->load('user');
            foreach ($cars as $car) {
                ServiceEvent::create(
                    [
                        'vehicle_id' => $car->id,
                        'service_id' => $service->id,
                        'event_date' => $currentServiceDate,
                        'status' => ServiceEventStatusEnum::WAITING
                    ]
                );
                try {
                    $car->user->notify(new ServiceTodayNotification('FIX your car!! ASAP'));
                } catch (Throwable $exception){
                    $this->alert($exception->getMessage());
                }
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
