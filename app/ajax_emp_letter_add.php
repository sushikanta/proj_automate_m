<?php require_once("function.php"); ?>
<?php 

$EL_sl = getCounter_value($con, 26);

$hidden_emp_sl = mysqli_real_escape_string($con, $_REQUEST['hidden_emp_sl']);

$letter_type = mysqli_real_escape_string($con, $_REQUEST['letter_type']);
$letter_detail = mysqli_real_escape_string($con, $_REQUEST['letter_detail']);
$letter_date = date("y-m-d", strtotime($_REQUEST['letter_date']));


$result = mysqli_query($con, "INSERT INTO `employee_letter`(`EL_sl`, `EL_emp_sl`, `EL_letter_type_id`, `EL_letter_detail`, `EL_date`) VALUES ('$EL_sl', '$hidden_emp_sl', '.$letter_type.', '".$letter_detail."', '".$letter_date."')"); 
if (!$result) { echo "Insert failed !"; }
else          { echo "ok"; }
mysqli_close($con);
?>