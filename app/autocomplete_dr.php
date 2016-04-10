<?php require_once("config.php");?> 
<?php  
	if (isset($_REQUEST['term'])){
		$rs = mysqli_query($con, 'SELECT i.dr_id, i.dr_name, i.dr_address, p.dp_specialization, p.dp_institute FROM dr_info i LEFT JOIN dr_profile p ON p.dp_dr_id = i.dr_id WHERE i.dr_name like "%'.mysqli_real_escape_string($con, $_REQUEST['term']).'%" ORDER BY i.dr_name ASC');
		$data = array();
		
		if (mysqli_num_rows($rs) == 0){
		$data[] = array(
					'label' => "No Record Found",
					'value' => "",
					'referred_id' => "",
				);
			}
		else{
			while( $row = mysqli_fetch_array($rs)){
				$data[] = array(
					'label' => $row['dr_name'].', '.$row['dr_address'].' ( '.$row['dp_specialization'].', '.$row['dp_institute'].' )',
					'value' => $row['dr_name'], 
					'dr_id' => $row['dr_id']
				);
			}
		}
	  echo json_encode($data);
	  flush();
	}
