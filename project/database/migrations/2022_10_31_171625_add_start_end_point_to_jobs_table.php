<?php

use App\Enums\InsuranceStatusEnum;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('start_point')->nullable();
            $table->string('end_point')->nullable();
            $table->double('start_odometer')->nullable();
            $table->double('end_odometer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('start_point');
            $table->dropColumn('end_point');
        });
    }
};
