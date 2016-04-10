<?php include("config.php");?>
  <?php  
  
	if (isset($_REQUEST['term'])){
		$rs = mysqli_query($con, "SELECT `test_category_id`, `test_category_name` FROM `test_category` WHERE `test_category_name` like '%". mysql_real_escape_string($_REQUEST['term']) ."%' order by `test_category_name` asc limit 0,10");
		$data = array();
		if ($rs && mysqli_num_rows($rs)){
			while( $row = mysqli_fetch_array($rs)){
				$data[] = array(
					'label' => $row['test_category_name'] ,
					'value' => $row['test_category_name'], 
					'category_id' => $row['test_category_id']
				);
			}
		}
	  echo json_encode($data);
	  flush();
	}

