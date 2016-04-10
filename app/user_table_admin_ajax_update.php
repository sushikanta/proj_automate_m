<?php require_once("function.php");?>
<?php
  $user_id = $_REQUEST['id'];
  $value = mysqli_real_escape_string($con, $_REQUEST['value']);
  $columnId = $_REQUEST['columnId'];
  $columnPosition = $_REQUEST['columnPosition'];

mysqli_autocommit($con, false);
$flag = true;

if ($columnId == '1' && $columnPosition == '1')  //username
	{
	  mysqli_query($con, "UPDATE user_table SET user_name= '".$value."' WHERE user_id='$user_id'");
	  if (mysqli_affected_rows($con) == '0') { $flag = false; echo "Oops ! Same value";}
	  if (mysqli_affected_rows($con) < '0') { $flag = false; echo mysqli_error($con);}
	 }

if ($columnId == '2' && $columnPosition == '2') //password
	{
	 $password = md5($value);
	 mysqli_query($con, "UPDATE user_table SET user_password= '".$password."' WHERE user_id='$user_id'"); 
	  if (mysqli_affected_rows($con) == '0') { $flag = false; echo "Oops ! Same value";}
	  if (mysqli_affected_rows($con) < '0') { $flag = false; echo mysqli_error($con);}
	}

if ($columnId == '3' && $columnPosition == '3') // Name
	{
	  $name = ucwords($value);
	  mysqli_query($con, "UPDATE user_table SET name = '".$name."' WHERE user_id='$user_id'"); 
	  if (mysqli_affected_rows($con) == '0') { $flag = false; echo "Oops ! Same value";}
	  if (mysqli_affected_rows($con) < '0') { $flag = false; echo mysqli_error($con);}
	 }

if ($columnId == '4' && $columnPosition == '4') // Surname
	{
	  $surname = ucwords($value);
	  mysqli_query($con, "UPDATE user_table SET surname= '".$surname."' WHERE user_id='$user_id'"); 
	   if (mysqli_affected_rows($con) == '0') { $flag = false; echo "Oops ! Same value";}
	  if (mysqli_affected_rows($con) < '0') { $flag = false; echo mysqli_error($con);}
	}

if ($columnId == '5' && $columnPosition == '5') // Department
	{
	  //$department = showDeptName($con, $value);
	   mysqli_query($con, "UPDATE user_table SET user_dept_id= '$value' WHERE user_id='$user_id'"); 
	  if (mysqli_affected_rows($con) == '0') { $flag = false; echo "Oops ! Same value";}
	  if (mysqli_affected_rows($con) < '0') { $flag = false; echo mysqli_error($con);}
	}
 
 if ($columnId == '7' && $columnPosition == '7') // status
	{
	  mysqli_query($con, "UPDATE user_table SET user_status= '$value' WHERE user_id='$user_id'"); 
	  if (mysqli_affected_rows($con) == '0') { $flag = false; echo "Oops ! Same value";}
	  if (mysqli_affected_rows($con) < '0') { $flag = false; echo mysqli_error($con);}
	}

if($flag){  mysqli_query($con, "UPDATE user_table SET user_date = NOW() WHERE user_id='$user_id'"); mysqli_commit($con); echo $value; } else { mysqli_rollback($con); echo " "; }

?>