<?php include("function.php");?>
<?php
 
$hidden_comp_id = $_REQUEST['hidden_comp_id'];
$hidden_emp_id = $_REQUEST['hidden_emp_id'];
$prev_comp = $_REQUEST['prev_comp'];
$company_address = $_REQUEST['company_address'];
$company_dept = $_REQUEST['company_dept'];
$prev_designation = $_REQUEST['prev_designation'];
$joined_date = date("Y-m-d", strtotime($_REQUEST['joined_date']));
$last_date = date("Y-m-d", strtotime($_REQUEST['last_date']));
$total_year = $_REQUEST['total_year']; 
$update_date = date("Y-m-d");

$result = mysqli_query($con, "UPDATE `emp_prev_company` SET `company_name`= '".$prev_comp."',`prev_comp_address`= '".$company_address."',`prev_depmt`= '".$company_dept."',`prev_position`= '".$prev_designation."',`prev_joined_date`= '".$joined_date."',`prev_exit_date`= '".$last_date."',`total_year`='".$total_year."',`update_date`= '".$update_date."' WHERE `emp_prev_comp_id` = '$hidden_comp_id'");

if (!$result) { echo "Update failed"; }
else          { echo "ok"; }
 
mysqli_close($con);
?>