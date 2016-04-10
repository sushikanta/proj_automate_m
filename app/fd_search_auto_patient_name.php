<?php require_once("config.php");?>
 <?php
	if (isset($_REQUEST['term'])){
	$rs = mysqli_query($con, 'SELECT r.pr_receipt_no, r.pr_patient_id, r.pr_date, p.PI_name, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, m.marital_name, g.gender_name FROM patient_registration r LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE p.PI_name LIKE "%'.mysqli_real_escape_string($con, $_REQUEST['term']).'%" ORDER BY r.pr_date DESC');
	$data = array();
	if (mysqli_num_rows($rs) == 0){
		$data[] = array(
				'label' => "No Registration found",
				'value' => "",
				'receipt_no' => "",
			);
		}
  else {
		while( $row = mysqli_fetch_array($rs)){
			if($row['PI_age_y'] !='0' && $row['PI_age_m'] =='0' && $row['PI_age_d'] =='0'){ $age = $row['PI_age_y'].'yrs';}
			if($row['PI_age_y'] =='0' && $row['PI_age_m'] !='0' && $row['PI_age_d'] =='0'){ $age = $row['PI_age_m'].'m';}
			if($row['PI_age_y'] =='0' && $row['PI_age_m'] =='0' && $row['PI_age_d'] !='0'){ $age = $row['PI_age_d'].'d';}
			if($row['PI_age_y'] !='0' && $row['PI_age_m'] !='0' && $row['PI_age_d'] =='0'){ $age = $row['PI_age_y'].'yrs '.$row['PI_age_m'].'m';}
			if($row['PI_age_y'] !='0' && $row['PI_age_m'] =='0' && $row['PI_age_d'] !='0'){ $age = $row['PI_age_y'].'yrs '.$row['PI_age_d'].'d';}
			if($row['PI_age_y'] =='0' && $row['PI_age_m'] !='0' && $row['PI_age_d'] !='0'){ $age = $row['PI_age_m'].'m '.$row['PI_age_d'].'d';}
			if($row['PI_age_y'] !='0' && $row['PI_age_m'] !='0' && $row['PI_age_d'] !='0'){ $age = $row['PI_age_y'].'yrs '.$row['PI_age_m'].'m '.$row['PI_age_d'].'d';}

		  $data[] = array(
			  'label' => 'RegID: '.$row['pr_receipt_no']." (".date("d/m/Y, h:i a", strtotime($row['pr_date']))."), ".$row['PI_name'].", ".$row['gender_name']."/".$age." (".$row['marital_name'].') '.$row['PI_address'],
			  'value' => 'RegID: '.$row['pr_receipt_no']." (".date("d/m/Y, h:i a", strtotime($row['pr_date']))."), ".$row['PI_name'].", ".$row['gender_name']."/".$age." (".$row['marital_name'].') '.$row['PI_address'],
			  'receipt_no' => $row['pr_receipt_no'],
		  );
	  }
		}
	  echo json_encode($data);
	  flush();
	}
?>
