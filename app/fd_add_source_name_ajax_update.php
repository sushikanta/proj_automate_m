<?php require_once("config.php");?>
<?php
$id = $_REQUEST['id'];
$value = $_REQUEST['value'];
$columnId = $_REQUEST['columnId'];
$columnPosition = $_REQUEST['columnPosition'];
 // name
 if ($columnId == '1' && $columnPosition == '1')
    {
	 $name = ucwords($value);
  	 mysqli_query($con, "UPDATE referred_tbl SET referred_name = '".$name."' WHERE referred_id = '$id'");
	 if (mysqli_affected_rows($con) == '0') { echo "Error : Same value";}
	 if (mysqli_affected_rows($con) == '1') { echo $value;}
	 if (mysqli_affected_rows($con) == '-1') { echo "Error : '".$value."' already Exist OR Technical";}
	}

 // source
 if ($columnId == '2' && $columnPosition == '2')
		  	{
		  
	mysqli_query($con, "UPDATE referred_tbl SET source_id = '$value' WHERE referred_id = '$id'");
	 if (mysqli_affected_rows($con) == '0') { echo "Error : Same value";}
	 if (mysqli_affected_rows($con) == '1') { echo $value;}
	 if (mysqli_affected_rows($con) == '-1') { echo "Error : '".$value."' already Exist OR Technical";}
 }

?>