<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nurse_profile;
use App\nurse_scheduler;
use App\patient_profile;
use App\distance_table;

class ApiController extends Controller
{
    //

    public function login(Request $reuqest)
    {

       // return 'hello';
        $phone_number = $reuqest->msisdn;
        $password = $reuqest->password;

        $is_avail = nurse_profile::where('phone_number','=',$phone_number)->first();

       // file_put_contents('test.txt',$phone_number." ".$password." ".$is_avail);
        if($is_avail)
        {
            $name = $is_avail->name;
            // $image = $is_avail->user_id;
            $image = 'http://www.quiz-hunt.com/smart_nurse/image/nurse_image/'.$is_avail->user_id.".jpg";
            return response()->json(['error'=>'no','name'=>$name,'image'=>$image,'address'=>$is_avail->address,'user_id'=>$is_avail->user_id,'working_day'=>$is_avail->prefered_days,'email'=>$is_avail->email_address]);
        }
        else{
            return response()->json(['error'=>'yes']);
        }
    }

    public function get_schedule(Request $request)
    {
         //date_default_timezone_set('Asia/Dhaka');
         $date = $request->date;
         $date2 = explode("-",$date);
         $month = $date2[1];
         if(strlen($month)==1)
         {
             $month ="0".$month;
         }
         $date = $date2[0]."-".$month."-".$date2[2];

        $nurse_id = $request->user_id;
        $appointment = nurse_scheduler::where('nurse_id','=',$nurse_id)->where('appointed_date','=',$date)->where('cancle','=','no')->get();
        $appointment_list = array();

        if($appointment->isEmpty())
        {
            //return $date;
            return json_encode($appointment_list);
        }
        else
        {
            for($i = 0 ;$i<sizeof($appointment);$i++)
            {
                $patient_id = $appointment[$i]->patient_id;
                $patient = patient_profile::where('id','=',$patient_id)->first();
                $patient_name = $patient->first_name." ".$patient->last_name;
                $address = $patient->address.",".$patient->city.",".$patient->country;
                $patient_lat = distance_table::where('patient_id','=',$patient_id)->first()->patient_lat;
                $patient_lon = distance_table::where('patient_id','=',$patient_id)->first()->patient_lon;




                array_push($appointment_list,['scheduler_id'=>$appointment[$i]->id,'p_name'=>$patient_name,'p_id'=>$patient_id,'appointment_time'=>$appointment[$i]->appointed_start_time,'lat'=>$patient_lat,'lon'=>$patient_lon,'p_address'=>$address]);
            }
            return json_encode($appointment_list);
        }


    }

      public function get_schedule_week(Request $request)
    {
         //date_default_timezone_set('Asia/Dhaka');
         date_default_timezone_set('Asia/Dhaka');
         $date = date('d-m-Y');

            $date_limit = 7;
            $date_array = array();

            $date_array[0] =$date;



            for($i = 1;$i<$date_limit;$i++)
            {
                $date1 = date('d-m-Y', strtotime($date. '+1 days'));
                $date_array [$i] = $date1;
                $date = $date1;

            }




        $nurse_id = $request->user_id;




        $total_appointment_array = array();

            for($j=0;$j<sizeof($date_array);$j++)
            {
                  $appointment = nurse_scheduler::where('nurse_id','=',$nurse_id)->where('appointed_date','=',$date_array[$j])->where('cancle','=','no')->get();
                    $appointment_list = array();

         if($appointment->isEmpty())
         {
             $appointment_list = $appointment_list;
         }
         else{
            for($i = 0 ;$i<sizeof($appointment);$i++)
            {

                $patient_id = $appointment[$i]->patient_id;
                $patient = patient_profile::where('id','=',$patient_id)->first();
                $patient_name = $patient->first_name." ".$patient->last_name;
                $address = $patient->address.",".$patient->city.",".$patient->country;
                $patient_lat = distance_table::where('patient_id','=',$patient_id)->first()->patient_lat;
                $patient_lon = distance_table::where('patient_id','=',$patient_id)->first()->patient_lon;

                array_push($appointment_list,['scheduler_id'=>$appointment[$i]->id,'p_name'=>$patient_name,'p_id'=>$patient_id,'appointment_time'=>$appointment[$i]->appointed_start_time,'lat'=>$patient_lat,'lon'=>$patient_lon,'p_address'=>$address]);
            }

            }
            array_push($total_appointment_array,['date'=>$date_array[$j],'appointment'=>$appointment_list]);
        }
            return json_encode($total_appointment_array);



    }








