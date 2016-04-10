<?php include("function.php");?>
<?php 
$category_id = $_REQUEST['id'] ;
$value = $_REQUEST['value'] ;
$columnID = $_REQUEST['columnId'];
 
if ($columnID == 2)
{
$result = mysqli_query($con, "UPDATE `test_category` SET `TC_dept_id`='.$value.' WHERE `test_category_id` = '$category_id'"); 
if (!$result) { echo "Update failed"; }
else          { echo  showDeptName($con, $value); }
}

?>