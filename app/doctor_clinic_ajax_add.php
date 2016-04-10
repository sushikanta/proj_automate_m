<?php require_once("function.php"); ?>
<?php 
resetCounter($con, 17, 'yy');
$dr_id = mysqli_real_escape_string($con, $_REQUEST['dr_id']);
$clinic_name = ucwords(mysqli_real_escape_string($con, $_REQUEST['clinic_name']));
$clinic_address = ucwords(mysqli_real_escape_string($con, $_REQUEST['clinic_address']));
$clinic_phone = mysqli_real_escape_string($con, $_REQUEST['clinic_phone']);

$clinic_id = date('y').getCounter($con, 17);
mysqli_autocommit($con, false);
$flag = true;

mysqli_query($con, "INSERT INTO dr_clinic_tbl(DC_id, DC_dr_id, DC_clinic, DC_address, DC_phone) VALUES ('$clinic_id', '$dr_id', '".$clinic_name."', '".$clinic_address."', '".$clinic_phone."')"); 
if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " error: ". mysqli_error($con);}
else updateCounter($con, 17);

	if($flag){
			mysqli_commit($con);
			echo $clinic_id; } 
		else {
			mysqli_rollback($con);	
			echo "Action failed"; http_response_code(404); }
?>