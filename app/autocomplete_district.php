<?php require_once("config.php");?>
<?php  
	if (isset($_REQUEST['term']) && isset($_REQUEST['state'])){
		$state=$_REQUEST['state'];
		if($state=='')
		{
		$data[] = array(
					'label' => "Please Select State First!!!",
					'value' => "",
					'referred_id' => "",
				);
			}
		else{
		$rs = mysqli_query($con, "SELECT `district_id`, `district_name`, `state_id` FROM `district_tbl` WHERE `district_name` like '%". mysqli_real_escape_string($con, $_REQUEST['term']) ."%' AND `state_id` = '$state' ORDER BY `district_name` ASC");
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
					'label' => $row['district_name'],
					'value' => $row['district_name'], 
					'district_id' => $row['district_id']
				);
			}
		}
		}
	  echo json_encode($data);
	  flush();
	}

