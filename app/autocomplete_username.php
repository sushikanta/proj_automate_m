<?php require_once("config.php");?>
 <?php  
	if (isset($_REQUEST['term'])){
	$rs = mysqli_query($con, 'SELECT `user_id`, `user_name`, `name`, `surname` FROM user_table WHERE user_name LIKE "%'.mysqli_real_escape_string($con, $_REQUEST['term']).'%" AND user_dept_id BETWEEN  "2" AND "3"');
	$data = array();
		if (mysqli_num_rows($rs) == 0){
		$data[] = array(
				'label' => "No Record found",
				'value' => "",
				'user_id' => "",
			);
		}
	  else {
			while( $row = mysqli_fetch_array($rs)){
				$data[] = array(
				'label' => $row['user_name'].", (".$row['name']." ".$row['surname'].')',
				'value' => $row['user_name'].", (".$row['name']." ".$row['surname'].')',
				'user_id' => $row['user_id'],
				);
			}
		}
	  echo json_encode($data);
	  flush();
	}
?>
