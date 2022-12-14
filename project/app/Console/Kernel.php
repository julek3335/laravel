<?php

namespace App\Console;

use App\Console\Commands\InsuranceStateUpdateCommand;
use App\Console\Commands\ServiceActionReminderCommand;
use App\Console\Commands\ServiceActionStartCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command(InsuranceStateUpdateCommand::class,)->daily();
         $schedule->command(ServiceActionStartCommand::class,)->dailyAt('13:00');
         $schedule->command(ServiceActionReminderCommand::class,)->dailyAt('10:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
