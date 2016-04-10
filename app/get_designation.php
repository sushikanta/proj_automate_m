<?php include("function.php");?>
  <?php  
	
if(!empty($_POST['data']))
   {
	$category_id = $_POST['data'];
	$rs = mysqli_query($con, "SELECT `TC_dept_id` FROM `test_category` WHERE `test_category_id` = '$category_id'");
		$data = array();
		if ($rs && mysqli_num_rows($rs)){
			while( $row = mysqli_fetch_array($rs)){
				$data[] = array(
					'TC_dept_id' => $row['TC_dept_id']
				);
			}
		}
	  echo json_encode($data);	 
	}

