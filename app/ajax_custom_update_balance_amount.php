<?php include("function.php");?>
<?php 
$receipt_no = $_REQUEST['id'] ;
$value = $_REQUEST['value'] ;
$column = $_REQUEST['columnName'] ;
$columnPosition = $_REQUEST['columnPosition'];
 
if ($columnPosition == "11")
{
$result = mysqli_query($con, "UPDATE `patient_payment` SET `PP_bal` = '".$value."', `PP_date`= CURDATE() WHERE `PP_receipt_no` = '".$receipt_no."'"); 
if (!$result) { echo "Update failed"; }
else          { echo  $value; }
}

?>