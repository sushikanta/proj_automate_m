<?php require_once("config.php");?>
 <?php  
	if (isset($_REQUEST['term'])){
	$rs = mysqli_query($con, 'SELECT p.PI_id, p.PI_name, p.PI_gender, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_phone, m.marital_name FROM patient_info p LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id WHERE p.PI_name LIKE "%'.mysqli_real_escape_string($con, $_REQUEST['term']).'%"');
	$data = array();
		if (mysqli_num_rows($rs) == 0){
		    $data[] = array(
					'label' => "No Record Found",
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
					'label' => 'C#'.$row['PI_id'].' ('.$row['PI_name'].", ".$row['PI_gender']."/".$age." [".$row['marital_name'].'], '.$row['PI_address'].", +91 ".$row['PI_phone'].')',
					'value' =>  'C#'.$row['PI_id'].' ('.$row['PI_name'].", ".$row['PI_gender']."/".$age." [".$row['marital_name'].'], '.$row['PI_address'].", +91 ".$row['PI_phone'].')',
					
					'patient_id' => $row['PI_id'],
								
				);
			}
		}
	  echo json_encode($data).mysqli_error($con);
	  flush();
	}
?>
