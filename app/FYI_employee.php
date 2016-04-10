<?php require_once("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Employee List</title>
<?php require_once("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php require_once("right_top_header_popup.php"); ?>
<div class="container">
 <div class="page-content">
   <div class="inv-main">
        
<div class="panel panel-success">
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
   List <span class="panel-subTitle"> ( Employee ) </span> 
  	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div> 
                                      
<table cellpadding="0" cellspacing="0" border="0" class="table-condensed table-hover" id="emp_tbl">
<thead align="left">
<tr>
    <th class=" width_3"> # </th>
    <th> Emp ID</th>
    <th> Name</th>
    <th> Address</th>
    <th> Phone </th>
    <th> Position</th>
    <th> Dept</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT e.EI_sl, e.EI_name, e.EI_phone, e.EI_address, b.ET_emp_no, d.designation_name, d.short_form, p.department_name, s.state_name, c.district_name FROM emp_info e LEFT JOIN emp_tbl b ON b.ET_ei_id = e.EI_sl LEFT JOIN designation_tbl d ON d.designation_id = b.ET_desig_id LEFT JOIN department_tbl p ON p.department_id = b.ET_dept_id LEFT JOIN state_tbl s ON s.state_id =e.EI_state LEFT JOIN district_tbl c ON c.district_id = e.EI_district ORDER BY e.EI_name ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{  
?>
 <tr>
    <td><?php echo  $sl_no; ?> </td>    	
	<td ><?php echo  $row['ET_emp_no']; ?> </td> 
    <td><?php echo  $row['EI_name']; ?> </td> 
    <td><?php echo  $row['EI_address']; ?>, <?php echo  $row['district_name']; ?>, <?php echo  $row['state_name']; ?> </td> 
    <td><?php if($row['EI_phone'] !="0"){ echo  $row['EI_phone'];} ?> </td> 
    <td><?php echo  $row['short_form']; ?> </td>    
    <td><?php echo  $row['department_name']; ?> </td>    
  </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>
<div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>
<script type="text/javascript">
$(document).ready(function() {	
 $('#emp_tbl').dataTable( {		       		

        "bJQueryUI": true,
		"bPaginate": false,
		"bBootstrap": true,
		//"bAutoWidth": true,
		"bInfo": false,
		"bFilter": true,
		    			
		"fnPreDrawCallback": function( oSettings ) 
		  {		
			$('.dataTables_filter input').addClass('form-control input-sm');
			$('.dataTables_filter input').attr('placeholder', 'Search');	
			$('.dataTables_filter input').css('height', '33px');
			$('.dataTables_length select').addClass('form-control input-sm');
			$('.dataTables_length select').css('height', '33px');	
			$('.dataTables_length select').css('margin-right', '3px');	
			$('.dataTables_length select').css('margin-bottom', '10px');
			$('.dataTables_length select').css('float', 'left');
		  }
		  			
     });
    });
</script>
</body>
</html>
<?php ob_flush(); ?>