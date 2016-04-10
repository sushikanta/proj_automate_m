<?php require_once("function.php");?>
<?php
$test_category_id = $_REQUEST['id'];
$value = $_REQUEST['value'];
$columnId = $_REQUEST['columnId'];
$columnPosition = $_REQUEST['columnPosition'];



if ($columnId == '1' && $columnPosition == '1')
{
 	  mysqli_query($con, "UPDATE test_category SET test_category_name = '".$value."' WHERE test_category_id = '$test_category_id'");
 	  if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}
}

if ($columnId == '2' && $columnPosition == '2')
{
$dept_name = showDeptName($con, $value);
      mysqli_query($con, "UPDATE test_category SET TC_dept_id = '$value' WHERE test_category_id = '$test_category_id'"); 
	  if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}
}

?>