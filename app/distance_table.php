<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class distance_table extends Model
{
    //
    protected $fillablle = ['patient_id','nurse_id','patient_lat','patient_lon','shortest_nurse_lat','shortest_nurse_lon','shortest_distance','duration'];
}
