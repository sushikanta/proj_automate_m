<?php require_once("check_login_mt.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Investigation List</title>
<?php require_once("css_bootstrap_datatable_header.php");?> 
<body>
<?php require_once("right_top_header_mt.php");?>

<div class="container">
 <div class="page-content">     
 <div class="inv-main">	
    
  <div class="panel panel-success">  <!----------------------START price list Information-------------->
	<div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-lg fa-fw"></i> &nbsp;&nbsp;&nbsp;
     Investigation <span class='panel-subTitle'> ( Add / View Template )</span>
     <button style="margin-left:10px; margin-top:-5px;" class="no-print btn btn-mini btn-primary pull-right" id="close_all">
      <i class="fa fa-times fa-lg"></i> Reset&nbsp;</button>
   <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div> 
                                      
<table cellpadding="0" cellspacing="0" border="0" class="table-hover width_100" id="test_table">
<thead align="left">
<tr>
    <th> # </th>
    <th> Investigation</th>
    <th> Short form</th>
    <th> Price</th>
    <th> Category</th>
    <th> Department</th>
    <th> Template </th>
    <th> # View </th>
    
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT t.test_id, t.test_name, t.test_short_form, t.test_price, c.test_category_name, d.department_id, d.department_name FROM test_tbl t LEFT JOIN test_category c ON c.test_category_id = t.test_category_id LEFT JOIN department_tbl d ON d.department_id = c.TC_dept_id ORDER BY t.test_name ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{	
     $test_id = $row['test_id'];
	 $test_name = $row['test_name'];
	 $test_short_form = $row['test_short_form'];
	 $test_price = $row['test_price'];
	 $test_category_name = $row['test_category_name'];
	 $department_id = $row['department_id'];
	 $department_name = $row['department_name'];	
?>
 <tr id="<?php echo $test_id; ?>">
    <td><?php echo $sl_no; ?> </td>    	
	<td><?php echo $test_name; ?> </td>  
	<td><?php echo $test_short_form; ?> </td>
    <td><i class="fa fa-inr"></i> <?php echo $test_price; ?> </td>  
    <td><?php echo $test_category_name; ?> </td>
    <td><?php echo $department_name; ?> </td>
   
      <td class="no-print" title="Add Template">      
      <form action="MT_template_name_add.php" role="form" method="get" target="_blank" class="form_add">
      <input type="hidden" name="tid" value="<?php echo $test_id;?>"/>
      <input type="hidden" name="did" value="<?php echo $department_id;?>"/>
      <button class="btn btn-mini btn-primary" type="submit"><i class="fa fa-plus fa-fw"></i></button>
      </form>    
      </td>
   
      <td class="no-print" title="View Template">
      <form action="MT_template_list.php" role="form" method="get" target="_blank" class="form_view">
      <input type="hidden" name="tid" value="<?php echo $test_id;?>"/>
      <button class="btn btn-mini btn-primary" type="submit"><?php echo CountNoOfTemplate($con, $row['test_id']);?> - TMP </button>
      </form>
      </td>
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
$(document).ready(function(){
	$('#test_table').dataTable({
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
	 
// 	 pop up

 $('.form_add').submit(function() {	
    myWindow1 = window.open('', 'MT_template_name_add.php', "width=1000,height=450,resizeable,scrollbars");
    this.target = 'MT_template_name_add.php';
    });
	
 /* $('.form_view').submit(function() {	
    myWindow2 = window.open('', 'MT_template_list.php', "width=1300,height=500,resizeable,scrollbars");
    this.target = 'MT_template_list.php';
    });*/
	

$('#close_all').click(function(e) {
       myWindow1 = window.open('', 'MT_template_name_add.php');
	   myWindow1.close();
	   myWindow2 = window.open('', 'MT_template_list.php');
	   myWindow2.close();
    });	 
});
</script>
</body>
</html>
<?php ob_flush();?>