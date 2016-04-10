<?php include("function.php");?>
<?php 
$test_id = $_REQUEST['id'] ;
$category_id = $_REQUEST['value'] ;
$columnID = $_REQUEST['columnId'];
$columnPosition = $_REQUEST['columnPosition'];
$value = showCategory_name($con, $category_id);
 
if ($columnID == '5' & $columnPosition == '4')
{
$result = mysqli_query($con, "UPDATE `test_tbl` SET `test_category_id`='.$category_id.' WHERE `test_id` = '$test_id'"); 
if (!$result) { echo "Update failed"; }
else          { echo $value; }
}
?>