<?php require_once("config.php");?>

<?php  
  
	if (isset($_REQUEST['term']) && isset($_REQUEST['district'])){
		$district=$_REQUEST['district'];
		$rs = mysqli_query($con, "SELECT `pin_id`, `pin_code`, `district_id` FROM `pin_tbl` WHERE `pin_code` like '%". mysqli_real_escape_string($con, $_REQUEST['term']) ."%' AND `district_id` = '$district' order by `pin_code` asc limit 0,10");
		$data = array();
		if ($rs && mysqli_num_rows($rs)){
			while( $row = mysqli_fetch_array($rs)){
				$data[] = array(
					'label' => $row['pin_code'],
					'value' => $row['pin_code'], 
					'pin_id' => $row['pin_id']
				);
			}
		}
	  echo json_encode($data);
	  flush();
	}

