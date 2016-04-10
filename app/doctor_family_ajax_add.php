<?php include("function.php"); ?>
<?php
resetCounter($con, 18, 'yy');
$dr_id = mysqli_real_escape_string($con, $_REQUEST['hidden_dr_id']);
$family_name = ucwords(mysqli_real_escape_string($con, $_REQUEST['family_name']));
$family_relation = ucwords(mysqli_real_escape_string($con, $_REQUEST['family_relation']));
$family_dob = date("Y-m-d", strtotime($_REQUEST['family_dob']));

$id = date('y').getCounter($con, 18);
mysqli_autocommit($con, false);
$flag = true;

mysqli_query($con, "INSERT INTO dr_family_tbl(DF_id, DF_dr_id, DF_name, DF_relation, DF_dob) VALUES ('$id', '$dr_id', '".$family_name."', '".$family_relation."', '".$family_dob."')"); 
if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " error: ". mysqli_error($con);}
else updateCounter($con, 18);

	if($flag){
			mysqli_commit($con);
			echo $id; } 
		else {
			mysqli_rollback($con);	
			echo "Action failed"; http_response_code(404); }



?>