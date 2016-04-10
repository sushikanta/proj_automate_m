<?php require_once("config.php");?>
<?php
  	if (isset($_REQUEST['term'])){ 
	$rs = mysqli_query($con, 'SELECT e.EI_id, e.EI_name, e.EI_phone, e.EI_address, m.ET_emp_no, d.short_form, p.department_name FROM emp_info e LEFT JOIN emp_tbl m ON e.EI_id = m.ET_ei_id LEFT JOIN designation_tbl d ON d.designation_id = m.ET_desig_id LEFT JOIN department_tbl p ON p.department_id = m.ET_dept_id WHERE e.EI_name like "%'.mysqli_real_escape_string($con, $_REQUEST['term']).'%" ORDER BY e.EI_name ASC');
  $data = array();
  if(mysqli_num_rows($rs) == 0){
	$data[] = array(
			'label' => "No Record Found",
			'value' => "",
			'referred_id' => "",
			);
		  }
	else{  
	while( $row = mysqli_fetch_array($rs)){
		$data[] = array(
		'label' => $row['EI_name'].', '.$row['EI_address'].' ('.$row['ET_emp_no'].', '.$row['short_form'].'-'.$row['department_name'].')', 
		'value' =>  $row['EI_name'],
		'referred_id' => $row['EI_id'],
		'source_id' => '2'
	  );
	}
  }
	echo json_encode($data);
	flush();
}
?>