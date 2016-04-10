<?php require_once("function.php"); ?>
<?php

	resetCounter($con, 23, 'yy');
	$ref_name = mysqli_real_escape_string($con, $_REQUEST['ref_name']);
	$source_id = mysqli_real_escape_string($con, $_REQUEST['source_id']);

		$ref_id = date("y").getCounter($con, 23);
		$ref_name_x = ucwords($ref_name);

 	mysqli_autocommit($con, false);
    $flag = true;

	mysqli_query($con, "INSERT INTO referred_tbl(referred_id, referred_name, source_id) VALUES ('$ref_id', '".$ref_name_x."', '$source_id')");
	  if (mysqli_affected_rows($con) <= '0') { $flag = false; echo "ERROR : ".mysqli_error($con).'';}
	  else updateCounter($con, 23);

	 if($flag){
			mysqli_commit($con);
			echo $ref_id; }
		else {
			mysqli_rollback($con);
			echo ""; http_response_code(404); }
?>