<?php require_once("check_login_mt.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Delete / Disable</title>
<?php require_once("css_bootstrap_header.php");?> 
<body>
<?php
	 //Disable
	  if(isset($_GET['btn_disable'])){
		$tpn_id = $_GET['tpn_id'];
		$tid = $_GET['tid'];
		
	  mysqli_autocommit($con, false);
	  $flag = true;
	  
	  mysqli_query($con, "UPDATE template_name SET TPN_status = '35' WHERE TPN_id = '$tpn_id'");
	  if (mysqli_affected_rows($con) < '0') { $flag = false; echo "Error : ".mysqli_error($con);}
	  
	  if($flag){
		  mysqli_commit($con);
		  //header("location: MT_template_list.php?tid=$tid"); 
		  } 
	  else {
		  mysqli_rollback($con);	
		  echo " ! "; http_response_code(404); }	
	  }
	  
	//Delete  
	 if(isset($_GET['btn_delete'])){
		$tpn_id = $_GET['tpn_id'];
		$tid = $_GET['tid'];
		
		
	  mysqli_autocommit($con, false);
	  $flag = true;
	  
	  mysqli_query($con, "DELETE FROM template_name WHERE TPN_id = '$tpn_id'");
	  if (mysqli_affected_rows($con) <= '0') { $flag = false; echo "Error : ".mysqli_error($con);}
	  
	  mysqli_query($con, "DELETE FROM template_body WHERE TPB_tpn_id IS NOT NULL AND TPB_tpn_id = '$tpn_id'");
	  if (mysqli_affected_rows($con) < '0') { $flag = false; echo "Error Syntex : ".mysqli_error($con);}
	  //if (mysqli_affected_rows($con) < '0') { $flag = false; echo "Error Syntex : ".mysqli_error($con);}
	  
	  if($flag){
		  mysqli_commit($con);
		  //header("location: MT_template_list.php?tid=$tid"); 
		  } 
	  else {
		  mysqli_rollback($con);	
		  echo " ! "; http_response_code(404); 
		  }	
	  }
 ?>
<?php require_once("right_top_header_popup.php");?>
<?php if(isset($_GET['tpn_id']) && $_GET['tpn_id']!="")
	{ 
	  $tpn_id = $_GET['tpn_id'];
	  $tid = $_GET['tid']; 
?>

<div class="container">
 <div class="page-content">
  
   <!------------------- start loading..--------------------------------->
  <div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
  <div class="inv-main" id="div_main">

  <div class="panel panel-success" style="min-height:200px;">
    <div class="panel-heading light_purple_color">
    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-lg fa-fw"></i> &nbsp;&nbsp;&nbsp;
    Delete / Disable <span class="panel_subTitle">( Template Name - <?php echo showTemplate_Name($con, $tpn_id); ?> )</span>
      	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i>  <span id="show_date"></span></span>
    </h3>
	</div>    
    
<?php $result = mysqli_query($con, "SELECT TPN_name, TPN_total_row, TPN_total_column, TPN_status FROM template_name WHERE TPN_id = '$tpn_id'");
 
if(mysqli_num_rows($result) != 0) {
	while($row=mysqli_fetch_array($result)){
    $t_row=$row['TPN_total_row'];
	$t_column=$row['TPN_total_column'];
	$TPN_status=$row['TPN_status'];	
	}
	?>                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover">
<thead align="left">
<tr>
   <th colspan="<?php echo $t_column+1; ?>" class="text-center">
   <input type="hidden" id="status_id" value="<?php echo $TPN_status; ?>">
   <span class="panel_subTitle">Template Status : <?php echo showStatus($con, $TPN_status); ?> </span>
   </th>
</tr>
</thead>
<tbody>
 
 <?php $sl_no=1; for($counter_row = 1; $counter_row <= $t_row; $counter_row++)
	{  ?> 
 <tr id="<?php echo $row['TPB_id'] ; ?>">
    <td><?php echo  $sl_no; ?> </td>
   
	<?php for($counter_column = 1; $counter_column <= $t_column; $counter_column++)
			  { ?>
			  <td><?php echo showData_rowColumn($con, $tpn_id, $counter_row, $counter_column); ?> </td>
	  <?php	}
			$sl_no++;
		   }} ?>
 	</tr>
    
</tbody>
</table>
  <form role="form" method="get">
  <div class="text-center">
 <button type="submit" name="btn_disable" class="btn btn-primary width_20" id="btn_disable"><i class="fa fa-trash-o fa-fw"></i> DISABLE</button>
 <button type="submit" name="btn_delete" class="btn btn-primary width_20" id="btn_delete"><i class="fa fa-trash-o fa-fw"></i> DELETE </i> </button>
 <button type="button" class="btn btn-primary width_20" onclick="window.close()"><i class="fa fa-times fa-fw"></i> CLOSE </button>
  </div>
     <input type="hidden" name="tpn_id" value="<?php echo $tpn_id; ?>">
     <input type="hidden" name="tid" value="<?php echo $tid; ?>">
  </form>
 
 <div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap.php"); ?>
<script type="text/javascript">
$(document).ready(function() {
	
	$("#bt_update, #btn_delete").click(function(event) {
			if( !confirm('Are you sure ?'))
				event.preventDefault();
				$('form').submit(function () {
				  $('#div_main').hide();
				  $('#divWait').show();
			  });
		});
	

	var status = $('#status_id').val();
	if (status == '33'){$('#btn_disable').attr('disabled', true);}
	if (status == '34'){$('#btn_delete').attr('disabled', true);}
	if (status == '35'){$('#btn_delete, #btn_disable').attr('disabled', true); }
	
	
	
	

});


</script>
  </body>
</html>
<?php } ob_flush();?>