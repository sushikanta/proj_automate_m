<?php require_once("config.php");?>
<?php

/*----------------- LOGIN - INDEX -----------------------*/
function validateUsername($con, $username, $password){	
	$result = mysqli_query($con, "SELECT id, full_name, role FROM user WHERE username = '".$username."' AND password = '".$password."' LIMIT 1");
	if (mysqli_num_rows($result) == 0) 
       header("location: index.php?errmsg=1");
	   else
	    {
		  while($row = mysqli_fetch_array($result)) 
		   {
			 $user_id = $row['id'];
			 $name = $row['full_name'];
			 $role = $row['role'];
			 $status = $row['status'];
		   }
		  if ($status == '36') 
      		 header("location: index.php?errmsg=2");
		  else{
		   if($role == '33') //Admin
		     {
			  $_SESSION['okay'] = 'okadmin';
			  $_SESSION['user_id'] = $user_id;
			  $_SESSION['name'] = $name;			 
			  $_SESSION['role'] = $role;			 
			  header("location: dashboard_ui.php");			  
			  }
		  if($role == '34') // OTHER users/front desk
		     {
			  $_SESSION['okay'] = 'okstaff';
			  $_SESSION['user_id'] = $user_id;
			  $_SESSION['name'] = $name;			 
			  $_SESSION['role'] = $role;			 		 
			  header("location: dashboard_ui.php");			  
			  }
		  }
		 }
}


function error_message($con, $id){
			if ($id =='1'){ return 'Invalid Username & Password, please recheck.'; }
			if ($id =='2'){ return 'Username was disabled, please contact system admin.'; }
			if ($id =='3'){ return 'Please login first.'; }
			if ($id =='4'){ return 'Opps ! something is wrong in ADD'; }
			if ($id =='5'){ return 'Opps ! something is wrong in EDIT'; }
			if ($id =='6'){ return 'Opps ! something is wrong in DELETE'; }
			if ($id =='7'){ return 'Opps ! ADD failed, alrealy exist some information !'; }
			if ($id =='8'){ return 'No action is performed - nothing is changed !'; }
	}
function success_message($con, $id){
			if ($id =='1'){ return 'You have logout successfully.'; }
			if ($id =='2'){ return 'Username was disabled, please contact system admin.'; }
			if ($id =='3'){ return ''; }
			if ($id =='4'){ return 'Add successfully'; }
			if ($id =='5'){ return 'Edited Successfully.'; }
			if ($id =='6'){ return 'Deleted Successfully'; }
	}


/*--------------------- COUNTERS --------------------------*/
function getCounter($con, $id){
	$result=mysqli_query($con, "SELECT value FROM counter WHERE id ='$id' LIMIT 1");
	while($row = mysqli_fetch_array($result))
       $counter = $row['value'];
	   return $counter;
	}

function updateCounter($con, $id){
	$result=mysqli_query($con, "UPDATE counter SET value = value+1, last_update=CURDATE() WHERE id ='$id' LIMIT 1");
	}
	
function resetOne($con, $id, $cur_date){
	mysqli_query($con, "UPDATE counter SET value = '1', last_update='$cur_date' WHERE id='$id' LIMIT 1");
	}

function resetCounter($con, $id, $type){
	$cur_date=date('Y-m-d');	
	$result=mysqli_query($con, "SELECT last_update FROM counter WHERE id='$id' LIMIT 1");
    while($row=mysqli_fetch_array($result))
    $last_update=$row['last_update'];	
   
   if($type =='dd') // daily reset
		 {
		   if(strtotime($last_update) != strtotime($cur_date))
		   //resetOne($con, $id, $cur_date);
		   mysqli_query($con, "UPDATE counter SET value = '1', last_update='$cur_date' WHERE id='$id' LIMIT 1");
		 }
	
	if($type =='mm') // monthly reset
		 {
			 if(date('Y', strtotime($last_update)) != date('Y', strtotime($cur_date)))
			 //resetOne($con, $id, $cur_date);
			 mysqli_query($con, "UPDATE counter SET value = '1', last_update='$cur_date' WHERE id='$id' LIMIT 1");
		 }
	else 
	   {
		  if(date('m', strtotime($last_update)) != date('m', strtotime($cur_date)))
		  //resetOne($con, $id, $cur_date);
		  mysqli_query($con, "UPDATE counter SET value = '1', last_update='$cur_date' WHERE id='$id' LIMIT 1");
	   }
	
	if($type =='yy') // yearly reset
		 {
			if(date('Y', strtotime($last_update)) != date('Y', strtotime($cur_date)))
			//resetOne($con, $id, $cur_date);
			mysqli_query($con, "UPDATE counter SET value = '1', last_update='$cur_date' WHERE id='$id' LIMIT 1");
		 }
}

/*--------------------- member_old_search_result1 --------------------------*/

