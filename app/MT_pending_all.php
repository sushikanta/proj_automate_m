<?php require_once("check_login_mt.php"); ?>
<!DOCTYPE html>
<html>
<head>
 <title>List</title>
   <?php require_once("css_bootstrap_datatable_header.php"); ?> 
   <?php require_once("print-borderless-tbl.php"); ?>  
</head>
<body id="myBody">
<?php require_once("right_top_header_mt.php"); ?>
<div class="container">
 <div class="page-content">
 <div class="inv-main" id="printableArea">	
 
  <div class="panel panel-success">  <!----------------------START Patient list-------------->
	<div class="panel-heading light_purple_color">
    
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     List <span class="panel_subTitle no-print">
	 <?php if(isset($_GET['tid']) && $_GET['tid'] =='1') { echo "( Pending )";}
	 	   if(isset($_GET['tid']) && $_GET['tid'] =='2') { echo "( EIDs Today )";}
		   ?>
	 </span>

<button id="close_all" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-times fa-lg"></i> Reset&nbsp;</button>
           
<span class="date_time pull-right light_purple_color" style="padding-right:10px;"> <i class="fa fa-calendar"></i> <span id="show_date"></span></span>
  
     </h3>
    </div> 
<div class="panel-body">                                     
                               
<table cellpadding="0" cellspacing="0" border="0" class="table-hover table-condensed" id="p_list_table">
<thead align="left">
  <tr>
      <th> # </th>
      <th> Reg No.</th>
      <th> Name </th>
      <th><i class="fa fa-male"></i><i class="fa fa-female"></i> </th>
      <th>Age</th>
      <th>Marital</th>
      <th>Address</th>
      <th>Date</th>
      <th class=" width_8">Time</th>      
      <th class="no-print">Report</th>
  </tr>
</thead>
<tbody>
<?php
if(isset($_GET['tid']) && $_GET['tid'] =='1'){
$result = mysqli_query($con, "SELECT r.pr_receipt_no, r.pr_date, r.pr_status_id, r.pr_patient_id, r.pr_source_id, p.PI_id, p.PI_name, p.PI_marital_id, p.PI_gender, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_state_id, p.PI_district_id, p.PI_pin, p.PI_phone, patient_payment.PP_bal, s.state_name, d.district_name, m.marital_name, g.gender_name FROM patient_registration r LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = r.pr_receipt_no LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id  LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE r.pr_status_id=1 ORDER BY r.pr_date DESC");
}

if(isset($_GET['tid']) && $_GET['tid'] =='2'){
	
$today = date("Y-m-d");
$result = mysqli_query($con, "SELECT r.pr_receipt_no, r.pr_date, r.pr_status_id, r.pr_patient_id, r.pr_source_id, p.PI_id, p.PI_name, p.PI_marital_id, p.PI_gender, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_state_id, p.PI_district_id, p.PI_pin, p.PI_phone, patient_payment.PP_bal, s.state_name, d.district_name, m.marital_name, g.gender_name FROM patient_registration r LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = r.pr_receipt_no LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id  LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE DATE_FORMAT(r.pr_date,'%Y-%m-%d')='$today' ORDER BY r.pr_date DESC");
}

$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
  $receipt_no=$row['pr_receipt_no'];
  $pr_date=$row['pr_date'];
  $pr_status_id=$row['pr_status_id'];
  $pr_patient_id=$row['pr_patient_id'];
  
  $PI_id=$row['PI_id'];
  $PI_name=$row['PI_name'];
  $PI_age_y=$row['PI_age_y'];
  $PI_age_m=$row['PI_age_m'];
  $PI_age_d=$row['PI_age_d'];
  $PI_address=$row['PI_address'];
  $PI_pin=$row['PI_pin'];
  $PI_phone=$row['PI_phone'];
  
  $PP_bal=$row['PP_bal'];
  
  $gender_name=$row['gender_name'];
  $marital_name=$row['marital_name'];
  $district_name=$row['district_name'];
  $state_name=$row['state_name'];
  
