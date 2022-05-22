<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nurse_profile extends Model
{
    //

    protected $fillablle = ['name','gender','language','trained_plan','email_address','nurse_registration_no','phone_number','address','prefered_days','prefered_location','prefered_start_times','prefered_end_times','prefered_notes','user_id','prefered_city','prefered_country','prefered_zip'];
}
