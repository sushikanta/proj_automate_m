<?php require_once("function.php");


$dr_id="1";
$start="2014-06-01";
$stop="2014-06-02";



$result = mysqli_query($con, "SELECT COUNT(*) AS total FROM patient_registration WHERE pr_dr_prescription = '".$dr_id."'"); 
  if (mysqli_num_rows($result)==0) 
		 { echo "0"; }
	   else{while($row = mysqli_fetch_array($result)) {echo $row['total'];}
	}



echo doctorWise_registration($con, $dr_id, $start, $stop);


?>