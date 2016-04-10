<?php include("config.php");?>
  <?php  
	if (isset($_REQUEST['term'])){
	$rs = mysqli_query($con, 'SELECT t.test_id, t.test_name, t.test_short_form, t.test_price, c.TC_dept_id, d.department_name FROM test_tbl t LEFT JOIN test_category c ON  t.test_category_id = c.test_category_id LEFT JOIN department_tbl d ON d.department_id = c.TC_dept_id WHERE t.test_name LIKE "%'.mysqli_real_escape_string($con, $_REQUEST['term']).'%" OR t.test_short_form LIKE "'.mysqli_real_escape_string($con, $_REQUEST['term']).'%" ORDER BY t.test_name ASC');
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
					'label' => $row['test_name']." ( ".$row['test_short_form']." ) - Rs.".$row['test_price'],
					'value' => $row['test_name'],
					'test_price' => $row['test_price'],
					'test_id' => $row['test_id'],
					'dept_id' => $row['TC_dept_id']
				);
			}
		}
	  echo json_encode($data);
	  flush();
	}
?>

