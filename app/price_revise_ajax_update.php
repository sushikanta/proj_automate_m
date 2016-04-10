<?php require_once("function.php"); session_start();?>
<?php
$test_id = $_REQUEST['id'];
$value = mysqli_real_escape_string($con, $_REQUEST['value']);
$columnId = $_REQUEST['columnId'];
$columnPosition = $_REQUEST['columnPosition'];
$user_id = $_SESSION['user_id'];

mysqli_autocommit($con, false);
$flag = true;

if ($columnId == '6' && $columnPosition == '6')
{	
   $result_cv = mysqli_query($con, "SELECT PV_id FROM price_version WHERE PV_status ='1'");
   { while($row1=mysqli_fetch_array($result_cv))
      $cur_version=$row1['PV_id'];}
 
     $check = mysqli_query($con, "SELECT PD_sl FROM price_dump d WHERE d.PD_test_id = '$test_id' AND PD_version ='$cur_version'");
	if(mysqli_num_rows($check) !=0)  // RECORD = YES
 	  {
	  while($row=mysqli_fetch_array($check))
      $PD_sl=$row['PD_sl'];
	  mysqli_autocommit($con, false);
	  $flag = true;
	  mysqli_query($con, "UPDATE price_dump SET PD_test_id = '$test_id', PD_price = '".$value."' WHERE PD_sl = '$PD_sl'");
	  if (mysqli_affected_rows($con) < '0') { $flag = false; echo "ERROR: UPDATE price_dump !"; }
	  
	  mysqli_query($con, "UPDATE test_tbl SET test_price = '".$value."' WHERE test_id = '$test_id'"); 
	  if (mysqli_affected_rows($con) < '0') { $flag = false; echo "ERROR:test_tbl"; }
	  
	  if($flag){
			mysqli_commit($con);
			echo $value;} 
		else {
			mysqli_rollback($con);	
			echo "Something is wrong ! Action is failed"; http_response_code(404); 
		}
	  
	  }
 else{	// RECORD = NO
	 
	 
	  mysqli_autocommit($con, false);
	  $flag = true;
	 $PD_sl_x = date("y").getCounter($con, 15);  //price_dump		 
	 mysqli_query($con, "INSERT INTO price_dump(PD_sl, PD_test_id, PD_price, PD_version) VALUES ('$PD_sl_x', '$test_id', '".$value."', '$cur_version')");
	 if(mysqli_affected_rows($con) <= 0) { $flag = false; echo " Error in INSERT Price_dump";}
	 else updateCounter($con, 15);
	 
	  mysqli_query($con, "UPDATE test_tbl SET test_price = '".$value."' WHERE test_id = '$test_id'"); 
	  if (mysqli_affected_rows($con) < '0') { $flag = false; echo "ERROR:test_tbl"; } 
	  
	  if($flag){
			mysqli_commit($con);
			echo $value;} 
		else {
			mysqli_rollback($con);	
			echo "Something is wrong ! Action is failed"; http_response_code(404); 
		}
	  
	 }
	
	

}