function getCurrentDraw($con, $lottery_id){
	$result = mysqli_query($con, "SELECT current_draw FROM lottery WHERE id= '$lottery_id' LIMIT 1");
	if (mysqli_num_rows($result) == 0) 
          { return "0"; }
	else  { while($row=mysqli_fetch_array($result))
	        {return $row['current_draw'];} }	
	}
function getReferredName($con, $member_id){
	$result = mysqli_query($con, "SELECT m_name FROM member WHERE id= '$member_id' LIMIT 1");
	if (mysqli_num_rows($result) == 0) 
          { return ""; }
	else  { while($row=mysqli_fetch_array($result))
	        {return $row['m_name'];} }	
	}

/*--------------------- collect_amount --------------------------*/

function addHistory($con, $table_name, $pk_id, $description, $new_value, $old_value, $user_id){
	
	resetCounter($con, 6, 'dd');	//History
	$history_id = date('ynj').getCounter($con, 6);
	
	$check = mysqli_query($con, "SELECT id FROM status WHERE description = '$description' LIMIT 1");
	if(mysqli_num_rows($check) == 0) 
         return "";
	else  {	
	while($row1=mysqli_fetch_array($check))		
		  $db_history_id = $row1['id'];
	
	$result = mysqli_query($con, "INSERT INTO history(id, tbl_name, tbl_pk_id, type, new_value, old_value, user_id, date_time) VALUES ('$history_id', '$table_name', '$pk_id', '$db_history_id', '$new_value', '$old_value', '$user_id', NOW())");
	if(!$result)
	return "";
	else
	updateCounter($con, 6);
	}
 }
 
 function historyType($con, $description)
 {
	$result = mysqli_query($con, "SELECT id FROM status WHERE description = '$description' and tbl_name = 'history' LIMIT 1");
	if(mysqli_num_rows($result) == 0) 
         return "";
	else  {	
	while($row=mysqli_fetch_array($result))		
		  return $row['id'];	 
	 }
 }
 
 function showStatus($con, $status_id)
 {
	$result = mysqli_query($con, "SELECT description FROM status WHERE id = '$status_id' LIMIT 1");
	if(mysqli_num_rows($result) == 0) 
         return "";
	else  {	
	while($row=mysqli_fetch_array($result))		
		  return $row['description'];	 
	 }
 }

/*----------------------------Member List ----------------------------*/
function countEntrolled_lottery($con, $id){
	$result = mysqli_query($con, "SELECT count(lottery_id) AS total FROM `member_lottery` WHERE member_id = '$id'"); 
     while($row = mysqli_fetch_array($result))
      $total = $row['total'];
  if($total =="")
  		return '0';
  else 
  		return $total;
	}	

function getMember_id($con, $transaction_id){
	
 $result = mysqli_query($con, "SELECT DISTINCT ml.member_id FROM collection c LEFT JOIN member_lottery ml ON ml.id = c.member_lottery_id WHERE transaction_id = '$transaction_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['member_id'];}}
	}
	
function showMember_mid($con, $member_id){
	
 $result = mysqli_query($con, "SELECT `m_name`, `address`, `mobile` FROM `member` WHERE id='$member_id' LIMIT 1"); 
  if (mysqli_num_rows($result)==0) 
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['m_name'].', '.$row['address'].', '.$row['mobile'].', ';}}
	}
	
function total_paid_amount($con, $transaction_id){	
 $result = mysqli_query($con, "SELECT SUM(amount) as total FROM collection WHERE transaction_id = '$transaction_id'"); 
   while($row = mysqli_fetch_array($result))
    $total = $row['total'];
    if($total =="")
      return '0';
  else 
      return $total;
	}

