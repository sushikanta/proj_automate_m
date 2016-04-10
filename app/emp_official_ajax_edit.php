<?php require_once("function.php");?>
<?php
$id = $_REQUEST['id'];
$value = $_REQUEST['value'];
$columnId = $_REQUEST['columnId'];
$columnPosition = $_REQUEST['columnPosition'];

// emp_no
 if ($columnId == '1' && $columnPosition == '1')
    {
  	  $result = mysqli_query($con, "UPDATE emp_tbl SET ET_emp_no = '".$value."' WHERE ET_id = '$id'");
	  if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}
	}

 // emp_Position
 if ($columnId == '2' && $columnPosition == '2')
    {
  	  $result = mysqli_query($con, "UPDATE emp_tbl SET ET_desig_id = '$value' WHERE ET_id = '$id'");
	  if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}
	}

// emp_Department
 if ($columnId == '3' && $columnPosition == '3')
    {
  	  $result = mysqli_query($con, "UPDATE emp_tbl SET ET_dept_id = '$value' WHERE ET_id = '$id'");
	  if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}
	}

 // emp_Position
 if ($columnId == '4' && $columnPosition == '4')
    {
  	  $result = mysqli_query($con, "UPDATE emp_tbl SET ET_report_to = '$value' WHERE ET_id = '$id'");
	  if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}
	}

// DATE
 if ($columnId == '5' && $columnPosition == '5')
    {
      $date = str_replace('/', '-', $value);
	  $join_date = date("Y-m-d", strtotime($date));
  	  $result = mysqli_query($con, "UPDATE emp_tbl SET ET_join_date = '".$join_date."' WHERE ET_id = '$id'");
	  if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}
	}
// salary
 if ($columnId == '6' && $columnPosition == '6')
    {
  	  $result = mysqli_query($con, "UPDATE emp_tbl SET ET_salary = '".$value."' WHERE ET_id = '$id'");
	  if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}
	}

// salary
 if ($columnId == '7' && $columnPosition == '7')
    {
  	  $result = mysqli_query($con, "UPDATE emp_tbl SET ET_ctc = '".$value."' WHERE ET_id = '$id'");
	  if (mysqli_affected_rows($con) == '0') { echo "Oops ! Nothing is change"; http_response_code(405);}
	  if (mysqli_affected_rows($con) == '1') { echo $value;}
	  if (mysqli_affected_rows($con) == '-1') { echo "Oops ! Already Exist"; http_response_code(405);}
	}
?>