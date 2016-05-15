<?php require_once("check_login_super.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Report(<?php echo date("d/m/Y") ?>)</title>
  <?php require_once("css_bootstrap_datatable_header.php");?>
  <?php require_once("print.php");?>
 
</head>

<body id="myBody">
<?php 
if(isset($_GET['start']) && $_GET['start'] !='' && isset($_GET['stop']) && $_GET['stop'] !=''){
	$start = $_GET['start'];
	$stop = $_GET['stop'];
	
?>
<?php require_once("right_top_header_sad.php"); ?>

<div class="container">
 <div class="page-content">		    
   <div class="inv-main">
        
   <div class="panel panel-success">  
	<div class="panel-heading light_purple_color">
      <h3 class="panel-title">
      <i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
      Report <span class="panel-subTitle"> ( No Discount, No Due EDs > Dr. wise ) </span>
      <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
      </h3>
      </div>
     
<div class="panel-body"  id="printableArea">
 
<div>
<label class="control-label blue_color" style="width:100%; text-align:center;">Doctor wise EDs <span class="panel-subTitle">( <?php echo date("d/m/Y", strtotime($start)).' - '.date("d/m/Y", strtotime($stop)); ?> )</span></label>
<table class="table table-striped table-bordered" style="width:100%;">
<thead align="left">
<tr>
  <th class="text-center">SL</th>
  <th>Dorctor Name</th>
  <th class="text-center">NO Due/Disc EIDs</th>
  <th class="text-center">Total Bill</th>
  <th class="text-center">View</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT DISTINCT r.pr_dr_prescription FROM patient_registration r INNER JOIN patient_payment y ON r.pr_receipt_no = y.PP_receipt_no WHERE pr_dr_prescription !='NO' AND DATE_FORMAT(r.pr_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND y.PP_bal = 0 AND y.PP_disc ='2'");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$dr_id = $row['pr_dr_prescription'];

  ?>
 	<tr>
	   <td class="readonly-bg text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php if($dr_id =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $dr_id);} ?></td>
           
       <td class="text-center"><?php echo doctorWise_registration($con, $dr_id, $start, $stop);?></td>
       <td class="text-center"><?php echo sumNet_eachPerson($con, $dr_id, $start, $stop); ?></td>
       
       <td class="text-center">
       <form  action="SAD_report_bw_dates_detail.php" class="form-horizontal inv-form form_1" role="form" method="get" target="_blank">      
        <input type="hidden" name="start" value="<?php echo $start;?>">
        <input type="hidden" name="stop" value="<?php echo $stop;?>">
        <input type="hidden" name="src" value="1">
        <input type="hidden" name="ref" value="<?php echo $dr_id;?>">     
        <button type="submit" class="btn btn-mini btn-primary"> <i class="fa fa-list fa-fw"></i> </button>
       </form>
       </td>
     </tr>
	
<?php 
$sl_no++;
}
?>

 <tbody>
 </table>
   </div>
   
   
 
</div>
<div class="clear"></div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?>    
<script type="text/javascript">
	$(document).ready(function(){
	$('.form_1').submit(function(){	
		 window.open('', 'SAD_report_bw_dates_detail.php', "width=1300,height=550,resizeable,scrollbars");
		this.target = 'SAD_report_bw_dates_detail.php';
		});
	});
</script>
</body>
</html>
<?php } ob_flush();?>