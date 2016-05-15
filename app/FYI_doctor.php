<?php require_once("function.php"); session_start(); ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title> Dr. List </title>
<?php require_once("css_bootstrap_datatable_header.php");?>
<?php require_once("print-borderless.php");?> 
</head>
<body>
<?php require_once("right_top_header_popup.php");?>
<div class="container">
 <div class="page-content">     
 <div class="inv-main">	
    
   <div class="panel panel-success">  <!----------------------START price list Information-------------->
	 <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
   List <span class="panel-subTitle"> ( Doctor ) </span> 
  	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div> 
                                      
<table cellpadding="0" cellspacing="0" border="0" class="table-hover" id="test_name_price_table">
<thead align="left">
<tr>
    <th> # </th>
    <th> Doctor Name</th>
    <th class="no-print"> Address</th>
    <th class="no-print"> Specialize</th>
    <th class="no-print"> Institute</th>
    <th class="no-print"> Phone</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT i.dr_name, i.dr_address, i.dr_phone, p.dp_specialization, p.dp_institute FROM dr_info i LEFT JOIN dr_profile p ON p.dp_dr_id = i.dr_id ORDER BY i.dr_name ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
  
?>
 <tr>
    <td><?php echo  $sl_no; ?></td>
    <td><?php echo  'Dr. '.$row['dr_name']; ?></td>
    <td class="no-print"><?php echo  $row['dr_address']; ?></td>
    <td class="no-print"><?php echo  $row['dp_specialization']; ?></td>
    <td class="no-print"><?php echo  $row['dp_institute']; ?></td> 
    <td class="no-print"><?php echo  $row['dr_phone']; ?></td>
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
<script type="text/javascript">
$(document).ready(function() {	
 $('#test_name_price_table').dataTable( {		       		

        "bJQueryUI": true,
		"bPaginate": false,
		"bBootstrap": true,
		"bAutoWidth": false,
		"bInfo": false,
		    			
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