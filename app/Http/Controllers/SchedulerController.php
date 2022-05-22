<?php

namespace App\Http\Controllers;
ini_set("allow_url_fopen", 1);

use App\distance_table;
use App\nurse_profile;
use App\nurse_scheduler;
use App\patient_profile;
use Illuminate\Http\Request;
use Session;
use App\Mail\SendMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class SchedulerController extends Controller
{
    //

    public function distance($lat1,$lon1,$lat2,$lon2)
    {
        $curl = curl_init();

curl_setopt_array($curl, array(
    //CURLOPT_URL => "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=Washington%2CDC&destinations=New%20York%20City%2CNY&key=AIzaSyAXhRPj6NklgCWF5h8Gn-nptIFXX0jpVhE",
 CURLOPT_URL =>'https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins='.$lat1.','.$lon1.'&destinations='.$lat2.','.$lon2.'&key=AIzaSyAXhRPj6NklgCWF5h8Gn-nptIFXX0jpVhE',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",

));

$distance = curl_exec($curl);
//file_put_contents('test.txt',$distance);
 $distance_arr = json_decode($distance);
        $elements = $distance_arr->rows[0]->elements;
        $distance = $elements[0]->distance->text;
        $duration = $elements[0]->duration->text;
        $distance = explode(" ",$distance);

        $total_distance = $distance[0];

        $duration = explode(' ',$duration);
          if (sizeof($duration)>2) {
              $total_duration = $duration[0]*60 + $duration[2];
          }
          else{
              $total_duration = $duration[0];
          }

        $arr = ['distance'=>$total_distance,
                  'duration'=>$total_duration];
                  return $arr;

$err = curl_error($curl);

curl_close($curl);


    }

    // public function distance($lat1,$lon1,$lat2,$lon2)
    // {



    //     $distance = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins='.$lat1.','.$lon1.'&destinations='.$lat2.','.$lon2.'&key=AIzaSyAXhRPj6NklgCWF5h8Gn-nptIFXX0jpVhE');
    //     $distance_arr = json_decode($distance);
    //     $elements = $distance_arr->rows[0]->elements;
    //     $distance = $elements[0]->distance->text;
    //     $duration = $elements[0]->duration->text;
    //     $distance = explode(" ",$distance);

    //     $total_distance = $distance[0];

    //     $duration = explode(' ',$duration);
    //       if (sizeof($duration)>2) {
    //           $total_duration = $duration[0]*60 + $duration[2];
    //       }
    //       else{
    //           $total_duration = $duration[0];
    //       }

    //     $arr = ['distance'=>$total_distance,
    //               'duration'=>$total_duration];
    //               return $arr;


    // }

    public function home()
    {

        if(Session::has('user_id'))
        {
            $user_id = Session::get('user_id');
            $user_role = User::where('id','=',$user_id)->first()->user_role;
            if($user_role === 'super_admin')
            {

               return view('super_admin.view_user');
            }

            else
            {

                $user_role = explode(',',$user_role);
             if(in_array('intaker',$user_role))
             {
                return view('intaker.patients_profile');
             }
             else if(in_array('scheduler',$user_role))
             {
                $patient_list = patient_profile::where('status', '=', 'not_assign')->get();
                $pending_patient = sizeof($patient_list);

                return view('scheduler.welcome', ['patient_list' => $patient_list,'pending_patient'=>$pending_patient]);
             }

             else if(in_array('admin',$user_role))
             {
                date_default_timezone_set('Asia/Dhaka');
                $date = date('Y-m-d');

                $pending_patient = patient_profile::where('status', '=', 'not_assign')->get();
                $total_pending_patient = sizeof($pending_patient);

                $assign_patient = nurse_scheduler::where('created_at', 'LIKE', $date."%")->get();
                $total_assign_patient = sizeof($assign_patient);

                $total_assign_nurse = sizeof($assign_patient);

                $occupied_nurse = 0;
                for ($i = 0; $i < sizeof($assign_patient); $i++) {
                    $nurse_id = $assign_patient[$i]->nurse_id;

                    $nurse_count = nurse_scheduler::where('nurse_id', '=', $nurse_id)->where('appointed_date', '=', $date)->get();

                    if (sizeof($nurse_count) == 3) {
                        $occupied_nurse++;
                    }
                }

                return view('admin.welcome', ['total_pedning_patient' => $total_pending_patient, 'total_assign_nurse' => $total_assign_nurse, 'total_assign_patient' => $total_assign_patient, 'occupied_nurse' => $occupied_nurse]);
             }




            }


        }
        else
        {
         return view ('index');
        }


    }
   public function login(Request $request)
   {
           $email = $request->email;
           $password = $request->password;

           if(($email == 'salah1234@gmail.com' && $password == '1234')||($email == 'james_c&t@gmail.com' && $password == '9182')  )
           {
            Session::put('email', $email);
               return view('welcome');

           }
           else{
            Session::flash ( 'message', "Invalid Email or Password" );
            return redirect('/');
           }
   }
    public function main_page()
    {
        $patient_list = patient_profile::where('status', '=', 'not_assign')->get();
        $pending_patient = sizeof($patient_list);

        return view('scheduler.welcome', ['patient_list' => $patient_list,'pending_patient'=>$pending_patient]);

    }

    // public function distance($lat1, $lon1, $lat2, $lon2)
    // {
    //     if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    //         return 0;
    //     } else {
    //         $theta = $lon1 - $lon2;
    //         $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    //         $dist = acos($dist);
    //         $dist = rad2deg($dist);
    //         $miles = $dist * 60 * 1.1515;
    //        // $unit = strtoupper($unit);

    //         return round(($miles * 1.609344), 3);


    //     }
    // }

    public function push_notification($nurse_id)
    {

       // file_put_contents('test.txt','push_notification');
    $title ="hi";
    $message = "hello";
    $image_url ="https://storage.googleapis.com/imp-projects/flower-show/1.2.3/images/splash/frontflower_left.png";

    $path_to_fcm= 'https://fcm.googleapis.com/fcm/send';
    $server_key= "AAAAbE0lZTk:APA91bFUjuLDJebrQd-Nd0XhJoW9bp-pNblPCZggPKJCWoY06Xn7xcS8sIt7gIXuGf2PWwJjHHUfas21hMPc3MvXj6OLd1WcgE-nwqIQA6uvA2QE2sf-FSBh3Zbs5i2T7ehfD92D7ILY";


        $key = nurse_profile::where('id','=',$nurse_id)->first()->firebase_token ;//"d85b_7DQz_0:APA91bG31jWgzzwd8-P7kovxmUfCyDAJKcJkwyUlIoMJ3NlnkdsC0CNF55uY2u5WNUfVA8IraOtqWriw-wCBMhqrxOSRa0qCQL7CjMJ9mtMMcyBgLO35ccppytFFrFuaNSd9IVGulZFT";

        $headers = array(
            'Authorization: key=' . $server_key,
            'Content-Type: application/json'
        );

    	 $fields = array('to' => $key,
            'notification' => array('title'=>$title,'body'=>$message,'sound'=>"default"));

		$payload =json_encode($fields);

        $curl_session = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
		curl_setopt($curl_session, CURLOPT_POST, true);
        curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);

		$result =curl_exec($curl_session);

		curl_close($curl_session);

    }
    public function submit_nurse(Request $request)
    {

        $nurse_id = $request->nurse_id;

        $nurse_name = nurse_profile::where('id','=',$nurse_id)->first()->name;
        $nurse_contact_no = nurse_profile::where('id','=',$nurse_id)->first()->phone_number;
        $patient_id = $request->patient_id;
        $patient_email = patient_profile::where('id','=',$patient_id)->first()->email;
        $appointed_date = $request->date;
        $start_time = $request->time;
        $assesment_type = $request->assesment_type;


        $nurse_scheduler = new nurse_scheduler();
        $nurse_scheduler->nurse_id = $nurse_id;
        $nurse_scheduler->patient_id = $patient_id;
        $nurse_scheduler->appointed_date = $appointed_date;

        $nurse_scheduler->appointed_start_time = $start_time;
        $nurse_scheduler->assesment_type = $assesment_type;


        $nurse_scheduler->save();

        patient_profile::where('id','=',$patient_id)->update(['status'=>'assign']);
        $patient_info = distance_table::where('patient_id','=',$patient_id)->first();
        $patient_lat = $patient_info->patient_lat;
        $patient_lon = $patient_info->patient_lon;

        distance_table::where('nurse_id','=',$nurse_id)->update(['shortest_nurse_lat'=>$patient_lat,'shortest_nurse_lon'=>$patient_lon]);

         $nurse_list = distance_table::where('nurse_id','=',$nurse_id)->get();

         for($i=0;$i<sizeof($nurse_list);$i++)
         {
             $id = $nurse_list[$i]->id;
             $nurse_lat = $nurse_list[$i]->shortest_nurse_lat;
             $nurse_lon = $nurse_list[$i]->shortest_nurse_lon;

             $patient_lat = $nurse_list[$i]->patient_lat;
             $patient_lon = $nurse_list[$i]->patient_lon;

             $distance = $this->distance($nurse_lat,$nurse_lon,$patient_lat,$patient_lon);

            //    $myfile = fopen("file.txt", "a+") or die("Unable to open file!");
            //    fwrite($myfile,$nurse_lat." ".$nurse_lon." ".$patient_lat." ".$patient_lon." ".$distance."\n");
             distance_table::where('id','=',$id)->update(['shortest_distance'=>$distance['distance'],'duration'=>$distance['duration']]);





         }

         $data = array(

            'nurse_name'   =>  $nurse_name,
            'phone_number'        =>$nurse_contact_no
        );
        Mail::to($patient_email)->send(new SendMail($data));
        $this->push_notification($nurse_id);



    }

    public function show_nurse_assign_modal(Request $request)
    {
        $patient_id = $request->patient_id;
         $nurse_id = $request->nurse_id;
          $date = $request->date;
            $time = $request->time;

        if($patient_id == 'all')
        {
                echo "not_ok";

        }

        else if(nurse_scheduler::where('nurse_id','=',$nurse_id)->where('appointed_date','=',$date)->where('appointed_start_time','=',$time)->first())
        {
            echo "already_appointed";
        }



        else{
               $data = "";


            $nurse_scheduler = nurse_scheduler::where('nurse_id','=',$nurse_id)->where('appointed_date','=',$date)->get();
            //file_put_contents('test.txt',$nurse_scheduler);
            $tmp_patient_id = 0;
            for($i = 0;$i<sizeof($nurse_scheduler);$i++)
            {
                 $nurse_id = $nurse_scheduler[$i]->nurse_id;
                 $nurse_name = nurse_profile::where('id', '=', $nurse_id)->first()->name;

                 $patient_id=  $nurse_scheduler[$i]->patient_id;
                 $tmp_patient_id = $patient_id;
                  $patient= patient_profile::where('id', '=', $patient_id)->first();
            $patient_name = $patient->first_name." ".$patient->last_name;
            $assesment_type = $patient->assesment_type;
            $address = $patient->address.",".$patient->city;
           $date = $nurse_scheduler[$i]->appointed_date;
           $time = $nurse_scheduler[$i]->appointed_start_time;
             $distance = distance_table::where('nurse_id','=',$nurse_id)->where('patient_id','=',$patient_id)->first()->shortest_distance;

                  $data.='<tr>

             <td >'.$nurse_name.'</td>
             <td>'.$patient_name.'</td>
             <td >'.$date.'</td>
             <td >'.$time.'</td>
             <td>'.$address.'</td>
             <td>'.$assesment_type.'</td>
             <td>'.$distance.'</td>

            ';


            }



            $patient_id = $request->patient_id;

         $nurse_id = $request->nurse_id;
          $date = $request->date;
            $time = $request->time;

              $patient= patient_profile::where('id', '=', $patient_id)->first();
            $patient_name = $patient->first_name." ".$patient->last_name;
            $address = $patient->address.",".$patient->city;
            $assesment_type = $patient->assesment_type;

            $nurse_name = nurse_profile::where('id', '=', $nurse_id)->first()->name;

            $distance = distance_table::where('nurse_id','=',$nurse_id)->where('patient_id','=',$patient_id)->first()->shortest_distance;




            $data.='<tr>

             <td >'.$nurse_name.'</td>
             <td>'.$patient_name.'</td>
             <td >'.$date.'</td>
             <td >'.$time.'</td>
             <td>'.$address.'</td>
             <td>'.$assesment_type.'</td>
             <td>'.$distance.'</td>

             <input type="hidden" id="assign_nurse_id" value='.$nurse_id.'>
             <input type="hidden" id="assign_patient_id" value='.$patient_id.'>
             <input type="hidden" id="assign_date" value='.$date.'>
             <input type="hidden" id="assign_time" value='.$time.'>
             <input type="hidden" id="assesment_type" value='.$assesment_type.'>

             <td><button onclick ="assign_nurse()" class="btn btn-success">Assign</button></td>

        </tr>';

            echo $data;
        }
    }

    public function show_patient_list()
    {
        $patient_lists = patient_profile::all();
        return view('scheduler.patients_list', ['patient_lists' => $patient_lists]);
    }
    public function my_sort($a,$b)
    {
    if ($a['call_count']==$b['call_count']) return 0;
    return ($a['call_count']>$b['call_count'])?-1:1;
    }

    public function fetch_calendar_data(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');
        $date = date('d-m-Y');
       //file_put_contents('test.txt','hello');
        $patient_id =$request->patient_id;
        // $myfile = fopen("file.txt", "a+") or die("Unable to open file!");
        // fwrite($myfile,$patient_id."\n");
        //file_put_contents('test2.txt',$patient_id);
        if ($patient_id == 'all') {
            $data ="";

        echo json_encode($data);
        }
        else{

            date_default_timezone_set('Asia/Dhaka');
            $date = date('Y-m-d');
            $date_limit = 30;
            $date_array = array();

            $date_array[0] =$date;



            for($i = 1;$i<$date_limit;$i++)
            {
                $date1 = date('Y-m-d', strtotime($date. '+1 days'));
                $date_array [$i] = $date1;
                $date = $date1;

            }

                 $nurse_list = distance_table::where('patient_id','=',$patient_id)->orderBy('shortest_distance','ASC')->get();

           // file_put_contents('test.txt',json_encode($nurse_list));
            $data2 = array();
            $a = 0;

            for($i = 0;$i<sizeof($nurse_list);$i++)
            {
              $nurse_id      = $nurse_list[$i]->nurse_id;

              $nurse_profile = nurse_profile::where('id','=',$nurse_id)->first();
              $patient_profile = patient_profile::where('id','=',$patient_id)->first();

              $nurse_name = $nurse_profile->name;
              $assesment_type = $patient_profile->assesment_type;
              $duration_minute = $nurse_list[$i]->duration;

              if($assesment_type =="primary")
              {
                  $duration_minute = $duration_minute+200;
              }
              else
              {
                  $duration_minute = $duration_minute+100;
              }
                 $duration_hour = ceil($duration_minute/60);

              $start_time = $nurse_profile->prefered_start_times;
              $end_time = $nurse_profile->prefered_end_times;
              $prefered_times = array();
              $time_difference =$end_time - $start_time;

             $prefered_times[0] = $start_time.":00";
              for($m = 1 ;$m<$time_difference;$m++ )
              {
                 $start_time = $start_time+1;
                 $time = $start_time.":00";
                 $prefered_times[$m] = $time;
              }
              $prefered_times[$time_difference] = $end_time.':00';

              $nurse_day =  $nurse_profile->prefered_days;
              $nurse_day = explode(',',$nurse_day);

                for($j = 0;$j<sizeof($date_array);$j++)
                {
                   $day = date('l', strtotime($date_array[$j]));
                   if (in_array($day, $nurse_day)) {
                         $a = 0;
                       for ($k=0;$k<sizeof($prefered_times);$k++) {

                           $tmp_date = date('d-m-Y', strtotime($date_array[$j]));

                           $nurse_schedule = nurse_scheduler::where('status', '=', 'running')->where('nurse_id', '=', $nurse_id)->where('appointed_date', '=', $tmp_date)->get();
                          $exist = nurse_scheduler::where('status','=','running')->where('nurse_id','=',$nurse_id)->where('appointed_date','=',$tmp_date)->first();
                           $busy_time = array();
                           if ($exist) {
                               $appointed_started_time = $exist->appointed_start_time;
                               $appointed_started_time2 = explode(':', $appointed_started_time);
                               $appointed_started_time = $appointed_started_time2[0];
                               $busy_time[0] = $appointed_started_time.':00';
                               for ($m = 1;$m<=$duration_hour-1;$m++) {
                                   $tmp_time = $appointed_started_time+1;
                                   $busy_time[$m] = $tmp_time.":00";
                                   $appointed_started_time =$tmp_time;
                               }

                           }
                        if ($exist) {
                            if (!in_array($prefered_times[$k], $busy_time)) {
                                $a++;
                                array_push($data2, [


              'id' => $a,
              'title' => $nurse_name." ".sizeof($nurse_schedule),
              'nurse_id'=>$nurse_id,
              'start' => $date_array[$j].'T'.$prefered_times[$k],
              'end' => $date_array[$j].'T'.$prefered_times[$k],
              'call_count'=>sizeof($nurse_schedule)


          ]);
                            }
                        }


                       }

                   }

                }

            }


           //usort($data2,array($this,'my_sort'));


            for($i = 0;$i<sizeof($nurse_list);$i++)
            {
              $nurse_id      = $nurse_list[$i]->nurse_id;
              $nurse_profile = nurse_profile::where('id','=',$nurse_id)->first();
              $patient_profile = patient_profile::where('id','=',$patient_id)->first();
              $nurse_name = $nurse_profile->name;
              $assesment_type = $patient_profile->assesment_type;
              $duration_minute = $nurse_list[$i]->duration;

              if($assesment_type =="primary")
              {
                  $duration_minute = $duration_minute+200;
              }
              else
              {
                  $duration_minute = $duration_minute+100;
              }
                 $duration_hour = ceil($duration_minute/60);

                //     $myfile = fopen("file.txt", "a+") or die("Unable to open file!");
                //  fwrite($myfile,$nurse_name." ".$duration_minute." ".$assesment_type."\n");

              $start_time = $nurse_profile->prefered_start_times;
              $end_time = $nurse_profile->prefered_end_times;
              $prefered_times = array();
              $time_difference =$end_time - $start_time;

             $prefered_times[0] = $start_time.":00";
              for($m = 1 ;$m<$time_difference;$m++ )
              {
                 $start_time = $start_time+1;
                 $time = $start_time.":00";
                 $prefered_times[$m] = $time;
              }
              $prefered_times[$time_difference] = $end_time.':00';

              $nurse_day =  $nurse_profile->prefered_days;
              $nurse_day = explode(',',$nurse_day);

                for($j = 0;$j<sizeof($date_array);$j++)
                {
                   $day = date('l', strtotime($date_array[$j]));
                   if (in_array($day, $nurse_day)) {
                      $a =0;
                       for ($k=0;$k<sizeof($prefered_times);$k++) {


                           $tmp_date = date('d-m-Y', strtotime($date_array[$j]));


                           $nurse_schedule = nurse_scheduler::where('status', '=', 'running')->where('nurse_id', '=', $nurse_id)->where('appointed_date', '=', $tmp_date)->get();

                          $exist = nurse_scheduler::where('status','=','running')->where('nurse_id','=',$nurse_id)->where('appointed_date','=',$tmp_date)->first();
                           $busy_time = array();
                           if ($exist) {
                               $appointed_started_time = $exist->appointed_start_time;
                               $appointed_started_time2 = explode(':', $appointed_started_time);


                               $appointed_started_time = $appointed_started_time2[0];


                               $busy_time[0] = $appointed_started_time.':00';
                               for ($m = 1;$m<=$duration_hour-1;$m++) {
                                   $tmp_time = $appointed_started_time+1;
                                   $busy_time[$m] = $tmp_time.":00";
                                   $appointed_started_time =$tmp_time;
                               }

                           }
                        if (!$exist) {

                            if (!in_array($prefered_times[$k], $busy_time)) {
                                $a++;
                                array_push($data2, [


              'id' => $a,
              'title' => $nurse_name." ".sizeof($nurse_schedule),
              'nurse_id'=>$nurse_id,
              'start' => $date_array[$j].'T'.$prefered_times[$k],
              'end' => $date_array[$j].'T'.$prefered_times[$k],
              'call_count'=>sizeof($nurse_schedule)


          ]);
                            }
                        }


                       }


                   }


                }


            }
            //file_put_contents('test.txt',json_encode($data2));
            echo json_encode($data2);

            //file_put_contents('test.txt',json_encode($data2));








            //file_put_contents('test.txt',json_encode($date_array));






        }


    }




    public function search_nurse(Request $request)
    {
        $nurse_searching_date = $request->nurse_searching_date;
        $patient_id = $request->patient_id;
        $nameOfDay = date('l', strtotime($nurse_searching_date));
        $nurse_id = array();
        $nurse_id_list = distance_table::where('patient_id', '=', $patient_id)->orderBy('shortest_distance', 'ASC')->get();
       // file_put_contents('test.txt', $nurse_id_list);

        $data = ' <thead>
                    <tr>
                        <th>Name</th>
                        <th>Trained Plan</th>
                        <th>Nurse Registration No</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th></th>
                    </tr>
                    </thead>

                 <tbody>';
        for ($i = 0; $i < sizeof($nurse_id_list); $i++) {

            $nurse_id = $nurse_id_list[$i]->nurse_id;
            $nurse_lists = nurse_profile::where('id', '=', $nurse_id)->where('prefered_days', 'LIKE', '%' . $nameOfDay . '%')->first();

            if ($nurse_lists) {
                $data .= '<tr>
                    <td>' . $nurse_lists->name . '</td>
                    <td>' . $nurse_lists->trained_plan . '</td>
                    <td>' . $nurse_lists->nurse_registration_no . '</td>
                    <td>' . $nurse_lists->phone_number . '</td>
                    <td>' . $nurse_lists->address . '</td>
                    <td>3</td>
                    <td><button class="btn btn-success" onclick="select_nurse(' . $nurse_id . ')" type="button">Assign</button></td>


                </tr>';

            }

        }
        $data .= '</tbody>';
        echo $data;

    }
}
