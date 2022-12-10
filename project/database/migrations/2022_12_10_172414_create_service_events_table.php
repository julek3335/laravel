<?php

use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_events', function (Blueprint $table) {
            $table->date('event_date');
            $table->foreignIdFor(Vehicle::class);
            $table->foreignIdFor(Service::class);
            $table->string('status', 30);
            $table->text('note')->default('');
            $table->primary(['vehicle_id', 'service_id', 'event_date']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_events');
    }
};
