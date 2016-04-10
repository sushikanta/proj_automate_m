<?php require_once("function.php"); ?>
<?php	
	resetCounter($con, 3, 'yy');
	$source_type = mysqli_real_escape_string($con, $_REQUEST['source_type']);
		$source_id = date("y").getCounter($con, 3);
		$source_type = ucwords($source_type);

  	mysqli_autocommit($con, false);
    $flag = true;
	
	mysqli_query($con, "INSERT INTO source_tbl(source_id, source_name) VALUES ('$source_id', '".$source_type."')");
	  if (mysqli_affected_rows($con) <= '0') { $flag = false; echo " ". mysqli_error($con);}
	  else updateCounter($con, 3);
	 
	 if($flag){
			mysqli_commit($con);
			echo $source_id; }
		else {
			mysqli_rollback($con);	
		echo ""; http_response_code(404);}
?>