<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
<head>
 <title>History</title>
   <?php require_once("css_bootstrap_header.php"); ?>
</head>
<body id="myBody">
<?php require_once("right_top_header_popup.php"); ?>
<?php require_once("print-borderless-ac.php");?> 
<div class="container">
 <div class="page-content">
 <div class="inv-main" id="printableArea">	
 
  <div class="panel panel-success" id="printableArea">
	<div class="panel-heading light_purple_color">
  <?php 
   if(isset($_GET['start']) && $_GET['stop'] !="" ){
    $start = date("Y-m-d", strtotime($_GET['start']));
    $stop =  date("Y-m-d", strtotime($_GET['stop']));
    $user_id =  $_GET['user_id'];
?>
     <h3 class="panel-title"><i class="fa fa-cubes fa-lg fa-fw"></i> &nbsp;&nbsp;&nbsp;
     Activities <span class='panel-subTitle'> ( By - <?php echo showFull_login($con, $user_id); ?> | Date Between : <?php echo date("d/m/Y h:i:a", strtotime($start)); ?> -- <?php echo date("d/m/Y h:i:a", strtotime($stop));?>)</span>
   <button style="margin-left:10px; margin-top:-5px;" class="no-print btn btn-mini btn-primary pull-right" id="close_all">
      <i class="fa fa-times fa-lg"></i> Reset&nbsp;</button>
   <button style="margin-left:10px; margin-top:-5px;" onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right">
   <i class="fa fa-print fa-lg"></i> Print &nbsp;</button>
    </h3>
    </div> 


<div class="panel-body">                               
<table cellpadding="0" cellspacing="0" border="0" class="table table-hover table-condensed" id="result_tbl">
<thead align="left">
  <tr class="bg_print_th">
      <th> # </th>
      <th>Description</th>
      <th>RegId/ExpID</th>
      <th>Action</th>
      <th>Remark</th>
      <th><i class="fa fa-calendar"></i> Date </th>
  </tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT `A_id`, `A_book`, `A_action`, `A_p_id`, `A_remark`, `A_user`, `A_date` FROM `audit_tbl` WHERE A_user = '$user_id' AND DATE_FORMAT(A_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' ORDER BY A_date ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{  
  $A_book=$row['A_book'];
  $A_p_id=$row['A_p_id'];
  $A_action=$row['A_action'];
  $A_remark=$row['A_remark'];
  $A_user=$row['A_user'];
  $A_date=$row['A_date'];
?>
 <tr>
      <td><?php echo $sl_no; ?></td>
      <td><?php echo showStatus($con, $A_book); ?></td>
      <td><?php echo $A_p_id; ?></td>
      <td><?php echo showStatus($con, $A_action); ?></td>
      <td><?php echo $A_remark; ?></td>
      <td><?php echo date("d/m/Y h:i:a", strtotime($A_date)); ?></td>     
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>

</div>
<div class="clear"></div>
</div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap.php"); ?> 
<?php require_once("script_print_bw_div.php"); ?>
</body>
</html>
<?php } ob_flush();?>