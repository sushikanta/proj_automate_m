<?php require_once("function.php"); session_start(); ?>
<?php
$exp_id = $_REQUEST['id'];
$exp_amount = expenditure_amount($con, $exp_id);
$user_id =$_SESSION['user_id'];

/****************************
 A_book
 26 	Patient Registration
 27 	Patient Investigation
 28 	Patient Discount
 29 	Customer Profile
 30 	Expenditure
 
 A_action
 21		swap
 22 	Add
 23 	Edit
 24 	Cancel
 25 	Status
 33 	Deleted
 ******************************/
mysqli_autocommit($con, false);
$flag = true;

 $A_id = date("ynj").getCounter($con, 42);
 $remark = 'Expense Amount Rs.'.$exp_amount;
 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '30', '33', '$exp_id', '".$remark."', '$user_id', NOW())");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
  else updateCounter($con, 42);
  
  //-----Delete CANCELLED TEST = 3 TO PATIENT test
 mysqli_query($con, "DELETE FROM expenditure WHERE EX_id = '$exp_id'");
 if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error: Delete Expenditure " .mysqli_error($con). ".";}

 if($flag){
			mysqli_commit($con);
			echo 'ok';
			} else {
			mysqli_rollback($con);
			echo "! "; http_response_code(404);
		}
?>