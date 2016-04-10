<?php include("function.php");?>
<?php
 
$PT_id = $_REQUEST['id'];
$value = $_REQUEST['value']; 
$columnId = $_REQUEST['columnId']; 
$columnPosition = $_REQUEST['columnPosition']; 

if ($columnId == '3' && $columnPosition == '3')
{
	$result = mysqli_query($con, "UPDATE `patient_test` SET `PT_status_id` = '$value' WHERE `PT_sl` = '$PT_id'"); 
if (!$result) { echo "Update failed"; }
else          { echo showStatus($con, $value);}
}

mysqli_close($con);

?>