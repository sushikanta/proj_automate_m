<?php require_once("function.php");?>
<?php 
$id = $_REQUEST['id'] ;
$value = $_REQUEST['value'] ;
$columnId = $_REQUEST['columnId']; 
$columnPosition = $_REQUEST['columnPosition'];

if ($columnId == '1' && $columnPosition == '1')
    {
  	  mysqli_query($con, "UPDATE designation_tbl SET designation_name = '".$value."' WHERE designation_id = '$id'");
	  if (mysqli_affected_rows($con) <= '0') { echo "Oops ! Same value";}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist";}
	}
	
if ($columnId == '2' && $columnPosition == '2')
    {
		$short_form = strtoupper($value);
  	   mysqli_query($con, "UPDATE designation_tbl SET short_form = '".$short_form."' WHERE designation_id = '$id'");
	  if (mysqli_affected_rows($con) == '0') { echo "Oops ! Same value";}
	  if (mysqli_affected_rows($con) == '1') { echo $short_form;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist";}
	}
?>