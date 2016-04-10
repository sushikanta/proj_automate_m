<?php require_once("function.php"); ?>

<?php 
$pt_sl = date("jmy").getCounter_value($con, 16);
$receipt_no = $_REQUEST['hidden_receipt_no'];
$patient_id = $_REQUEST['hidden_patient_id'];
$test_id = $_REQUEST['hidden_test_id'];
$dept_id = $_REQUEST['hidden_dept_id'];
$test_name = $_REQUEST['test_name'];
$test_price = $_REQUEST['test_price'];

$result = mysqli_query($con, "INSERT INTO patient_test(PT_sl, PT_receipt_no, PT_patient_id, PT_test_id, PT_test_name, PT_test_price, PT_dept_id, PT_status_id, PT_status_date1, PT_status_date2) VALUES  ('$pt_sl', '".$receipt_no."', '.$patient_id.', '.$test_id.', '".$test_name."', '".$test_price."', '.$dept_id.', '1', NOW(), NOW())"); 

if (!$result) { echo "Add failed !"; }
else          { echo "ok"; }

mysqli_free_result($result);
mysqli_close($con);
?>