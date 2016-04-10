<?php require_once("function.php"); ?>

<?php
resetCounter($con, 5, 'yy');
$category_name = ucwords(mysqli_real_escape_string($con, $_REQUEST['category_name']));
$department_id = mysqli_real_escape_string($con, $_REQUEST['department']);
$test_category_id = date("y").getCounter($con, 5);

mysqli_autocommit($con, false);
$flag = true;

mysqli_query($con, "INSERT INTO test_category(test_category_id, test_category_name, TC_dept_id) VALUES ('$test_category_id', '".$category_name."', '$department_id')");

if(mysqli_affected_rows($con) <= 0){ $flag = false; echo "Error details: " . mysqli_error($con) . ".";} // { $flag = false; echo "";} //
	else updateCounter($con, 5);
 
if($flag){
			mysqli_commit($con);
			echo $test_category_id;
			} 
		else {
			mysqli_rollback($con);	
			echo "Something is wrong ! Action is failed"; http_response_code(404); 
			}

?>