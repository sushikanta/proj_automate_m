<?php require_once("function.php");?>
<?php 
$id = $_REQUEST['id'];
$value = $_REQUEST['value']; 
$columnId = $_REQUEST['columnId']; 
$columnPosition = $_REQUEST['columnPosition'];
 if ($columnId == '1' && $columnPosition == '1')
    {
	  $_value = ucwords($value);
	  $result = mysqli_query($con, "UPDATE source_tbl SET source_name = '".$_value."' WHERE source_id = '$id'"); 
	  if (mysqli_affected_rows($con) == '0') { echo "Oops : Same Value"; }
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops : Duplicate Entry OR Technical Problem";}
	}
?>