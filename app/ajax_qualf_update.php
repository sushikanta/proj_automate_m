<?php include("config.php");?>
<?php 

$emp_qualf_id = mysqli_real_escape_string($con, $_REQUEST['hidden_qualf_id']);
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

$result = mysqli_query($con, "UPDATE `emp_qualification_tbl` SET `emp_qualf_name`= '".$emp_qualf_name."',`emp_faculty`='".$emp_faculty."',`emp_institute`= '".$emp_institute."',`emp_univ`='".$emp_univ."',`mark_obtained`= '.$mark_obtained.',`total_mark`='.$total_mark.',`per_grad`='".$per_grad."',`result`='".$result."',`passing_year`='".$passing_year."',`course_duration`='".$course_duration."' WHERE `emp_qualf_id` = '$emp_qualf_id'");

if (!$result) { echo "Update failed"; }
else          { echo "ok"; }
 
mysqli_close($con);
?>