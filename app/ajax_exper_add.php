<?php require_once("function.php"); ?>
<?php 
$emp_prev_comp_id = getCounter_value($con, 22);
$prev_comp = ucwords(mysqli_real_escape_string($con, $_REQUEST['prev_comp']));
$company_address = ucwords(mysqli_real_escape_string($con, $_REQUEST['company_address']));
$company_dept = ucwords(mysqli_real_escape_string($con, $_REQUEST['company_dept']));
$prev_designation = ucwords(mysqli_real_escape_string($con, $_REQUEST['prev_designation']));
$joined_date = date("Y-m-d", strtotime($_REQUEST['joined_date']));
$last_date = date("Y-m-d", strtotime($_REQUEST['last_date']));
$total_year = mysqli_real_escape_string($con, $_REQUEST['total_year']);
$emp_sl = mysqli_real_escape_string($con, $_REQUEST['hidden_emp_sl']);

$result = mysqli_query($con, "INSERT INTO `emp_prev_company`(`emp_prev_comp_id`, `PC_emp_sl`, `company_name`, `prev_comp_address`, `prev_depmt`, `prev_position`, `prev_joined_date`, `prev_exit_date`, `total_year`) VALUES ('.$emp_prev_comp_id.', '.$emp_sl.', '".$prev_comp."', '".$company_address."', '".$company_dept."', '".$prev_designation."' , '".$joined_date."' , '".$last_date."', '".$total_year."')"); 
if (!$result) { echo "Insert failed !"; }
else          { echo "ok"; }
mysqli_close($con);
?>