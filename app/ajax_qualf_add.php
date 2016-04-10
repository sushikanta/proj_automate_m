<?php require_once("function.php"); ?>
<?php 
$emp_qualf_id = getCounter_value($con, 21);

$emp_sl = mysqli_real_escape_string($con, $_REQUEST['hidden_emp_sl']);
$emp_qualf_name = ucwords(mysqli_real_escape_string($con, $_REQUEST['emp_qualf']));
$emp_faculty = ucwords(mysqli_real_escape_string($con, $_REQUEST['faculty']));
$emp_institute = ucwords(mysqli_real_escape_string($con, $_REQUEST['institute']));
$emp_univ = ucwords(mysqli_real_escape_string($con, $_REQUEST['board_univ']));
$mark_obtained = mysqli_real_escape_string($con, $_REQUEST['mark_obt']);
$total_mark = mysqli_real_escape_string($con, $_REQUEST['total']);
$per_grad = ucwords(mysqli_real_escape_string($con, $_REQUEST['per_grade']));
$result = ucwords(mysqli_real_escape_string($con, $_REQUEST['division']));
$passing_year = mysqli_real_escape_string($con, $_REQUEST['passing_year']);
$course_duration = mysqli_real_escape_string($con, $_REQUEST['course_duration']);

$result = mysqli_query($con, "INSERT INTO `emp_qualification_tbl`(`emp_qualf_id`, `EQ_emp_sl`, `emp_qualf_name`, `emp_faculty`, `emp_institute`, `emp_univ`, `mark_obtained`, `total_mark`, `per_grad`, `result`, `passing_year`, `course_duration`) VALUES ('.$emp_qualf_id.', '.$emp_sl.', '".$emp_qualf_name."', '".$emp_faculty."', '".$emp_institute."', '".$emp_univ."' , '.$mark_obtained.' , '.$total_mark.', '".$per_grad."', '".$result."', '.$passing_year.', '".$course_duration."')"); 

if (!$result) { echo "Insert failed !"; }
else          { echo "ok"; }
mysqli_close($con);
?>