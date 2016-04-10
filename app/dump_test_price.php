<?php include("function.php");?>
<!DOCTYPE html>
<html>
<?php include("css_bootstrap_datatable_header.php");?> 
<body>
<?php include("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">		    
        <div class="inv-main">
        
            <div class="panel panel-warning">
                  <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-plus-square"></i> Investigation Category </h3></div>                     
                               
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="test_name_price_table">
<thead align="left">
<tr>
    <th> # </th>
    <th>Investigation</th>
    <th> Price ( <i class="fa fa-inr"></i> )</th>
    <th> Version(Date)</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT `price_dump`.*, `price_version`.* FROM `price_dump` LEFT JOIN `price_version` ON `price_version`.`PV_id` = `price_dump`.`PD_version_id`");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{

?>
 <tr id="<?php echo $row['PD_sl'] ; ?>">
    <td class="readonly-bg"> <?php echo $sl_no; ?> </td>    	
	<td><?php echo  $row['PD_test_name']; ?> </td>  
	<td><?php echo $row['PD_price']; ?> </td>
    <td><?php echo  $row['PV_name']." [ ".$row['PV_date']." ]"; ?> </td>  
    
  </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table>
 
<div class="clear"></div>
</div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap_datatable.php"); ?>    
<script type="text/javascript">

 $('#test_name_price_table').dataTable({		       		

        "bJQueryUI": true,
		"bPaginate": true,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
		    			
		"fnPreDrawCallback": function( oSettings ) {		
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


</script>
</body>
</html>