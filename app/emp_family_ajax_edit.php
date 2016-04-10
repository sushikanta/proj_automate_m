<?php require_once("function.php");?>
<?php
 
$id = $_REQUEST['id'];
$value = $_REQUEST['value']; 
$columnId = $_REQUEST['columnId']; 
$columnPosition = $_REQUEST['columnPosition'];

 
mysqli_autocommit($con, false);
$flag = true;

 if ($columnId == '1' && $columnPosition == '1')
    {
	  $relation = showRelation($con, $value);
	   mysqli_query($con, "UPDATE emp_family SET EF_type = '$_value' WHERE source_id = '$id'"); 
	  if (mysqli_affected_rows($con) < '0') { $flag = false; echo "ERROR: UPDATE in RELATION !"; }
	  
	  if($flag){
			mysqli_commit($con);
			echo $relation;} 
		else {
			mysqli_rollback($con);	
			echo "Something is wrong ! Action is failed"; http_response_code(404); 
		}
	  
	  }
	  
if ($columnId == '2' && $columnPosition == '2')
    {
	  $relation = showRelation($con, $value);
	   mysqli_query($con, "UPDATE emp_family SET EF_type = '$_value' WHERE source_id = '$id'"); 
	  if (mysqli_affected_rows($con) < '0') { $flag = false; echo "ERROR: UPDATE in RELATION !"; }
	  }
	  
	 
?>