?>
 <tr id="<?php echo $receipt_no; ?>">
      <td class="readonly-bg"> <?php echo $sl_no; ?> </td>
      <td style="color:#00F; cursor:not-allowed;"><?php echo 'ED/'.$receipt_no; ?> </td>
      <td class="readonly-bg"><?php echo $PI_name; ?> </td>
      <td style="cursor:not-allowed;"><?php echo $gender_name;?></td>
      <td style="cursor:not-allowed;"><?php echo show_age_long($con, $PI_age_y, $PI_age_m, $PI_age_d);?></td>  
      <td style="cursor:not-allowed;"><?php echo $marital_name;?></td>  
      <td class="readonly-bg"><?php echo $PI_address.', '.$district_name.', '.$state_name; ?> <?php if($PI_pin !=""){echo '-'.$PI_pin;} ?></td>
      <td class="readonly-bg"><?php echo date("d/m/Y", strtotime($pr_date)); ?></td>
      <td class="readonly-bg"><?php echo date("h:i a", strtotime($pr_date)); ?></td>
      <td class="no-print" title="Click to update Status">
      <form action="MT_patient_investigation_view.php" role="form" method="get" target="_blank" class="form_status">
      <input type="hidden" name="receipt_no" value="<?php echo $receipt_no;?>"/>
      <button class="btn btn-mini btn-primary" type="submit" style="text-align:right;"> 
	  <?php 
	  $count_pending = showTest_count($con, $receipt_no, '1');
	  //$count_cancel = showTest_count($con, $receipt_no, '3');
	  //$count_delivered = showTest_count($con, $receipt_no, '5');
	  //$count_avail = showTest_count($con, $receipt_no, '11');
	  //$count_return = showTest_count($con, $receipt_no, '12');
	  $count_total = showTest_count($con, $receipt_no, '0');
	  
	  if($count_pending != 0 ){echo 'P='.$count_pending.' / '; }
	  //if($count_delivered != 0 ){echo 'Delivered : '.$count_delivered.'<br/>'; }
	  //if($count_avail != 0 ){echo 'Available : '.$count_avail.'<br/>'; }
	  //if($count_return != 0 ){echo 'Return : '.$count_return.'<br/>'; }
	  //if($count_cancel != 0 ){echo 'Cancelled : '.$count_cancel.'<br/>'; }
	  if($count_total != 0 ){echo 'T='.$count_total; }
	   ?>
       </button>
     </abbr> 
      </form>
      </td>
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
<?php require_once("script_bootstrap_datatable.php"); ?> 
<?php require_once("script_saveto_excel.php"); ?>
<?php require_once("script_print_bw_div.php"); ?>      
<script charset="utf-8" type="text/javascript">
$(document).ready(function() {
	
  $('.form_status').submit(function() {	
    myWindow2 = window.open('', 'MT_patient_investigation_view.php', "width=1000, min-height=300,resizeable,scrollbars");
    this.target = 'MT_patient_investigation_view.php';
    });

 $('#close_all').click(function(e) {
       myWindow1 = window.open('', 'MT_patient_investigation_view.php');
	   myWindow1.close();
    });
    
  $('#p_list_table').dataTable( {  
  
  		"bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": false,
        "bStateSave": false,
		"bBootstrap": true,
		"bAutoWidth": false,
		"bFilter": true,
		"bInfo": false,

		"fnPreDrawCallback": function( oSettings ) {		
		  $('.dataTables_filter input').addClass('form-control input-sm');
		  $('.dataTables_filter input').attr('placeholder', 'Search');	
		  $('.dataTables_filter input').css('height', '33px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  $('.dataTables_length select').css('height', '33px');	
		  $('.dataTables_length select').css('margin-right', '3px');	
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');  }
    });	
});
 </script>
</body>
</html>
<?php ob_flush();?>