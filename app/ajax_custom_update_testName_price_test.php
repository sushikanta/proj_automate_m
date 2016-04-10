<?php include("function.php");?>
<?php 
$test_id = $_REQUEST['id'] ;
$test_name = $_REQUEST['value'] ;
$columnID = $_REQUEST['columnId'];
$columnPosition = $_REQUEST['columnPosition'];
 
if ($columnID == '2' && $columnPosition == '1')
{
$result = mysqli_query($con, "UPDATE `test_tbl` SET `test_name` = '".$test_name."' WHERE `test_id` = '$test_id'"); 
if (!$result) { echo "Update failed"; }
else          { echo  $test_name; }
}
?>