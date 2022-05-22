<?php


namespace App\Http\Controllers;
set_time_limit(30000);

use App\distance_table;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\nurse_profile;
use App\patient_profile;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use DB;
use Spatie\Geocoder\Geocoder;

class ExcelController extends Controller
{
    //

    // public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    // {
    //     if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    //         return 0;
    //     } else {
    //         $theta = $lon1 - $lon2;
    //         $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    //         $dist = acos($dist);
    //         $dist = rad2deg($dist);
    //         $miles = $dist * 60 * 1.1515;
    //         $unit = strtoupper($unit);
    //         // file_put_contents('test.txt',$miles);

    //         return round(($miles * 1.609344), 3);


    //     }
    // }

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
file_put_contents('test.txt',$distance);
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

    public function find_distance($nurse_address, $patient_address)
    {
        $client = new \GuzzleHttp\Client();

        $geocoder = new Geocoder($client);

        $geocoder->setApiKey(config('geocoder.key'));

// $geocoder->setCountry(config('US'));

        $nurse_address = $geocoder->getCoordinatesForAddress($nurse_address);
        $patient_address = $geocoder->getCoordinatesForAddress($patient_address);

        $nurse_lat = $nurse_address['lat'];
        $nurse_lon = $nurse_address['lng'];

        $patient_lat = $patient_address['lat'];
        $patient_lon = $patient_address['lng'];

        //file_put_contents('test2.txt', $nurse_lat . " " . $nurse_lon . " " . $patient_lat . " " . $patient_lon);

        $distance = $this->distance($nurse_lat, $nurse_lon, $patient_lat, $patient_lon);

        $path = [
            'patient_lat'=>$patient_lat,
            'patient_lon'=>$patient_lon,
            'nurse_lat'=>$nurse_lat,
            'nurse_lon'=>$nurse_lon,
            'distance'=>$distance['distance'],
            'duration'=>$distance['duration'],

        ];


       // file_put_contents('test.txt',json_encode($path));
//file_put_contents('test3.txt',$distance);
        return $path;


    }

    public function get_lat_lon($nurse_address, $patient_address)
    {
        $client = new \GuzzleHttp\Client();

        $geocoder = new Geocoder($client);

        $geocoder->setApiKey(config('geocoder.key'));

// $geocoder->setCountry(config('US'));

        $nurse_address = $geocoder->getCoordinatesForAddress($nurse_address);
        $patient_address = $geocoder->getCoordinatesForAddress($patient_address);

        $nurse_lat = $nurse_address['lat'];
        $nurse_lon = $nurse_address['lng'];

        $patient_lat = $patient_address['lat'];
        $patient_lon = $patient_address['lng'];

        //file_put_contents('test2.txt', $nurse_lat . " " . $nurse_lon . " " . $patient_lat . " " . $patient_lon);

        $distance = $this->distance($nurse_lat, $nurse_lon, $patient_lat, $patient_lon, 'K');
//file_put_contents('test3.txt',$distance);
        return $distance;

    }

    public function get_shortest_distance($nurse_zip,$patient_zip)
    {
        // $nurse_address = 'Bahaddarhat,Chittagong:GEC,Chitttagong:Agrabad,Chittagong';
        // $patient_address = 'Dampara,Chittagong';
        //file_put_contents('test.txt',$nurse_address." ".$patient_address);
        //$nurse_address = explode(':', $nurse_address);

        //$distance = $this->find_distance($nurse_address,$patient_address);
        //return $distance;

        $nurse = DB::table('zip_code_lat_lon')->where('zip','=',$nurse_zip)->first();
        $nurse_lat = $nurse->lat;
        $nurse_lon = $nurse->lon;

        $patient = DB::table('zip_code_lat_lon')->where('zip','=',$patient_zip)->first();
        $patient_lat = $patient->lat;
        $patient_lon = $patient->lon;

       $distance = $this->distance($nurse_lat,$nurse_lon,$patient_lat,$patient_lon);


       $path = [
        'patient_lat'=>$patient_lat,
        'patient_lon'=>$patient_lon,
        'nurse_lat'=>$nurse_lat,
        'nurse_lon'=>$nurse_lon,
        'distance'=>$distance['distance'],
        'duration'=>$distance['duration']

    ];

    return $path;



        // $distance = array();

        // for ($i = 0; $i < sizeof($nurse_address); $i++) {

        //     $distance[]=$this->find_distance($nurse_address[$i], $patient_address);
        //     //echo json_encode($distance);

        //     //array_push($distance,$this->find_distance($nurse_address[$i], $patient_address));
        // }
        // $get_distance = array_column($distance, 'distance');
        // $min_array = $distance[array_search(min($get_distance), $get_distance)];
        // return $min_array;
        //echo json_encode($distance);
       // echo json_encode($distance[0]);
        //return min($distance);
        //file_put_contents('test2.txt',$min_array);
        //file_put_contents("test.txt", json_encode($distance));
        // file_put_contents('test.txt',$nurse_address." ".$patient_address);

    }





