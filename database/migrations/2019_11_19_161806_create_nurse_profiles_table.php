<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNurseProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('gender');
            $table->string('language');
          
            $table->string('trained_plan');
            $table->string('email_address');
            $table->string('nurse_registration_no');
            $table->string('phone_number');
            $table->string('address');
            $table->string('prefered_days');
            $table->string('prefered_location');
            $table->string('prefered_times');
            $table->string('prefered_notes');
            
            

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
        Schema::dropIfExists('nurse_profiles');
    }
}
