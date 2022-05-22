<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetaientProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('insurance_plan');
            $table->string('date_received');
            $table->string('date_need_to_be_finished');
            $table->string('medicaid_id');
            $table->string('member_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('sex');
            $table->string('date_of_birth');
            $table->string('primary_language');
            $table->string('cell_phone');
            $table->string('home_phone');
            $table->string('marital_status');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('country');
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
        Schema::dropIfExists('petaient_profiles');
    }
}
