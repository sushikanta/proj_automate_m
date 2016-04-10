<?php require_once("config.php");?>

<?php  
	if (isset($_REQUEST['term'])){
		$rs = mysqli_query($con, 'SELECT `state_id`, `state_name` FROM `state_tbl` WHERE `state_name` like "'.mysqli_real_escape_string($con, $_REQUEST['term']).'%" ORDER BY `state_name` ASC');
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
					'label' => $row['state_name'],
					'value' => $row['state_name'], 
					'state_id' => $row['state_id']
				);
			}
		}
	  echo json_encode($data);
	  flush();
	}

