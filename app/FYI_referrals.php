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
<title>Source | name</title>
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
     List <span class="panel-subTitle"> ( Other Name / Source ) </span> 
  	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div> 
                                      
<table cellpadding="0" cellspacing="0" border="0" class="table-hover" id="other_tbl">
<thead align="left">
<tr>
    <th> # </th>    
    <th> Source Person</th>
	<th> Source</th>
	</tr>
  </thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT r.referred_name, s.source_name FROM referred_tbl r LEFT JOIN source_tbl s ON s.source_id = r.source_id ORDER BY r.referred_name ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
?>
 <tr>
    <td><?php echo  $sl_no; ?> </td>  
    <td><?php echo  $row['referred_name']; ?> </td> 
    <td><?php echo  $row['source_name']; ?> </td>   
    
  </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>
</div>
</div>
<div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>
<script type="text/javascript">
$(document).ready(function() {	
 $('#other_tbl').dataTable( {		       		

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