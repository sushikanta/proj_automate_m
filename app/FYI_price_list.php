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
<title>Test | Price</title>
<?php require_once("css_bootstrap_datatable_header.php");?>
<?php require_once("print-borderless-simple.php");?>

</head>
<body>
<?php require_once("right_top_header_popup.php");?>
<div class="container">
 <div class="page-content">     
 <div class="inv-main">	
    
   <div class="panel panel-success">  <!----------------------START price list Information-------------->
	<div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Investigation <span class="panel-subTitle"> ( View Price ) </span>
     <button onClick="window.print();return false" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-print fa-lg"></i> Print&nbsp;</button>
  	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div> 
                                      
<table cellpadding="0" cellspacing="0" border="0" class=" table-condensed table-hover" id="price_tbl">
<thead align="left">
<tr>
    <th> # </th>
    <th> Investigation</th>
    <th> Short form</th>
    <th> Price</th>
    <th> Category</th>
    <th> Department</th>
    <th> Version</th>
</tr>
</thead>
<tbody>
<?php
$version_count = countVersion($con);
$result = mysqli_query($con, "SELECT t.test_name, t.test_short_form, t.test_price, c.test_category_name, d.department_name FROM test_tbl t LEFT JOIN test_category c ON c.test_category_id=t.test_category_id LEFT JOIN department_tbl d ON d.department_id = c.TC_dept_id");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{ ?>
 <tr>
    <td><?php echo  $sl_no; ?> </td>    	
	<td><?php echo  $row['test_name']; ?> </td>  
	<td><?php echo  $row['test_short_form']; ?> </td>
    <td><i class="fa fa-inr"></i> <?php echo  $row['test_price']; ?> </td>  
    <td><?php echo  $row['test_category_name']; ?> </td>
    <td><?php echo  $row['department_name']; ?> </td>
    <td><?php echo  $version_count; ?> </td>
  </tr>
 <?php
	$sl_no++;}
?>
</tbody>
</table>
<div class="clear"></div>
</div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap_datatable.php"); ?>
<script type="text/javascript">
$(document).ready(function() {
 $('#price_tbl').dataTable({
	    "bJQueryUI": true,
		"bPaginate": false,
		"bInfo": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
		    			
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