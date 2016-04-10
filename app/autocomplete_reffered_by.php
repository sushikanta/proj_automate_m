<?php require_once("config.php");?>
<?php	
	if (isset($_REQUEST['term'])){
			
	$rs = mysqli_query($con, "SELECT r.referred_name, r.referred_id, r.source_id, s.source_name FROM referred_tbl r LEFT JOIN source_tbl s ON s.source_id = r.source_id WHERE r.referred_name like '%".mysqli_real_escape_string($con, $_REQUEST['term'])."%' ORDER BY r.referred_name ASC");
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
					'label' => $row['referred_name']." (".$row['source_name'].")",
					'value' => $row['referred_name']." (".$row['source_name'].")",
					'referred_id' => $row['referred_id'],
					'source_id' => $row['source_id']
				);
			}
		}
	  echo json_encode($data);
	  flush();
	}
?>
