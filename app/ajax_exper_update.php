<?php require_once("config.php");?>
<?php
 
$hidden_comp_id = mysqli_real_escape_string($con, $_REQUEST['hidden_comp_id']);
$hidden_emp_id = mysqli_real_escape_string($con, $_REQUEST['hidden_emp_id']);
$prev_comp = ucwords(mysqli_real_escape_string($con, $_REQUEST['prev_comp']));
$company_address = ucwords(mysqli_real_escape_string($con, $_REQUEST['company_address']));
$company_dept = ucwords(mysqli_real_escape_string($con, $_REQUEST['company_dept']));
$prev_designation = ucwords(mysqli_real_escape_string($con, $_REQUEST['prev_designation']));
$joined_date = date("Y-m-d", strtotime($_REQUEST['joined_date']));
$last_date = date("Y-m-d", strtotime($_REQUEST['last_date']));
$total_year = mysqli_real_escape_string($con, $_REQUEST['total_year']); 

$result = mysqli_query($con, "UPDATE `emp_prev_company` SET `company_name`= '".$prev_comp."',`prev_comp_address`= '".$company_address."',`prev_depmt`= '".$company_dept."',`prev_position`= '".$prev_designation."',`prev_joined_date`= '".$joined_date."',`prev_exit_date`= '".$last_date."',`total_year`='".$total_year."' WHERE `emp_prev_comp_id` = '$hidden_comp_id'");

if (!$result) { echo "Update failed"; }
else          { echo "ok"; }
 
mysqli_close($con);
?>