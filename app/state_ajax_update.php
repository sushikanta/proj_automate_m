<?php require_once("function.php");?>
<?php 
$id = $_REQUEST['id'];
$value = $_REQUEST['value']; 
$columnId = $_REQUEST['columnId']; 
$columnPosition = $_REQUEST['columnPosition'];
 if ($columnId == '1' && $columnPosition == '1')
    {
	  $result = mysqli_query($con, "UPDATE state_tbl SET state_name = '".$value."' WHERE state_id = '$id'"); 
	 if (mysqli_affected_rows($con) == '0') { echo "Error : Same value";}
	 if (mysqli_affected_rows($con) == '1') { echo $value;}
	 if (mysqli_affected_rows($con) == '-1') { echo "Error : Technical";}
	  }


	  /****************************
 26   Patient Registration
 29   Customer Profile
 30   Expenditure
 37   District
 38   State
 39   Dr.name
 40   Source Type
 41   Source Name

 A_action
 21   swap
 22   Add
 23   Edit
 24   Cancel
 25   Status
 27   Investigation Status
 28   Patient Discount
 31   Payment
 33   Deleted
		 ******************************/
		 $A_id = date("y").getCounter($con, 42);
		  $remark = 'Updated Name : '.$value;
		 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '38', '23', '$id', '".$remark."', '$user_id', NOW())");
		  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
		  else updateCounter($con, 42);


	 if($flag){
			mysqli_commit($con);
			echo 'ok'; }
		else {
			mysqli_rollback($con);
			echo ""; http_response_code(404); }
?>