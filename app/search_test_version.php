<?php include("config.php");?>
  <?php  
  
	if (isset($_REQUEST['term'])){
		$rs = mysqli_query($con, "SELECT `version_id`, `version_name`, `version_date` FROM `price_version` WHERE `version_name` like '%". mysql_real_escape_string($_REQUEST['term']) ."%' order by `version_name` asc limit 0,10");
		$data = array();
		if ($rs && mysqli_num_rows($rs)){
			while( $row = mysqli_fetch_array($rs)){
				$data[] = array(
					'label' => $row['version_name'] .' ( Dated: '. date( "d-m-Y", strtotime($row['version_date'])).' )' ,
					'value' => $row['version_name'], 
					'version_id' => $row['version_id']
				);
			}
		}
	  echo json_encode($data);
	  flush();
	}

