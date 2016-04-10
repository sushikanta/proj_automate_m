<?php include("function.php");?>
<?php 
$test_id = $_REQUEST['id'] ;
$test_price = $_REQUEST['value'] ;
$columnID = $_REQUEST['columnId'];
$columnPosition = $_REQUEST['columnPosition'];
 
if ($columnID == '4' && $columnPosition == '3')
{
$result = mysqli_query($con, "UPDATE `test_tbl` SET `test_price` = '$test_price' WHERE `test_id` = '$test_id'"); 
if (!$result) { echo "Update failed"; }
else          { echo  $test_price; }
}

mysqli_close($con);
?>