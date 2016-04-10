<?php require_once("config.php");?>
 <?php  
	if (isset($_REQUEST['term'])){
	$rs = mysqli_query($con, 'SELECT patient_registration.pr_receipt_no, patient_registration.pr_patient_id, patient_registration.pr_date, patient_info.PI_name, patient_info.PI_age_y, patient_info.PI_age_m, patient_info.PI_age_d, patient_info.PI_marital_id, patient_info.PI_address, patient_info.PI_phone FROM patient_registration LEFT JOIN patient_info ON patient_info.PI_id = patient_registration.pr_patient_id WHERE patient_registration.pr_receipt_no LIKE "'.mysqli_real_escape_string($con, $_REQUEST['term']).'%" OR patient_info.PI_name LIKE "%'.mysqli_real_escape_string($con, $_REQUEST['term']).'%" OR patient_info.PI_address LIKE "%'.mysqli_real_escape_string($con, $_REQUEST['term']).'%" OR patient_info.PI_phone LIKE "'.mysqli_real_escape_string($con, $_REQUEST['term']).'%" limit 0,10');
	$data = array();
		if ($rs && mysqli_num_rows($rs)){
			while( $row = mysqli_fetch_array($rs)){
				
				if($row['PI_marital_id'] =='1'){ $marital = 'M';}
				if($row['PI_marital_id'] =='2'){ $marital = 'F';}
				
				if($row['PI_age_y'] !='0' && $row['PI_age_m'] =='0' && $row['PI_age_d'] =='0'){ $age = $row['PI_age_y'].'yrs';}
				if($row['PI_age_y'] =='0' && $row['PI_age_m'] !='0' && $row['PI_age_d'] =='0'){ $age = $row['PI_age_m'].'m';}
				if($row['PI_age_y'] =='0' && $row['PI_age_m'] =='0' && $row['PI_age_d'] !='0'){ $age = $row['PI_age_d'].'d';}
				if($row['PI_age_y'] !='0' && $row['PI_age_m'] !='0' && $row['PI_age_d'] =='0'){ $age = $row['PI_age_y'].'yrs '.$row['PI_age_m'].'m';}
				if($row['PI_age_y'] !='0' && $row['PI_age_m'] =='0' && $row['PI_age_d'] !='0'){ $age = $row['PI_age_y'].'yrs '.$row['PI_age_d'].'d';}
				if($row['PI_age_y'] =='0' && $row['PI_age_m'] !='0' && $row['PI_age_d'] !='0'){ $age = $row['PI_age_m'].'m '.$row['PI_age_d'].'d';}
				if($row['PI_age_y'] !='0' && $row['PI_age_m'] !='0' && $row['PI_age_d'] !='0'){ $age = $row['PI_age_y'].'yrs '.$row['PI_age_m'].'m '.$row['PI_age_d'].'d';}
								
				
				$data[] = array(
					'label' => $row['pr_receipt_no']." (".date("d/m/Y, h:i a", strtotime($row['pr_date'])).") ".$row['PI_name'].", ".$marital."/".$age.", ".$row['PI_address'].", ".$row['PI_phone'],
					'value' => $row['pr_receipt_no']." (".date("d/m/Y, h:i a", strtotime($row['pr_date'])).") ".$row['PI_name'].", ".$marital."/".$age.", ".$row['PI_address'].", ".$row['PI_phone'],
					'receipt_no' => $row['pr_receipt_no'],
								
				);
			}
		}
	  echo json_encode($data);
	  flush();
	}
mysqli_free_result($rs);
mysqli_close($con);
?>
