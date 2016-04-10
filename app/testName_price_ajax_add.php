<?php require_once("function.php"); ?>
<?php
	 resetCounter($con, 9, 'yy');

	  $test_name = ucwords(mysqli_real_escape_string($con, $_REQUEST['test_name']));
	  $short_form = ucwords(mysqli_real_escape_string($con, $_REQUEST['short_form']));
	  $test_price = mysqli_real_escape_string($con, $_REQUEST['price']);
	  $category = mysqli_real_escape_string($con, $_REQUEST['category']);
	   $test_id = getCounter($con, 10);

	   mysqli_autocommit($con, false);
	   $flag = true;

mysqli_query($con, "INSERT INTO test_tbl(test_id, test_name, test_short_form, test_category_id, test_price) VALUES ('$test_id', '".$test_name."', '".$short_form."', '$category', '".$test_price."')");
 if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " Error in patient_info insert !";}
	    else updateCounter($con, 10);

 if($flag){
			mysqli_commit($con);
			echo $test_id;
			} else {
			mysqli_rollback($con);
			echo "Result : Action is failed"; http_response_code(404);
			}
?>