<?php require_once("check_login_mt.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Delete Template</title>
<?php require_once("css_bootstrap_header.php");?> 
<body>
<?php require_once("right_top_header_popup.php");?>


<?php 
	if(isset($_GET['update'])){
		
		$tpn_id = $_GET['tpn_id'];	
		$row_no = $_GET['total_row'];
		$column_no = $_GET['total_column'];
		$input_name = $_GET['input_name'];
				
		for ($r = 1; $r <= $row_no; $r++) {
  		for ($c = 1; $c <= $column_no; $c++) {
			
		$input_name_x = $input_name[$r][$c];
		
	$check = mysqli_query($con, "SELECT TPB_id, TPB_name FROM template_body WHERE TPB_tpn_id = '$tpn_id' AND TPB_row = '$r' AND TPB_column = '$c'");

  mysqli_autocommit($con, false);
	$flag = true;
  
  if (mysqli_num_rows($check) != 0) // record = Yes
		 {
		  while($row = mysqli_fetch_array($check)) 
		  	{ $tpb_id = $row['TPB_id'];}
			
			if($input_name_x !="")
				{
		  			mysqli_query($con, "UPDATE template_body SET TPB_name = '".$input_name_x."' WHERE TPB_id = '$tpb_id'");
					if(mysqli_affected_rows($con) < 0) { $flag = false; echo "Error : Description " . mysqli_error($con). ".";}
	
				}
				else
				{
					mysqli_query($con, "DELETE FROM template_body WHERE TPB_id = '$tpb_id'");
					if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "Error : Del " . mysqli_error($con). ".";}
				}
		 }
  
  if (mysqli_num_rows($check) == 0 && $input_name_x !="") // record = no && input = Yes
		{
		  resetCounter($con, 32, 'mm');   				//  Reset TPB_id (template_body)
		  $TPB_id = date("yn").getCounter($con, 32);
		  $result = mysqli_query($con, "INSERT INTO template_body(TPB_id, TPB_tpn_id, TPB_name, TPB_row, TPB_column) VALUES ('$TPB_id', '$tpn_id', '".$input_name_x."', '$r', '$c')");
		  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "";}
			else updateCounter($con, 32);	
		}
	 }
	}
	
	if($flag){
			mysqli_commit($con);
			header("location:MT_template_view.php?tpn_id=$tpn_id"); 
			} 
		else {
			mysqli_rollback($con);	
			echo " !"; http_response_code(404); }
	
	 
}
?>

<div class="container">
 <div class="page-content">
 
 <!------------------- start loading..--------------------------------->
  <div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
  <div class="inv-main" id="div_main">

<?php if(isset($_GET['tpn_id']) && $_GET['tpn_id']!=""){ 
			$tpn_id = $_GET['tpn_id'];
	?>

<div class ="panel panel-success" style ="min-height:200px;">
    <div class="panel-heading light_purple_color">
    <h3 class="panel-title"><i class="fa fa-cubes fa-lg fa-fw"></i> &nbsp;&nbsp;&nbsp;
    Edit <span class="panel_subTitle">( Template - <?php $template = showTemplate_Name($con, $tpn_id); echo $template; ?> )</span>
    </h3>
	</div>    
 <?php 
 $result = mysqli_query($con, "SELECT TPN_name, TPN_total_row, TPN_total_column, TPN_status FROM template_name WHERE TPN_id = '$tpn_id' AND TPN_status != '35' AND TPN_status != '34'"); 
	if(mysqli_num_rows($result) != 0) {
	while($row=mysqli_fetch_array($result)){
    $t_row=$row['TPN_total_row'];
	$t_column=$row['TPN_total_column'];
	$TPN_status=$row['TPN_status'];
	}
  ?>  
<form class="form-horizontal inv-form" role="form" method="get" action="#" id="form_edit">

<table cellpadding="0" cellspacing="0" border="0" class="table table-hover" id="test_tbl">
<thead align="left">
<tr>
    <th colspan="<?php echo $t_column+1; ?>" class="text-center"><?php echo $template; ?> 
    <span class="panel_subTitle"> ( This Template name will be seen on Report )</span> </th>
</tr>
</thead>
<tbody> 
 <?php  
	 $sl_no=1; 
	 for($counter_row = 1; $counter_row <= $t_row; $counter_row++)
	 { ?> 
	 <tr>
		<td><?php echo $sl_no; ?></td>
	   
		<?php 
		for($counter_column = 1; $counter_column <= $t_column; $counter_column++) {
		?>
		 <td>
		 <textarea class="form-control" name="input_name[<?php echo $counter_row;?>][<?php echo $counter_column;?>]"
		 placeholder="1) First Row should be Heading | 2) Result box should left blank | 3) All fixed inputs like units, Ranges, descriptions etc should be entered" maxlength = "500" style="width:100%;"><?php echo showData_rowColumn($con, $tpn_id, $counter_row, $counter_column); ?></textarea>
         </td>
	  <?php	} $sl_no++;
	  }

 ?>
 	</tr>    
		<input type="hidden" name="tpn_id" value="<?php echo $tpn_id; ?>">
        <input type="hidden" name="total_column" value="<?php echo $t_column; ?>">
        <input type="hidden" name="total_row" value="<?php echo $t_row; ?>">
</tbody>
</table>
	<div class="form-group">
      <div class="col-lg-offset-4 col-lg-4">
       <button type="submit" class="btn btn-primary btn-block bt_update" style="font-size:16px;" name="update">Update</button>
      </div>
  	</div> 
</form>
 <div class="clear"></div>
</div>

<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap.php"); ?> 
<script type="text/javascript">
$(document).ready(function() {
	$(".bt_update").click(function(event) {
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
<?php } }ob_flush();?>