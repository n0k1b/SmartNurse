<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patient_profile extends Model
{
    //
    protected $fillablle = ['insurance_plan','date_received','date_need_to_be_finished','date_need_to_be_finished','member_id','first_name','last_name','sex','date_of_birth','primary_language','cell_phone','home_phone','marital_status','email','address','city','state','zip_code','country','user_id','assesment_type','cancel'];
}
