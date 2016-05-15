<?php require_once("check_login_mt.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Report Value</title>
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
		  resetCounter($con, 32, 'mm');   						//  Reset TPB_id (template_body)
		  $TPB_id = date("yn").getCounter($con, 32);
		  $result = mysqli_query($con, "INSERT INTO template_body(TPB_id, TPB_tpn_id, TPB_name, TPB_row, TPB_column) VALUES ('$TPB_id', '$tpn_id', '".$input_name_x."', '$r', '$c')");
		  if(mysqli_affected_rows($con) <= 0) { $flag = false; echo "";}
			else updateCounter($con, 32);	
		}
	 }
	}
	
	if($flag){
			mysqli_commit($con);
			//header("location:MT_report_print.php?tpn_id=$tpn_id"); 
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
			$receipt_no = $_GET['receipt_no'];
	$patient_info = mysqli_query($con, "SELECT r.pr_source_id, r.pr_referred_id, r.pr_date, r.pr_status_id, r.pr_dr_prescription, p.PI_id, p.PI_name, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_pin, p.PI_phone, s.state_name, d.district_name, g.gender_name, m.marital_name FROM patient_registration r LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE r.pr_receipt_no = '$receipt_no'");
 
  while($row = mysqli_fetch_array($patient_info))
  {	  
  	  $patient_name = $row['PI_name'];
	  $age_y = $row['PI_age_y'];
	  $age_m = $row['PI_age_m'];
	  $age_d = $row['PI_age_d'];  	  
	  $patient_id = $row['PI_id'];
	  $address = $row['PI_address'];
	  $pin_code = $row['PI_pin'];
  	  $phone = $row['PI_phone'];
	  
	  $gender_name = $row['gender_name'];
	  $marital_name = $row['marital_name'];
  	  $state_name = $row['state_name'];
	  $district_name = $row['district_name'];
	  
  	  $pr_source_id = $row['pr_source_id'];
	  $pr_referred_id = $row['pr_referred_id'];
  	  $pr_date = $row['pr_date'];
	  $pr_status_id = $row['pr_status_id'];
	  $dr_letter = $row['pr_dr_prescription'];	 
	  }
 ?>
<div class ="panel panel-success" style ="min-height:200px;">
    <div class="panel-heading light_purple_color">
    <h3 class="panel-title"><i class="fa fa-cubes fa-lg fa-fw"></i> &nbsp;&nbsp;&nbsp;
    Add <span class="panel_subTitle">( Report Value on <?php $template = showTemplate_Name($con, $tpn_id); echo $template; ?> )</span>
    </h3>
	</div>
    <div class="panel-body">
    <div class="row" style="width:90%; margin-left:5%; margin-top:15px;">
<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
    <tr>
      <td><label>Registration # : </label> ED/<?php echo $receipt_no;?></td>  
      <td><label>Customer ID : </label> <?php echo $patient_id;?></td>
      <td><label><i class="fa fa-calendar"></i> : </label> <?php echo date("d/m/Y, h:i a", strtotime($pr_date));?></td>
    </tr>

  <tr>
  <td colspan="2"><label>Name : </label> <?php echo $patient_name;?></td>
  <td><label><i class="fa fa-male"></i><i class="fa fa-female"></i> : </label> <?php echo $gender_name.' / '.show_age_long($con, $age_y, $age_m, $age_d).' ( '. $marital_name.' )';?></td>
  </tr>
  
  <tr>
  <td><label>Address : </label> 
  <?php if($pin_code !=""){$_pin = ' - '.$pin_code;}else{$_pin = "";} echo $address.', '.$district_name.', '.$state_name.$_pin; ?>
  </td>
   <td><label> <i class="fa fa-phone-square"></i> :</label> <?php if($phone !=""){ echo '+91 '.$phone;}?></td>
  </tr>
 
 <tr>
  <td><label>Dr. Letter : </label> <?php if($dr_letter =='NO'){echo "No";}else{echo "Yes";} ?></td>
  <td><label>Patient History : </label> <?php echo showHistory_patient($con, $patient_id); ?></td>
  <td><label>Lab Notes : </label> <?php echo showLab_note($con, $receipt_no); ?></td>
  </tr>

 <tr> 
  <td><label>Referred By : </label> <?php if($dr_letter =='NO'){echo " Self";}else{echo 'Dr. '.showDoctor_name($con, $dr_letter);} ?></td>
 
  <td><label>Source : </label> 
  <?php echo showReferral($con, $pr_source_id, $pr_referred_id). " (<span style='font-weight:bold; color: #00f;'> ".showSourceName($con, $pr_source_id)."</span> )"; ?></td>
  </tr>
  </table>
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
      <th colspan="<?php echo $t_column+1; ?>" class="text-center"><?php echo $template; ?></th>
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
		 <textarea class="form-control" name="input_name[<?php echo $counter_row;?>][<?php echo $counter_column;?>]" <?php if($counter_column !=2){echo 'disabled';} ?> maxlength = "300" style="width:100%;"><?php echo showData_rowColumn($con, $tpn_id, $counter_row, $counter_column); ?></textarea>
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
</div>
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