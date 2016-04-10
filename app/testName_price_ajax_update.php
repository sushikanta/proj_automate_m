<?php require_once("function.php");?>
<?php 
$test_id = $_REQUEST['id'] ;
$value = ucwords(mysqli_real_escape_string($con, $_REQUEST['value'])); 
$columnId = $_REQUEST['columnId'] ; 
$columnPosition = $_REQUEST['columnPosition'] ; 

if ($columnId == '1' && $columnPosition == '1')
{
mysqli_query($con, "UPDATE `test_tbl` SET `test_name` = '".$value."' WHERE `test_id` = '$test_id'"); 
	  if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}
}

if ($columnId == '2' && $columnPosition == '2')
{
mysqli_query($con, "UPDATE `test_tbl` SET `test_short_form` = '".$value."' WHERE `test_id` = '$test_id'"); 
	  if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}}

if ($columnId == '4' & $columnPosition == '4')
{
$category_name = showCategory_name($con, $value);
$result = mysqli_query($con, "UPDATE `test_tbl` SET `test_category_id`='.$value.' WHERE `test_id` = '$test_id'"); 
	  if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	  if (mysqli_affected_rows($con) == '1') { echo $category_name;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}
}
?>