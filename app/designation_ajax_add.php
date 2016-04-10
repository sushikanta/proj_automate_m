<?php require_once("function.php"); ?>
<?php 
resetCounter($con, 20, 'yy');
$designation_name = ucwords($_REQUEST['designation_name']);
$short_form = strtoupper($_REQUEST['short_form']);

mysqli_autocommit($con, false);
$flag = true;

$sl_no = date('y').getCounter($con, 20); 			// designation id

mysqli_query($con, "INSERT INTO designation_tbl(designation_id, designation_name, short_form) VALUES ('$sl_no', '".$designation_name."', '".$short_form."')"); 
if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " ". mysqli_error($con);}
	else updateCounter($con, 20);

	if($flag){
			mysqli_commit($con);
			echo $sl_no; } 
		else {
			mysqli_rollback($con);	
			echo " ! "; http_response_code(404); }
?>