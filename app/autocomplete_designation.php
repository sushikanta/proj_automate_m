<?php include("config.php");?>
  <?php  
	if (isset($_REQUEST['term'])){
		$rs = mysqli_query($con, 'SELECT `designation_id`, `designation_name`, `short_form` FROM `designation_tbl` WHERE `designation_name` like "%'. mysqli_real_escape_string($con, $_REQUEST['term']) .'%" limit 0,10');
		$data = array();
		if ($rs && mysqli_num_rows($rs)){
			while( $row = mysqli_fetch_array($rs)){
				$data[] = array(
					'label' => $row['designation_name'] .' (' . $row['short_form'].')',
					'value' => $row['designation_name'], 
					'designation_id' => $row['designation_id']
				);
			}
		}
	  echo json_encode($data);
	  flush();
	}

