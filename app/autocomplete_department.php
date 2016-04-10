<?php include("config.php");?>
  <?php  
	if (isset($_REQUEST['term'])){
		$rs = mysqli_query($con, 'SELECT `department_id`, `department_name` FROM `department_tbl` WHERE  `department_name` like "%'. mysqli_real_escape_string($con, $_REQUEST['term']) .'%" limit 0,10');
		$data = array();
		if ($rs && mysqli_num_rows($rs)){
			while( $row = mysqli_fetch_array($rs)){
				$data[] = array(
					'label' => $row['department_name'] ,
					'value' => $row['department_name'], 
					'department_id' => $row['department_id']
				);
			}
		}
	  echo json_encode($data);
	  flush();
	}

