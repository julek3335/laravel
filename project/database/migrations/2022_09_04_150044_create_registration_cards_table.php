<?php

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
        Schema::create('registration_cards', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_identification_number',50)->nullable();
            $table->string('color',30)->nullable();
            $table->string('license_plate',20)->nullable();
            $table->string('fuel_type',20)->nullable();
            $table->string('photo',100)->nullable();
            $table->double('max_total_weight')->nullable();
            $table->double('engine_capacity')->nullable();
            $table->integer('engine_power')->nullable();
            $table->integer('avg_fuel_consumption')->nullable();
            $table->integer('mileage')->nullable();
            $table->year('production_year')->nullable();
            $table->double('max_axle_load')->nullable();
            $table->double('max_towed_load')->nullable();
            $table->integer('axle')->default(2);
            $table->integer('siting_places')->default(5);
            $table->integer('standing_places')->default(0);
            $table->foreignIdFor(Vehicle::class)->nullable();
            // $table->foreignIdFor(VehicleType::class)->nullable();
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
        Schema::dropIfExists('registration_cards');
    }
};
