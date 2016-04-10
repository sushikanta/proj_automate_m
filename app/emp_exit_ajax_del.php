<?php require_once("config.php"); ?>
<?php
$id = $_REQUEST['id'];

mysqli_autocommit($con, false);
$flag = true;

mysqli_query($con, "UPDATE `emp_tbl` SET ET_status ='1' WHERE ET_ei_id IN (SELECT EE_ei_id FROM emp_exit_tbl WHERE EE_id = '$id')");	
if(mysqli_affected_rows($con) < 0){ $flag = false; echo "Error details: " . mysqli_error($con) . ".";} // { $flag = false; echo "";} //

mysqli_query($con, "DELETE FROM emp_exit_tbl WHERE EE_id = '$id'");
if(mysqli_affected_rows($con) < 0){ $flag = false; echo "Error details: " . mysqli_error($con) . ".";} // { $flag = false; echo "";} //



if($flag){
			mysqli_commit($con);
			echo 'ok';
			} 
		else {
			mysqli_rollback($con);	
			echo "Something is wrong ! Action is failed"; http_response_code(404); 
			}
?>