    // public function find_lat_lon()
    // {
    //     $nurse_address = 'Bahaddarhat,Chittagong:GEC,Chitttagong:Agrabad,Chittagong';
    //     $patient_address = 'Dampara,Chittagong';
    //     $nurse_address = explode(':', $nurse_address);

    //     $distance = array();

    //     for ($i = 0; $i < sizeof($nurse_address); $i++) {
    //         //$distance[] = $this->find_distance($nurse_address[$i], $patient_address);

    //         array_push($distance,$this->find_distance2($nurse_address[$i], $patient_address));

    //         // array_push($distance, [

    //         //     'nurse_address' => $nurse_address[$i],
    //         //     'patient_address' => $patient_address,
    //         //     'distance' => $this->find_distance($nurse_address[$i], $patient_address),
    //         // ]);
    //     }
    //     //$final_path = json_encode($distance);
    //     $get_distance = array_column($distance, 'distance');
    //     $min_array = $distance[array_search(min($get_distance), $get_distance)];
    //     echo json_encode($min_array);

    //     //echo $final_path;

    //     //echo min($final_path->distance);
    //     //echo min($distance->distance);
    //     //file_put_contents('test.txt',json_encode($distance));

    // }

    public function nurse_file_import(Request $request)
    {
        //file_put_contents('test.txt',"hello");
        Session::pull('nurse_error');


        $data = Excel::toArray(new UsersImport, request()->file('select_file'));

        //file_put_contents('test.txt', implode(" ",$array));

        // $data = json_encode($data);
        // $data = json_decode($data);
        //echo sizeof($data[0][0]);

        $insert_data = array();
        $k = 0;
        for ($i = 1; $i < sizeof($data[0]); $i++) {

            array_push($insert_data, array(

                'name' => $data[0][$i][0],
                'gender' => $data[0][$i][1],
                'language' => $data[0][$i][2],

                'trained_plan' => $data[0][$i][3],

                'email_address' => $data[0][$i][4],
                'nurse_registration_no' => $data[0][$i][5],
                'phone_number' => $data[0][$i][6],

                'address' => $data[0][$i][7],
                'prefered_days' => $data[0][$i][8],
                'prefered_location' => $data[0][$i][9],
                'prefered_start_times' => $data[0][$i][10],
                'prefered_end_times' => $data[0][$i][11],

                'prefered_notes' => $data[0][$i][12],
                'prefered_city' => $data[0][$i][13],
                'prefered_country' => $data[0][$i][14],
                'prefered_zip' => $data[0][$i][15],

            ));
        }
        //file_put_contents('test.txt',json_encode($insert_data));

        $error = array();
        $flag = true;
        $data = "";

        for ($i = 0; $i < sizeof($insert_data); $i++) {
            $k = $i + 1;
            $data .= '
            <tr>
            ';
            if (!$insert_data[$i]['name'] || !$insert_data[$i]['gender'] || !$insert_data[$i]['language'] || !$insert_data[$i]['phone_number']
                || !$insert_data[$i]['trained_plan'] || !$insert_data[$i]['email_address'] || !$insert_data[$i]['nurse_registration_no'] || !$insert_data[$i]['address']
                || !$insert_data[$i]['prefered_days'] || !$insert_data[$i]['prefered_location'] || !$insert_data[$i]['prefered_start_times'] || !$insert_data[$i]['prefered_end_times']
                || !$insert_data[$i]['prefered_notes']||!$insert_data[$i]['prefered_city']||!$insert_data[$i]['prefered_country']||!$insert_data[$i]['prefered_zip'])

            // if(!$insert_data[$i]['insurance_plan'])
            {
                array_push($error, $insert_data[$i]);

                //file_put_contents('test.txt',json_encode($insert_data));

                $flag = false;

                $data .= '

               <td style = "color:red">' . $k . '</td>
               ';

            } else {

                $nurse = new nurse_profile();
                $nurse->user_id = 1;
                $nurse->name = $insert_data[$i]['name'];
                $nurse->gender = $insert_data[$i]['gender'];
                $nurse->language = $insert_data[$i]['language'];
                $nurse->trained_plan = $insert_data[$i]['trained_plan'];
                $nurse->email_address = $insert_data[$i]['email_address'];
                $nurse->nurse_registration_no = $insert_data[$i]['nurse_registration_no'];
                $nurse->phone_number = $insert_data[$i]['phone_number'];
                $nurse->address = $insert_data[$i]['address'];
                $nurse->prefered_days = $insert_data[$i]['prefered_days'];
                $nurse->prefered_location = $insert_data[$i]['prefered_location'];
                $nurse->prefered_start_times = $insert_data[$i]['prefered_start_times'];
                $nurse->prefered_end_times = $insert_data[$i]['prefered_end_times'];
                $nurse->prefered_notes = $insert_data[$i]['prefered_notes'];
                $nurse->prefered_city = $insert_data[$i]['prefered_city'];
                $nurse->prefered_county = $insert_data[$i]['prefered_country'];
                $nurse->prefered_zip = $insert_data[$i]['prefered_zip'];
                $nurse->save();

                $nurse_id = $nurse->id;
                //$nurse_address = $insert_data[$i]['prefered_location'].",".$insert_data[$i]['prefered_city'].",".$insert_data[$i]['prefered_country'];
                $nurse_zip = $insert_data[$i]['prefered_zip'];

                $patient = patient_profile::get();
                for ($m = 0; $m < sizeof($patient); $m++) {

                    $patient_id = $patient[$m]->id;
                    //file_put_contents('test.txt', $patient_id);
                   // $patient_address = $patient[$m]['address'] . ',' . $patient[$m]['city'];
                   $patient_zip = $patient[$m]['zip_code'];
                    $shortest_distance = $this->get_shortest_distance($nurse_zip, $patient_zip);


                    $distance_table = new distance_table();
                    $distance_table->patient_id = $patient_id;
                    $distance_table->nurse_id = $nurse_id;
                    $distance_table->shortest_distance = $shortest_distance['distance'];
                    $distance_table->duration = $shortest_distance['duration'];
                    $distance_table->patient_lat = $shortest_distance['patient_lat'];
                    $distance_table->patient_lon = $shortest_distance['patient_lon'];
                    $distance_table->shortest_nurse_lat = $shortest_distance['nurse_lat'];
                    $distance_table->shortest_nurse_lon = $shortest_distance['nurse_lon'];

                    $distance_table->save();

                }
                // file_put_contents('test.txt',$address." ".$id);

                //file_put_contents('test.txt',$id);

                $data .= '

               <td >' . $k . '</td>
               ';

            }

            if ($insert_data[$i]['name']) {
                $data .= '
                    <td>' . $insert_data[$i]['name'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }
            if ($insert_data[$i]['gender']) {
                $data .= '
               <td>' . $insert_data[$i]['gender'] . '</td>

               ';
            } else {
                $data .= '
               <td style="color:red">Missing Data</td>

               ';
            }
            if ($insert_data[$i]['language']) {
                $data .= '
                    <td>' . $insert_data[$i]['language'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';

            }

            if ($insert_data[$i]['trained_plan']) {
                $data .= '
                    <td>' . $insert_data[$i]['trained_plan'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }
            if ($insert_data[$i]['email_address']) {
                $data .= '
                    <td>' . $insert_data[$i]['email_address'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['nurse_registration_no']) {
                $data .= '
                    <td>' . $insert_data[$i]['nurse_registration_no'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['phone_number']) {
                $data .= '
                    <td>' . $insert_data[$i]['phone_number'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['address']) {
                $data .= '
                    <td>' . $insert_data[$i]['address'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['prefered_days']) {
                $data .= '
                    <td>' . $insert_data[$i]['prefered_days'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';

            }

            if ($insert_data[$i]['prefered_location']) {
                $data .= '
                    <td>' . $insert_data[$i]['prefered_location'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }


            if ($insert_data[$i]['prefered_city']) {
                $data .= '
                    <td>' . $insert_data[$i]['prefered_location'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }


            if ($insert_data[$i]['prefered_country']) {
                $data .= '
                    <td>' . $insert_data[$i]['prefered_location'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }


            if ($insert_data[$i]['prefered_start_times']) {
                $data .= '
                    <td>' . $insert_data[$i]['prefered_start_times'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['prefered_end_times']) {
                $data .= '
                    <td>' . $insert_data[$i]['prefered_end_times'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['prefered_notes']) {
                $data .= '
                    <td>' . $insert_data[$i]['prefered_notes'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            $data .= '

           </tr>


               ';

        }

        if ($flag == false) {

            Session::push('nurse_error', $error);
            echo $data;
        } else {
            echo "ok";
        }
    }

    public function import(Request $request)
    {
        Session::pull('error');
        $data = Excel::toArray(new UsersImport, request()->file('select_file'));
        //file_put_contents('test.txt', implode(" ",$array));

        // $data = json_encode($data);
        // $data = json_decode($data);
        //echo sizeof($data[0][0]);

        $insert_data = array();
        $k = 0;
        for ($i = 1; $i < sizeof($data[0]); $i++) {

            array_push($insert_data, array(

                'insurance_plan' => $data[0][$i][0],
                'date_received' => $data[0][$i][1],
                'date_need_to_be_finished' => $data[0][$i][2],

                'medicaid_id' => $data[0][$i][3],

                'member_id' => $data[0][$i][4],
                'first_name' => $data[0][$i][5],
                'last_name' => $data[0][$i][6],
                'sex' => $data[0][$i][7],
                'date_of_birth' => $data[0][$i][8],
                'primary_language' => $data[0][$i][9],

                'cell_phone' => $data[0][$i][10],
                'home_phone' => $data[0][$i][11],

                'marital_status' => $data[0][$i][12],
                'email' => $data[0][$i][13],

                'address' => $data[0][$i][14],
                'city' => $data[0][$i][15],
                'state' => $data[0][$i][16],
                'zip_code' => $data[0][$i][17],
                'country' => $data[0][$i][18],
                'assesment_type' => $data[0][$i][19],

            ));
        }
        $error = array();
        $flag = true;
        $data = "";

        for ($i = 0; $i < sizeof($insert_data); $i++) {
            $k = $i + 1;
            $data .= '
            <tr>
            ';
            if (!$insert_data[$i]['insurance_plan'] || !$insert_data[$i]['date_received'] || !$insert_data[$i]['date_need_to_be_finished']
                || !$insert_data[$i]['medicaid_id'] || !$insert_data[$i]['member_id'] || !$insert_data[$i]['first_name'] || !$insert_data[$i]['last_name']
                || !$insert_data[$i]['sex'] || !$insert_data[$i]['email'] || !$insert_data[$i]['marital_status']
                || !$insert_data[$i]['date_of_birth'] || !$insert_data[$i]['primary_language'] || !$insert_data[$i]['cell_phone'] || !$insert_data[$i]['home_phone'] || !$insert_data[$i]['address'] || !$insert_data[$i]['city']
                || !$insert_data[$i]['state'] || !$insert_data[$i]['zip_code'] || !$insert_data[$i]['country']|| !$insert_data[$i]['assesment_type'])

            // if(!$insert_data[$i]['insurance_plan'])
            {
                array_push($error, $insert_data[$i]);

                //file_put_contents('test.txt',json_encode($insert_data));

                $flag = false;

                $data .= '

               <td style = "color:red">' . $k . '</td>
               ';

            } else {

                $patients = new patient_profile();
                $patients->user_id = 1;
                $patients->insurance_plan = $insert_data[$i]['insurance_plan'];
                $patients->date_received = $insert_data[$i]['date_received'];
                $patients->date_need_to_be_finished = $insert_data[$i]['date_need_to_be_finished'];
                $patients->medicaid_id = $insert_data[$i]['medicaid_id'];
                $patients->member_id = $insert_data[$i]['member_id'];
                $patients->first_name = $insert_data[$i]['first_name'];
                $patients->last_name = $insert_data[$i]['last_name'];
                $patients->sex = $insert_data[$i]['sex'];
                $patients->date_of_birth = $insert_data[$i]['date_of_birth'];
                $patients->primary_language = $insert_data[$i]['primary_language'];
                $patients->cell_phone = $insert_data[$i]['cell_phone'];
                $patients->home_phone = $insert_data[$i]['home_phone'];

                $patients->marital_status = $insert_data[$i]['marital_status'];
                $patients->email = $insert_data[$i]['email'];
                $patients->address = $insert_data[$i]['address'];

                $patients->city = $insert_data[$i]['city'];
                $patients->state = $insert_data[$i]['state'];
                $patients->zip_code = $insert_data[$i]['zip_code'];
                $patients->country = $insert_data[$i]['country'];
                $patients->assesment_type = $insert_data[$i]['assesment_type'];
                $patients->save();

                $patient_id = $patients->id;
                //$patient_address = $insert_data[$i]['address'] . ',' . $insert_data[$i]['city'];

                $patient_zip = $insert_data[$i]['zip_code'];


                $nurse = nurse_profile::get();

                for ($m = 0; $m < sizeof($nurse); $m++) {

                    $nurse_id = $nurse[$m]->id;
                    //file_put_contents('test.txt',$patient_id);
                   // $nurse_address = $nurse[$m]['prefered_location'];
                   $nurse_zip = $nurse[$m]['prefered_zip'];
                    $shortest_distance = $this->get_shortest_distance($nurse_zip, $patient_zip);

                    // $distance_table = new distance_table();
                    // $distance_table->patient_id = $patient_id;
                    // $distance_table->nurse_id = $nurse_id;
                    // $distance_table->shortest_distance = $shortest_distance;
                    // $distance_table->save();

                    $distance_table = new distance_table();
                    $distance_table->patient_id = $patient_id;
                    $distance_table->nurse_id = $nurse_id;
                    $distance_table->shortest_distance = $shortest_distance['distance'];
                    $distance_table->duration = $shortest_distance['duration'];
                    $distance_table->patient_lat = $shortest_distance['patient_lat'];
                    $distance_table->patient_lon = $shortest_distance['patient_lon'];
                    $distance_table->shortest_nurse_lat = $shortest_distance['nurse_lat'];
                    $distance_table->shortest_nurse_lon = $shortest_distance['nurse_lon'];

                    $distance_table->save();

                }

                $data .= '

               <td >' . $k . '</td>
               ';

            }

            if ($insert_data[$i]['insurance_plan']) {
                $data .= '
                    <td>' . $insert_data[$i]['insurance_plan'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }
            if ($insert_data[$i]['date_received']) {
                $data .= '
               <td>' . $insert_data[$i]['date_received'] . '</td>

               ';
            } else {
                $data .= '
               <td style="color:red">Missing Data</td>

               ';
            }
            if ($insert_data[$i]['date_need_to_be_finished']) {
                $data .= '
                    <td>' . $insert_data[$i]['date_need_to_be_finished'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';

            }

            if ($insert_data[$i]['medicaid_id']) {
                $data .= '
                    <td>' . $insert_data[$i]['medicaid_id'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }
            if ($insert_data[$i]['member_id']) {
                $data .= '
                    <td>' . $insert_data[$i]['member_id'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['first_name']) {
                $data .= '
                    <td>' . $insert_data[$i]['first_name'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['last_name']) {
                $data .= '
                    <td>' . $insert_data[$i]['last_name'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['sex']) {
                $data .= '
                    <td>' . $insert_data[$i]['sex'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';

            }

            if ($insert_data[$i]['date_of_birth']) {
                $data .= '
                    <td>' . $insert_data[$i]['date_of_birth'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }
            if ($insert_data[$i]['primary_language']) {
                $data .= '
                    <td>' . $insert_data[$i]['primary_language'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['cell_phone']) {
                $data .= '
                    <td>' . $insert_data[$i]['cell_phone'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['home_phone']) {
                $data .= '
                    <td>' . $insert_data[$i]['home_phone'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['marital_status']) {
                $data .= '
                    <td>' . $insert_data[$i]['marital_status'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['email']) {
                $data .= '
                    <td>' . $insert_data[$i]['email'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['address']) {
                $data .= '
                    <td>' . $insert_data[$i]['address'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['city']) {
                $data .= '
                    <td>' . $insert_data[$i]['city'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['state']) {
                $data .= '
                    <td>' . $insert_data[$i]['state'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['zip_code']) {
                $data .= '
                    <td>' . $insert_data[$i]['zip_code'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            if ($insert_data[$i]['country']) {
                $data .= '
                    <td>' . $insert_data[$i]['country'] . '</td>

                    ';
            } else {
                $data .= '
                    <td style="color:red">Missing Data</td>

                    ';
            }

            $data .= '

           </tr>


               ';

        }
        if ($flag == false) {

            Session::push('error', $error);
            echo $data;
        } else {
            echo "ok";
        }

    }
    public function export()
    {

        $data = Session::get('error');
        Session::pull('error');
        return Excel::download(new UsersExport($data), 'export.xlsx');

    }
}
