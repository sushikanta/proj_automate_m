<?php require_once("function.php"); session_start();?>
<?php
$id = $_REQUEST['id'];
$value = $_REQUEST['value'];
$columnId = $_REQUEST['columnId'];
$columnPosition = $_REQUEST['columnPosition'];
$columnName = $_REQUEST['columnName'];
$user_id = $_SESSION['user_id'];

mysqli_autocommit($con, false);
$flag = true;

// voucher no
 if ($columnId == '2' && $columnPosition == '2')
    {
	 $voucher = strtoupper($value);
  	 mysqli_query($con, "UPDATE expenditure SET EX_voucher = '".$voucher."' WHERE EX_id = '$id'");
	 if (mysqli_affected_rows($con) == '0') { $flag = false; echo "Error : Same value".mysqli_error($con);}
	 // if (mysqli_affected_rows($con) == '1') { echo $value;}
	 if (mysqli_affected_rows($con) < '0') { $flag = false; echo "Error :  Technical Error !".mysqli_error($con);}
	}

// particular
 if ($columnId == '3' && $columnPosition == '3')
    {
	  $particular = ucwords($value);
  	  mysqli_query($con, "UPDATE expenditure SET EX_particular = '".$particular."' WHERE EX_id = '$id'");
	  if (mysqli_affected_rows($con) == '0') { $flag = false; echo "Error : Same value".mysqli_error($con);}
	 // if (mysqli_affected_rows($con) == '1') { echo $value;}
	 if (mysqli_affected_rows($con) < '0') { $flag = false; echo "Error :  Technical Error !".mysqli_error($con);}

	}

// receiver
 if ($columnId == '4' && $columnPosition == '4')
    {
	  $receiver = ucwords($value);
  	  mysqli_query($con, "UPDATE expenditure SET EX_person = '".$receiver."' WHERE EX_id = '$id'");
	 if (mysqli_affected_rows($con) == '0') { $flag = false; echo "Error : Same value".mysqli_error($con);}
	 // if (mysqli_affected_rows($con) == '1') { echo $value;}
	 if (mysqli_affected_rows($con) < '0') { $flag = false; echo "Error :  Technical Error !".mysqli_error($con);}

	}

// date
 if ($columnId == '5' && $columnPosition == '5')
    {
	  $date_ex = date("Y-m-d", strtotime($value));
  	  mysqli_query($con, "UPDATE expenditure SET EX_date = concat('$date_ex',' ',TIME(EX_date)) WHERE EX_id = '$id'");
	 if (mysqli_affected_rows($con) == '0') { $flag = false; echo "Error : Same value".mysqli_error($con);}
	 // if (mysqli_affected_rows($con) == '1') { echo $value;}
	 if (mysqli_affected_rows($con) < '0') {$flag = false;  echo "Error :  Technical Error !".mysqli_error($con);}

	}

	// time hr
 if ($columnId == '6' && $columnPosition == '6')
    {
	  //$time = date("H:i", strtotime($value));
  	  mysqli_query($con, "UPDATE expenditure SET EX_date = concat(DATE(EX_date),' ', '$value') WHERE EX_id = '$id'");
	 if (mysqli_affected_rows($con) == '0') { $flag = false; echo "Error : Same value".mysqli_error($con);}
	 // if (mysqli_affected_rows($con) == '1') { echo $value;}
	 if (mysqli_affected_rows($con) < '0') { $flag = false; echo "Error :  Technical Error !".mysqli_error($con);}

	}


// voucher no
 if ($columnId == '7' && $columnPosition == '7')
    {
  	  mysqli_query($con, "UPDATE expenditure SET EX_amount = '".$value."' WHERE EX_id = '$id'");
	 if (mysqli_affected_rows($con) == '0') { $flag = false; echo "Error : Same value".mysqli_error($con);}
	 // if (mysqli_affected_rows($con) == '1') { echo $value;}
	 if (mysqli_affected_rows($con) < '0') { $flag = false; echo "Error :  Technical Error !".mysqli_error($con);}
	}


/****************************
 A_book
 26 	Patient Registration
 27 	Patient Investigation
 28 	Patient Discount
 29 	Customer Profile
 30 	Expenditure

 A_action
 21		swap
 22 	Add
 23 	Edit
 24 	Cancel
 25 	Status
 33 	Deleted
 ******************************/
 $A_id = date("ynj").getCounter($con, 42);
 $remark = 'Updated on : '.$columnName.' (New value : '.$value.')';
 mysqli_query($con, "INSERT INTO audit_tbl(A_id, A_book, A_action, A_p_id, A_remark, A_user, A_date) VALUES ('$A_id', '30', '23', '$id', '".$remark."', '$user_id', NOW())");
  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error: audit_tbl " .mysqli_error($con). ".";}
  else updateCounter($con, 42);

  if($flag){
			mysqli_commit($con);
			echo $value;;
			} else {
			mysqli_rollback($con);
			echo "! "; http_response_code(404);
		}

?>