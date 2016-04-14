<?php require_once("check_login_hr.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Employee List</title>
<?php require_once("css_bootstrap_datatable_header.php"); ?> 
</head>
<body>

<?php require_once("right_top_header_hr.php"); ?>
<div class="container">
 <div class="page-content">
      
 <div class="inv-main">
 	
 <div class="panel panel-success">  <!----------------------START Employee Information-------------->
    <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Employee <span class="panel-subTitle"> ( List ) </span>
   	 <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
  </div>		 
                                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover display" id="emp_table">
  <thead align="left">
  <tr>
      <th> # </th>
      <th> Emp No #</th>
      <th> Name</th>
      <th> Address</th>
      <th> Phone</th>
      <th> Position</th>
      <th> Department</th>
      <th> Status</th>
      <th> View</th>
      <th> Add/Edit</th>
  </tr>
  </thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT i.EI_id, i.EI_name, i.EI_address, i.EI_phone, t.ET_emp_no, t.ET_status, d.department_name, s.designation_name FROM emp_info i LEFT JOIN emp_tbl t ON i.EI_id = t.ET_ei_id LEFT JOIN department_tbl d ON d.department_id = t.ET_dept_id LEFT JOIN designation_tbl s ON s.designation_id = t.ET_desig_id ORDER BY i.EI_name ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{	
  $EI_id = $row['EI_id'];
  $EI_name = $row['EI_name'];
  $EI_address = $row['EI_address'];
  $EI_phone = $row['EI_phone'];
  
  $ET_emp_no = $row['ET_emp_no'];
  $ET_status = $row['ET_status'];
  $department_name = $row['department_name'];
  $designation_name = $row['designation_name'];
?>
 <tr>
    <td><?php echo $sl_no; ?> </td>
    <td><?php echo $ET_emp_no; ?> </td>
    <td><?php echo $EI_name; ?> </td>
	<td><?php echo $EI_address; ?> </td>
	<td><?php echo $EI_phone; ?> </td>
    <td><?php echo $designation_name; ?></td>
    <td><?php echo $department_name; ?></td>
    <td><?php if($ET_status =='1'){echo 'Active';}if($ET_status =='2'){echo 'Relieved';}?></td>
    
    <form action="employee_profile_view.php" role="form" method="get" target="_blank" class="form_profile">
  	<input type="hidden" name="ei_id" value="<?php echo $EI_id;?>"/>
  	<td class="text-center"><button class=" btn-link" type="submit" name="submit_view" title="View Employee Profile">
    <i class="fa fa-th-list"></i></button></td>
 	</form>
    
    <form action="employee_view.php" role="form" method="get" target="_blank" class="form_view">
  	<input type="hidden" name="ei_id" value="<?php echo $EI_id;?>"/>
  	<td class="text-center"><button class=" btn-link" type="submit" name="submit_view" title="Add/Edit Employee Profile">
    <i class="fa fa-plus"> <i class="fa fa-edit"></i></button></td>
 	</form>
   
 </tr>
 <?php
$sl_no++;
}
?>
</tbody>
</table>

<div class="clear"></div>
</div>

<?php include("footer.php"); ?> 
<?php include("script_bootstrap_datatable.php"); ?>  
<script charset="utf-8" type="text/javascript"> 
$(document).ready(function() {	
    
  $('#emp_table').dataTable({
        "bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"fnPreDrawCallback": function( oSettings ) {		
		  $('.dataTables_filter input').addClass('form-control input-sm');
		  $('.dataTables_filter input').attr('placeholder', 'Search');	
		  $('.dataTables_filter input').css('height', '33px');
		  //$('.dataTables_filter input').css('margin-right', '15px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  //$('.dataTables_length label').addClass('form-control input-sm');
		  //$('.dataTables_length label').css('width', '400px');
		  $('.dataTables_length select').css('height', '33px');	
		  $('.dataTables_length select').css('margin-right', '3px');	
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');		 	 
	   }
	});
	
	$('.form_profile').submit(function() {	
    window.open('', 'employee_profile_view.php', "width=1200,height=550,resizeable,scrollbars");
    this.target = 'employee_profile_view.php';
    });
	
	
  });
 
</script>
</body>
</html>
<?php ob_flush();?>