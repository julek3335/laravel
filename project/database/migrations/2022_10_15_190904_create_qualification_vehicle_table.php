<?php

use App\Models\Qualification;
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
        Schema::create('qualification_vehicle', function (Blueprint $table) {
            $table->foreignIdFor(Qualification::class);
            $table->foreignIdFor(Vehicle::class);
            $table->primary(['vehicle_id', 'qualification_id']);
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
        Schema::dropIfExists('qualification_vehicle');
    }
};
