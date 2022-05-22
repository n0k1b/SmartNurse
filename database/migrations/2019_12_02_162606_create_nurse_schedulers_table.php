<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNurseSchedulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_schedulers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('nurse_id');
            $table->bigInteger('patient_id');
            $table->string('appointed_date');
            $table->string('appointed_days');
            $table->string('appointed_days');
            $table->string('appointed_end_time');
            $table->string('appointment_status')->default('pending');
            

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
        Schema::dropIfExists('nurse_schedulers');
    }
}
