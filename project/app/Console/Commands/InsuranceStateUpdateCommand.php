<?php

namespace App\Console\Commands;

use App\Enums\InsuranceStatusEnum;
use App\Models\Insurance;
use Illuminate\Console\Command;

class InsuranceStateUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insurance:state-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change insurance status if time is passed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $insurances = Insurance::whereDate('expiration_date', '<',now())->where('status', InsuranceStatusEnum::ACTIVE)->get();
        foreach ($insurances as $insurance){
            $insurance->status = InsuranceStatusEnum::INACTIVE;
            $insurance->save();
        }

        return 0;
    }
}
