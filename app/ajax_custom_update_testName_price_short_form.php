<?php include("function.php");?>
<?php 
$test_id = $_REQUEST['id'] ;
$short_form = $_REQUEST['value'] ;
$columnID = $_REQUEST['columnId'];
$columnPosition = $_REQUEST['columnPosition'];
 
if ($columnID == '3' && $columnPosition == '2')
{
$result = mysqli_query($con, "UPDATE `test_tbl` SET `test_short_form` = '$short_form' WHERE `test_id` = '$test_id'"); 
if (!$result) { echo "Update failed"; }
else          { echo  $short_form; }
}

?>