<?php require_once("config.php"); ?>
<?php
$disc_code_sl = $_REQUEST['id'];

$result = mysqli_query($con, "DELETE FROM `discount_tbl` WHERE `disc_status` = 'P' AND `disc_code_sl` = '$disc_code_sl' limit 1");
$num = mysqli_affected_rows($con);
if ($num <= 0) 
	{ echo "Discount Code was already used or technical problem."; }
else{ echo 'ok'; }     
?>