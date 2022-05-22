<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nurse_scheduler extends Model
{
    //

    protected $fillablle = ['nurse_id','patient_id','appointed_date','appointed_start_time','status','assesment_type'];
}
