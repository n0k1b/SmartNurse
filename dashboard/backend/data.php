<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
error_reporting(E_ALL ^ E_WARNING);
ini_set('error_log', 'ussd-app-error.log');
include("../connection.php");
extract($_POST);
	
	date_default_timezone_set('Asia/Dhaka');
   $date = date('d-m-Y');

if(isset($_POST['patient_store']))
{
	$paitent_id = $_POST['patient_id'];
	 $_SESSION['patient_id'] = $patient_id;
     $sql = "UPDATE appointment_list set status = 1 where patient_id = $patient_id and date='$date'";
     mysqli_query($conn,$sql);

}

if(isset($_POST["doctor_login"]))
{
		$email = $_POST['email'];
 		$password = $_POST['password'];
		
		file_put_contents("test_data.txt",$email." ".$password);
		
		$sql = "Select * from doctor_list where doctor_email = '$email' and doctor_password = '$password' and approved=1";
		$res = mysqli_query($conn,$sql);
		$num_rows = mysqli_num_rows($res);
		$row = mysqli_fetch_array($res);
		
		$doctor_id= $row['doctor_id'];
		
		if($num_rows != 0)
		{
		    echo "ok";
		    
		      $_SESSION['doctor_id'] = $doctor_id;
		      
		      
		   // file_put_contents("test_data.txt","ok");
		}
		else
		{
		    echo "not_ok";
		    //$_SESSION['id']=1;
		  
		}
	
}

if(isset($_POST['show_patient']))
{


     $doctor_id = $_POST["doctor_id"];

	
	date_default_timezone_set('Asia/Dhaka');
   $date2 = date('d-m-Y');
   
   //file_put_contents("rollno.txt",$date2);

	


	   $sql = "SELECT * from appointment_list where doctor_id = $doctor_id and date = '$date2' and status=0 ORDER BY id ASC ";
		$res = mysqli_query($conn,$sql); 
		$data = "";
	//file_put_contents("rollno.txt",$class.' '.$section);
		$serial_no = 0;
		while($row = mysqli_fetch_array($res))
		{
			$serial_no = $serial_no+1;
			$patient_id = $row["patient_id"];
			$sql2 = "SELECT * from patient where patient_id = $patient_id";
			$res2 = mysqli_query($conn,$sql2);
			$row2 = mysqli_fetch_array($res2);
			$patient_name = $row2['patient_name'];
			
		
			$data .= '<tr>

                     <td>'.$serial_no.'</td>
                     <td>'.$patient_name.'</td>
                    
                  <td align="center"  ><button id="pre" type="button" class="btn btn-info btn-circle" onClick= "patient('.$row['patient_id'].')"  ><i class="glyphicon glyphicon-ok"></i></button></td>

 
	           		</tr>';
			

		}
		echo $data;
	

}


//file_put_contents("data.txt",$id." ".$class." ".$roll." ".$mobile_number." ".$name);



if(isset($_POST["submit_medicine"]))
{
	    $medicine_name = $_POST['medicine_name'];
		$medicine_name = explode(',', $medicine_name);

         $medicine_time = $_POST['medicine_time'];
		$medicine_time = explode(',', $medicine_time);

		$duration = $_POST['duration'];
		$duration = explode(",", $duration);

		$remarks = $_POST['remarks'];

		$remarks = explode(",", $remarks);


		$doctor_id = $_SESSION['doctor_id'];
		$patient_id = $_SESSION['patient_id'];

		for($i=0;$i<sizeof($medicine_name);$i++)
		{
			$medicine = $medicine_name[$i];
			$time = $medicine_time[$i];
			$duration = $duration[$i];
			$remarks = $remarks[$i];

			$sql = "INSERT INTO medicine_given(doctor_id,patient_id,medicine_name,medicine_time,remarks,duration,medicine_date) VALUES($doctor_id,$patient_id,'$medicine','$time','$remarks','$duration','$date')";
			mysqli_query($conn,$sql);
		}


}

if(isset($_POST["submit_test"]))
{
	    $test_name = $_POST['test_name'];
		$test_name = explode(',', $test_name);


		$doctor_id = $_SESSION['doctor_id'];
		$patient_id = $_SESSION['patient_id'];

		for($i=0;$i<sizeof($test_name);$i++)
		{
			$t_name = $test_name[$i];

			//file_put_contents("test.txt", $t_name);
			
			$sql = "INSERT INTO test_given(doctor_id,patient_id,test_name,date) VALUES($doctor_id,$patient_id,'$t_name','$date')";
			mysqli_query($conn,$sql);
		}


}








?>














