<?php require_once("function.php");?>
<?php 
$id = $_REQUEST['id'];
$value = $_REQUEST['value']; 
$columnId = $_REQUEST['columnId']; 
$columnPosition = $_REQUEST['columnPosition'];

 if ($columnId == '2' && $columnPosition == '2')
    {
	  $v_date = date("Y-m-d", strtotime($value));
	   mysqli_query($con, "UPDATE price_version SET PV_date = '".$v_date."' WHERE PV_id = '$id'");
	    if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	    if (mysqli_affected_rows($con) == '1') { echo $value;}
	    if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}	 
	  }
	  
/*if ($columnId == '3' && $columnPosition == '3')
    {
	  if($value ==1){$status = 'Current';} if($value ==2){$status = 'Old';}; 
	   mysqli_query($con, "UPDATE price_version SET PV_status = '$value' WHERE PV_id = '$id'"); 
		if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	    if (mysqli_affected_rows($con) == '1') { echo $value;}
	    if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}	 
	  
	  }
	  */
	 
?>