/*---------------------------------winner_prize_list_draw --------------------------------------*/
function lotteryName($con, $lottery_id){	
 $result = mysqli_query($con, "SELECT name FROM lottery WHERE id = '$lottery_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['name'];}}
	}

function showCoupon($con, $member_lottery_id){	
 $result = mysqli_query($con, "SELECT coupon FROM member_lottery WHERE id = '$member_lottery_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['coupon'];}}
	}
function showMember_detail_ml($con, $member_lottery_id){	
 $result = mysqli_query($con, "SELECT m.m_name, m.address, m.mobile, m.gender FROM member_lottery ml LEFT JOIN member m ON ml.member_id = m.id WHERE ml.id = '$member_lottery_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['m_name'].' ('.$row['gender'].'), '.$row['address'].', +91 '.$row['mobile'];}}
	}

function countDraw_lottery($con, $lottery_id, $draw){	
 $result = mysqli_query($con, "SELECT COUNT(id) as total FROM prize WHERE lottery_id = '$lottery_id' AND draw='$draw'"); 
   while($row = mysqli_fetch_array($result))
    $total = $row['total'];
  if($total =="")
  return '0';
  else 
  return $total;
	}
	
function prizeAmount_lottery($con, $lottery_id, $draw){	
 $result = mysqli_query($con, "SELECT SUM(amount) as total FROM prize WHERE lottery_id = '$lottery_id' AND draw='$draw'"); 
   while($row = mysqli_fetch_array($result))
    $total = $row['total'];
  if($total =="")
  return '0';
  else 
  return $total;
	}


/*--------------------------------- Dashboard --------------------------------------*/
function totalMember_lid($con, $lottery_id){
 $result = mysqli_query($con, "SELECT COUNT(id) as total FROM member_lottery WHERE lottery_id = '$lottery_id'"); 
   while($row = mysqli_fetch_array($result))
    $total = $row['total'];
  if($total =="")
  return '0';
  else 
  return $total;
	}

function totalWinner_lid($con, $lottery_id){
 $result = mysqli_query($con, "SELECT COUNT(ml.id) as total FROM winner w LEFT JOIN member_lottery ml ON ml.id = w.member_lottery_id WHERE ml.lottery_id = '$lottery_id'"); 
   while($row = mysqli_fetch_array($result))
    $total = $row['total'];
  if($total =="")
  return '0';
  else 
  return $total;
	}


function totalpaid_lid($con, $lottery_id){	
 $result = mysqli_query($con, "SELECT SUM(paid_amount) as total FROM member_lottery WHERE lottery_id = '$lottery_id'");
  while($row = mysqli_fetch_array($result))
   $total = $row['total'];
  if($total =="")
  return '0.00';
  else 
  return $total;
	}

function collectionDate($con, $date1){
 $result = mysqli_query($con, "SELECT SUM(amount) as total FROM `transaction` WHERE transaction_date = '".$date1."'");
  while($row = mysqli_fetch_array($result))
   $total = $row['total'];
  if($total =="")
  return '0.00';
  else 
  return $total;
	}
	
function collection_between($con, $start_date, $stop_date){
 $result = mysqli_query($con, "SELECT SUM(amount) as total FROM `transaction` WHERE transaction_date BETWEEN '".$start_date."' AND '".$stop_date."'");
 while($row = mysqli_fetch_array($result))
  $total = $row['total'];
  if($total =="")
  return '0.00';
  else 
  return $total;
  }
	
function expenditureDate($con, $date1){
 $result = mysqli_query($con, "SELECT SUM(amount) as total FROM expenditure WHERE `date` = '".$date1."'");
  while($row = mysqli_fetch_array($result))
   $total = $row['total'];
  if($total =="")
  return '0.00';
  else 
 return $total;
 }
	
function expenditure_between($con, $start_date, $stop_date){
 $result = mysqli_query($con, "SELECT SUM(amount) as total FROM expenditure WHERE `date` BETWEEN '".$start_date."' AND '".$stop_date."'");
  while($row = mysqli_fetch_array($result))
  $total = $row['total'];
  if($total =="")
  return '0.00';
  else 
  return $total;
 }
 
function countTransaction_between($con, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT count(id) AS total FROM `transaction` WHERE transaction_date BETWEEN '".$start_date."' AND '".$stop_date."'"); 
	 while($row = mysqli_fetch_array($result))
	  $total = $row['total'];
  if($total =="")
  return '0';
  else 
  return $total;
 }
 
 function countMember_between($con, $start_date, $stop_date){
	$result = mysqli_query($con, "SELECT DISTINCT count(member_id) AS total FROM `member_lottery` WHERE `paid_date` BETWEEN '".$start_date."' AND '".$stop_date."'"); 
	 while($row = mysqli_fetch_array($result))
	  $total = $row['total'];
  if($total =="")
  	return '0';
  else 
  	return $total;
 }	

function getWon_draw($con, $member_lottery_id){
	 $result = mysqli_query($con, "SELECT won_draw FROM winner WHERE member.member_lottery_id = '$member_lottery_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { return ""; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['won_draw'];}
	
	}
}



/*---------------- PRIZE ----------------------*/
function showPrize_status($con, $prize_id){	
 $result = mysqli_query($con, "SELECT status.description FROM winner LEFT JOIN status ON status.id = winner.status WHERE winner.prize_id = '$prize_id'"); 
  if (mysqli_num_rows($result)==0) 
		 { return "Winners Not Added"; }
	   else{while($row = mysqli_fetch_array($result)) {return $row['description'];}}
	}
	
function countWinner_lotteryDraw($con, $lottery_id, $draw){	
 $result = mysqli_query($con, "SELECT COUNT(ml.id) AS total FROM winner w LEFT JOIN prize p ON p.id = w.prize_id LEFT JOIN member_lottery ml ON ml.id = w.member_lottery_id LEFT JOIN status s ON s.id = p.level WHERE p.lottery_id ='$lottery_id' AND p.draw = '$draw'"); 
   while($row = mysqli_fetch_array($result))
    $total = $row['total'];
  if($total =="")
  return '0';
  else 
  return $total;
	}
?>

