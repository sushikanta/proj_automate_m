<?php require_once("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '22')
 {
	?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Template</title>
<?php require_once("css_bootstrap_header.php"); ob_start();?> 
<body>
<?php require_once("right_top_header_mt.php");?>


<?php 
	if(isset($_GET['update'])){
		
		$template_id = $_GET['template_name_id'];	
		$row_no = $_GET['total_row'];
		$column_no = $_GET['total_column'];
		$input_name = $_GET['input_name'];
		//$test_id = getTest_id_using_template($con, $template_id);
				
		for ($r = 1; $r <= $row_no; $r++) {
  		for ($c = 1; $c <= $column_no; $c++) {
			
		$input_name_x = $input_name[$r][$c];
		
	$check = mysqli_query($con, "SELECT TPB_id, TPB_name FROM template_body_tbl WHERE TPB_tpn_id = '$template_id' AND TPB_row = '$r' AND TPB_column = '$c'");
	if (mysqli_num_rows($check) != 0)
		 {
		  while($row = mysqli_fetch_array($check)) 
		  	{ $tpb_id = $row['TPB_id'];}
			
			if($input_name_x !="")
				{
		  			mysqli_query($con, "UPDATE template_body_tbl SET TPB_name = '".$input_name_x."' WHERE TPB_id = '$tpb_id'");
				}
				else
				{
					mysqli_query($con, "DELETE FROM template_body_tbl WHERE TPB_id = '$tpb_id'");
				}
		 }
  if (mysqli_num_rows($check) == 0 && $input_name_x !="")
		{
		  resetCounter_value($con, 32);   						//  Reset TPB_id (template_body_tbl)
		  $TPB_id = date("dmy").getCounter_value($con, 32);
		  $result = mysqli_query($con, "INSERT INTO template_body_tbl(TPB_id, TPB_tpn_id, TPB_name, TPB_row, TPB_column) VALUES ('$TPB_id', '$template_id', '".$input_name_x."', '.$r.', '.$c.')");		
		}
	}
	}
	 header("location:MT_template_view_detail_edit.php?tpn_id=$template_id&row=$row_no&column=$column_no&smsg=1"); 
}
?>




<?php if(isset($_GET['tpn_id']) && $_GET['tpn_id']!="" && isset($_GET['row']) && $_GET['row']!="" && isset($_GET['column']) && $_GET['column']!=""){ 
			$tpn_id = $_GET['tpn_id'];
			$t_row = $_GET['row'];
			$t_column = $_GET['column'];
	?>

<div class="container">
 <div class="page-content">
  <div class="inv-main">

<div class ="panel panel-success" style ="min-height:500px;">
    <div class="panel-heading light_purple_color"><h3 class="panel-title"><i class="fa fa-cubes fa-lg fa-fw"></i> Edit 
		<span class="panel_subTitle">( Template Name - <?php echo showTemplate_Name($con, $tpn_id); ?> )</span>
      	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i>  <span id="show_date"></span></span>
	</div>    
    
 <?php if(isset($_GET['smsg']) && $_GET['smsg'] == '1'){ 
 			if ($_GET['smsg'] =='1'){$msg = 'Successfully updated.'; }
			/*if ($_GET['smsg'] =='2'){$msg = 'Username was disabled, please contact system admin.'; } 
			if ($_GET['smsg'] =='4'){$msg = 'Please login first.'; } */
	?>
    <div class="alert alert-success alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><i class="fa fa-check-circle fa fa-lg fa-fw"></i> </strong> <?php echo $msg; ?>
    </div>
 <?php }?>
 
<form class="form-horizontal inv-form" role="form" method="get" action="#" id="form_edit">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover display" id="test_name_price_table">
<thead align="left">
<tr>
    <th colspan="<?php echo $t_column+1; ?>" class="text-center">
    <span class="panel_subTitle">Investigation : <?php echo showTest_using_template($con, $tpn_id); ?> ( <?php echo showDept_using_template($con, $tpn_id);?> )</span> </th>
</tr>
<tr>
    <th> # </th>
    <?php if($t_column == '2'){?>
        <th> INVESTIGATION</th>
		<th>RESULT</th>
     <?php }?>
      <?php if($t_column == '3'){?>
        <th> INVESTIGATION</th>
		<th>RESULT</th>
        <th>UNIT</th>
     <?php }?>
      <?php if($t_column == '4'){?>
        <th> INVESTIGATION</th>
		<th>RESULT</th>
        <th>UNIT</th>		
		<th>REFERENCE RANGE</th>
     <?php }?>
</tr>
</thead>
<tbody>
 
 <?php $sl_no=1; for($counter_row = 1; $counter_row <= $t_row; $counter_row++)
			{  ?>
 
 <tr id="<?php echo $row['TPB_id'] ; ?>">
    <td><?php echo  $sl_no; ?> </td>
   
	<?php for($counter_column = 1; $counter_column <= $t_column; $counter_column++)
			  { 
			  ?>
			  <td>
     <textarea class="form-control" name="input_name[<?php echo $counter_row;?>][<?php echo $counter_column;?>]" placeholder="Input" maxlength = "500" style="width:100%;"><?php echo showData_rowColumn($con, $tpn_id, $counter_row, $counter_column); ?></textarea></td>
	  <?php	}
			$sl_no++;
			} ?>
 	</tr>    
		<input type="hidden" name="template_name_id" value="<?php echo $tpn_id; ?>">
        <input type="hidden" name="total_column" value="<?php echo $t_column; ?>">
        <input type="hidden" name="total_row" value="<?php echo $t_row; ?>">
</tbody>
</table>
	<div class="form-group">
      <div class="col-lg-offset-4 col-lg-4">
       <button type="submit" class="btn btn-primary btn-block" style="font-size:16px;" id="bt_update" name="update">Update</button>
      </div>
  	</div> 
</form>
 <div class="clear"></div>
</div>

<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap.php"); ?> 
<script type="text/javascript">

$("#bt_update").click(function(event) {
        if( !confirm('Are you sure ?')) 
            event.preventDefault();
  });
</script> 
  </body>
</html>
<?php } } ob_flush();?>