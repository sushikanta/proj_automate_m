<?php include("function.php");?>
<?php
 
$UTC_id = $_REQUEST['id'] ;
$value = mysqli_real_escape_string($con, $_REQUEST['value']); 
$columnId = $_REQUEST['columnId'] ; 
$columnPosition = $_REQUEST['columnPosition'] ; 

if ($columnId == '1' && $columnPosition == '1')
{
$result = mysqli_query($con, "UPDATE `user_technician_tbl` SET `UTC_user_name`= '".$value."' WHERE `UTC_id` = '$UTC_id' AND `UTC_dept_id` = '4'"); 
if (!$result) { echo "Update failed"; }
else          { echo  $value; }
}

if ($columnId == '2' && $columnPosition == '2')
{
$result = mysqli_query($con, "UPDATE `user_technician_tbl` SET `UTC_full_name`= '".$value."' WHERE `UTC_id` = '$UTC_id' AND `UTC_dept_id` = '4'"); 
if (!$result) { echo "Update failed"; }
else          { echo  $value; }
}

mysqli_close($con);
?>