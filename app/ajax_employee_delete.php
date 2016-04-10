<?php include("config.php"); ?>
<?php
$emp_sl = $_REQUEST['id'] ;

$result = mysqli_query($con, "DELETE FROM `employee_tbl`, `employee_letter`, `emp_prev_company`, `emp_qualification_tbl` USING `employee_tbl` LEFT JOIN `employee_letter` ON `employee_letter`.`EL_emp_sl` = `employee_tbl`.`EMP_sl` LEFT JOIN `emp_prev_company` ON `emp_prev_company`.`PC_emp_sl` = `employee_tbl`.`EMP_sl` LEFT JOIN `emp_qualification_tbl` ON `emp_qualification_tbl`.`EQ_emp_sl` = `employee_tbl`.`EMP_sl` WHERE `employee_tbl`.`EMP_sl` = '$emp_sl'");

if(!$result)
 	{ echo "Delete Failed !";}
else{ echo "ok";}

mysqli_close($con);

?>