<?php require_once("function.php"); ?>
<?php
	  resetCounter($con, 19, 'yy');
	  
	  $department_name = ucwords($_REQUEST['department_name']);
	  mysqli_autocommit($con, false);
	  $flag = true;
	  
	  $sl_no = date("y").getCounter($con, 19);
	  
	  mysqli_query($con, "INSERT INTO department_tbl(department_id, department_name) VALUES ('$sl_no','".$department_name."')");
	  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " ". mysqli_error($con);}
	  else updateCounter($con, 19);
	  
	  if($flag){ mysqli_commit($con); echo $sl_no; } else { mysqli_rollback($con); echo " "; http_response_code(404); }
?>