    public function get_schedule_today(Request $request)
    {
         date_default_timezone_set('Asia/Dhaka');
         $date = date('d-m-Y');
         $date2 = explode("-",$date);
         $month = $date2[1];
         if(strlen($month)==1)
         {
             $month ="0".$month;
         }
         $date = $date2[0]."-".$month."-".$date2[2];
        $nurse_id = $request->user_id;
        $appointment = nurse_scheduler::where('nurse_id','=',$nurse_id)->where('appointed_date','=',$date)->where('cancle','=','no')->get();
        $appointment_list = array();

        if($appointment->isEmpty())
        {
           // return $date;
            return json_encode($appointment_list);
        }
        else
        {
            for($i = 0 ;$i<sizeof($appointment);$i++)
            {
                $patient_id = $appointment[$i]->patient_id;
                $patient = patient_profile::where('id','=',$patient_id)->first();
                $patient_name = $patient->first_name." ".$patient->last_name;
                $address = $patient->address.",".$patient->city.",".$patient->country;
                $patient_lat = distance_table::where('patient_id','=',$patient_id)->first()->patient_lat;
                $patient_lon = distance_table::where('patient_id','=',$patient_id)->first()->patient_lon;




                array_push($appointment_list,['scheduler_id'=>$appointment[$i]->id,'p_name'=>$patient_name,'p_id'=>$patient_id,'appointment_time'=>$appointment[$i]->appointed_start_time,'lat'=>$patient_lat,'lon'=>$patient_lon,'p_address'=>$address]);
            }
            return json_encode($appointment_list);
        }


    }

    public function notification(Request $request)
    {
        $nurse_id = $request->user_id;

           $appointment = nurse_scheduler::where('nurse_id','=',$nurse_id)->orderBy('id','DESC')->limit(20)->get();
        $appointment_list = array();

        if($appointment->isEmpty())
        {
           // return $date;
            return json_encode($appointment_list);
        }
        else
        {
            for($i = 0 ;$i<sizeof($appointment);$i++)
            {
                $patient_id = $appointment[$i]->patient_id;
                $patient = patient_profile::where('id','=',$patient_id)->first();
                $patient_name = $patient->first_name." ".$patient->last_name;
                $address = $patient->address.",".$patient->city.",".$patient->country;
                $patient_lat = distance_table::where('patient_id','=',$patient_id)->first()->patient_lat;
                $patient_lon = distance_table::where('patient_id','=',$patient_id)->first()->patient_lon;




                array_push($appointment_list,['p_name'=>$patient_name,'p_id'=>$patient_id,'appointment_time'=>$appointment[$i]->appointed_start_time,'lat'=>$patient_lat,'lon'=>$patient_lon,'p_address'=>$address,'appointment_date'=>$appointment[$i]->appointed_date]);
            }
            return json_encode($appointment_list);
        }


    }

    public function cancle_schedule(Request $request)
    {
        $scheduler_id = $request->scheduler_id;
       // file_put_contents('test.txt',$scheduler_id);
        nurse_scheduler::where('id','=',$scheduler_id)->update(['cancle'=>'yes']);

        $patient_id = nurse_scheduler::where('id','=',$scheduler_id)->first()->patient_id;
        patient_profile::where('id','=',$patient_id)->update(['status'=>'not_assign','cancel'=>'yes']);


        	return response()->json(['response'=>'ok']);

    }
    public function get_distance(Request $request)
    {
        $nurse_lat = $request->lat;
        $nurse_lon = $request->lon;
    }

    public function update_firebase_token(Request $request)

    {


        $user_id = $request->user_id;
        $key = $request->key;
        nurse_profile::where('id','=',$user_id)->update(['firebase_token'=>$key]);

        	return response()->json(['response'=>'ok']);


    }

    public function update_image(Request $request)
    {
        $user_id =$request->user_id;
        $image = $request->image;
        $upload_path = "image/nurse_image/".$user_id.".jpg";
         file_put_contents($upload_path,base64_decode($image));

         if(nurse_profile::where('id','=',$user_id)->update(['image'=>$upload_path]))
         {
             return  response()->json(['response'=>'ok']);
         }
         else
         {
              return response()->json(['response'=>'not_ok']);
         }

        // $imageName = time().'.'.request()->image->getClientOriginalExtension();
        // base64_decode(request()->image)->move(base_path('image/nurse_image'), $imageName);

    }

    public function update_profile(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;
        $user_id = $request->user_id;

        if($name)
        {
            $nurse_profile = nurse_profile::where('id','=',$user_id)->update(['name'=>$name]);
        }
        if($email)
        {
            $nurse_profile = nurse_profile::where('id','=',$user_id)->update(['email_address'=>$email]);
        }
        if($phone)
        {
            $nurse_profile = nurse_profile::where('id','=',$user_id)->update(['phone_number'=>$phone]);
        }
        if($address)
        {
            $nurse_profile = nurse_profile::where('id','=',$user_id)->update(['address'=>$address,'prefered_location'=>$address]);

        }

        if($nurse_profile)
        {
             return response()->json(['response'=>'ok']);
        }

        else
        {
              return response()->json(['response'=>'not_ok']);
        }


    }
}
