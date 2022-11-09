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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->string('policy_number');
            $table->date('expiration_date');
            $table->double('cost');
            $table->integer('phone_number');
            $table->string('type')->nullable();
            $table->string('insurer_name')->nullable();
            $table->string('description')->nullable();
            $table->string('photo')->nullable();
            $table->foreignIdFor(Vehicle::class)->nullable();
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
        Schema::dropIfExists('insurances');
    }
};
