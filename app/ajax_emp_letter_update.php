<?php require_once("function.php");?>
<?php
 
$EL_sl = mysqli_real_escape_string($con, $_REQUEST['hidden_EL_sl']);
$letter_type = mysqli_real_escape_string($con, $_REQUEST['letter_type']);
$letter_detail = mysqli_real_escape_string($con, $_REQUEST['letter_detail']);
$letter_date = date("Y-m-d", strtotime($_REQUEST['letter_date']));

$result = mysqli_query($con, "UPDATE `employee_letter` SET `EL_letter_type_id`= '.$letter_type.', `EL_letter_detail` = '".$letter_detail."',`EL_date` = '".$letter_date."' WHERE `EL_sl` = '$EL_sl'");

if (!$result) { echo "Update failed !"; }
else          { echo "ok"; }
 
mysqli_close($con);
?>