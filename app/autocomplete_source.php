<?php include("config.php");?>
  <?php  
	if (isset($_REQUEST['term'])){
		$rs = mysqli_query($con, 'SELECT `source_id`, `source_name` FROM `source_btl` WHERE `source_name` like "%'. mysqli_real_escape_string($con, $_REQUEST['term']) .'%" limit 0,10');
		$data = array();
		if ($rs && mysqli_num_rows($rs)){
			while( $row = mysqli_fetch_array($rs)){
				$data[] = array(
					'label' => $row['source_name'] ,
					'value' => $row['source_name'], 
					'source_id' => $row['source_id']
				);
			}
		}
	  echo json_encode($data);
	  flush();
	}
	?>