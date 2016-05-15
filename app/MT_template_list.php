<?php require_once("check_login_mt.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Template List</title>
<?php require_once("css_bootstrap_datatable_header.php"); ?> 
<body>
<?php require_once("right_top_header_mt.php");?>
<?php 
	if(isset($_GET['delesdfsdte'])){		
		$template_id = $_GET['template_id'];
		$test_id = $_GET['test_id'];
		mysqli_query($con, "DELETE FROM template_name_tbl WHERE TPN_id = '$template_id'");		
		mysqli_query($con, "DELETE FROM template_body_tbl WHERE TPB_tpn_id = '$template_id'");
        header("location:MT_template_list.php?tid=$test_id&smsg=1");
  }
?>
<?php if(isset($_GET['tid']) && $_GET['tid']!=""){ 
		$tid = $_GET['tid'];
	?>

<div class="container">
 <div class="page-content">
  <div class="inv-main">

<div class="panel panel-success" style="min-height:500px;">
    <div class="panel-heading light_purple_color">
    <h3 class="panel-title"><i class="fa fa-cubes fa-lg fa-fw"></i> &nbsp;&nbsp;&nbsp;
    Template <span class="panel_subTitle">( Investigation : <?php echo showTest_name($con, $tid); ?>, <?php echo showDeptName_test($con, $tid);?> )</span>
      	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i>  <span id="show_date"></span></span>
	</div>

<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover display" id="test_table">
<thead align="left">
<tr>
    <th> # </th>
    <th> Template Name</th>
    <th class="text-center"> Rows</th>
    <th class="text-center"> Coloumns</th>
    <th class="text-center"> Status</th>
    <th class="text-center"> View</th>
    <th class="text-center"> Edit</th>
    <th class="text-center"> DEL / Disable</th>    
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT TPN_id, TPN_name, TPN_total_row, TPN_total_column, TPN_status FROM template_name WHERE TPN_test_id = '$tid'");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$TPN_id = $row['TPN_id'];
	$TPN_name = $row['TPN_name'];
	$TPN_total_row = $row['TPN_total_row'];
	$TPN_total_column = $row['TPN_total_column'];
	$TPN_status = $row['TPN_status'];
?>
 	<tr id="<?php echo $TPN_id.' '.$TPN_status; ?>">
    <td><?php echo $sl_no; ?></td>
	<td><?php echo $TPN_name; ?></td>
	<td class="text-center" id="row_id"><?php echo $TPN_total_row;?></td>
    <td class="text-center" id="column_id"><?php echo $TPN_total_column;?></td>
    <td class="text-center"><?php echo showStatus($con, $TPN_status); ?></td>
   
     <form action="MT_template_view.php" role="form" method="get" target="_blank" class="form_view">
     <input type="hidden" name="tpn_id" value="<?php echo $TPN_id; ?>">
     <td class="text-center"><button class="btn btn-mini btn-primary" type="submit"><i class="fa fa-list fa-fw"></i></button></td>
    </form>
    
    <form action="MT_template_add.php" role="form" method="get" target="_blank" class="form_edit">
     <input type="hidden" name="tpn_id" value="<?php echo $TPN_id; ?>">
     <input type="hidden" name="tid" value="<?php echo $tid; ?>">
     <td class="text-center btn_edit"><button class="btn btn-mini btn-primary btn_edit" type="submit"><i class="fa fa-edit fa-fw"></i></button></td>
    </form>
    
    <form action="MT_template_delete.php" role="form" method="get" target="_blank" class="form_delete">
     <input type="hidden" name="tpn_id" value="<?php echo $TPN_id; ?>">
     <input type="hidden" name="tid" value="<?php echo $tid; ?>">
     <td class="text-center btn_delete"><button class="btn btn-mini btn-primary btn_delete" type="submit"><i class="fa fa-times fa-fw"></i></button></td>
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
		"bAutoWidth": true,		    			
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
	  }).makeEditable({
		sUpdateURL: "MT_template_name_ajax_update.php",		
		aoColumns: [
					null,
					{							
							tooltip: 'Click to update',
							loadtext: 'loading...',
							cssclass: 'required',
							onblur: 'cancel',
							submit: 'ok',
							width: '80%',
							event: 'click',
							oValidationOptions : 
										   {     rules:{ value: { required: true, minlength: 3 } },
											 messages: { value: { minlength: "Min. 3 characters" } }						  
		                                   },
						},
						{							
							tooltip: 'Click to update',
							loadtext: 'loading...',
							cssclass: 'required',
							onblur: 'cancel',
							submit: 'ok',
							width: '50%',
							event: 'click',
							oValidationOptions : 
										   {     rules:{ value: { required: true, digits: true, minlength: 1, maxlength:3 } },
											 messages: { value: { minlength: "Min. 1 digit",  maxlength: "Max. 3 digits" } }						  
		                                   },
						},
				{							
							tooltip: 'Click to update',
							loadtext: 'loading...',
							cssclass: 'required',
							onblur: 'cancel',
							submit: 'ok',
							width: '50%',
							event: 'click',
							oValidationOptions : 
										   {     rules:{ value: { required: true, digits: true, minlength: 1, maxlength:3, max:4 } },
											 messages: { value: { minlength: "Min. 1 digit",  maxlength: "Max. 3 digits" } }						  
		                                   },
						},
				
					
					null,
					null,
					null,
					
				  ],
					
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
                                break;                   
                        }
                    },
                   
    });
	
// pop up
$('.form_view').submit(function() {	
    window.open('', 'MT_template_view.php', "width=1000,height=550,resizeable,scrollbars");
    this.target = 'MT_template_view.php';
    });
$('.form_edit').submit(function() {	
    window.open('', 'MT_template_add.php', "width=1000,height=550,resizeable,scrollbars");
    this.target = 'MT_template_add.php';
    });
$('.form_delete').submit(function() {	
    window.open('', 'MT_template_delete.php', "width=1000,height=350,resizeable,scrollbars");
    this.target = 'MT_template_delete.php';
    });

});
</script> 

</body>
</html>
<?php } ob_flush();?>