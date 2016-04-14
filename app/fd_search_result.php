<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
<head>
 <title>Search Result</title>
   <?php require_once("css_bootstrap_datatable_header.php"); ?>
</head>
<body id="myBody">
<?php require_once("right_top_header.php"); ?>
<?php require_once("print-borderless-ac.php");?>
<div class="container">
 <div class="page-content">
 <div class="inv-main" id="printableArea">

  <div class="panel panel-success" id="printableArea">  <!----------------------START Patient list-------------->
	<div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-lg fa-fw"></i> &nbsp;&nbsp;&nbsp;
     Search Result <span class='panel-subTitle'> ( Update Status / Due, New Registration, Payment history )</span>
   <button style="margin-left:10px; margin-top:-5px;" class="no-print btn btn-mini btn-primary pull-right" id="close_all">
      <i class="fa fa-times fa-lg"></i> Reset&nbsp;</button>
   <button style="margin-left:10px; margin-top:-5px;" onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right">
   <i class="fa fa-print fa-lg"></i> Print &nbsp;</button>
    </h3>
    </div>

<?php
   if(isset($_GET['tid']) && $_GET['tid'] !="" ){
	   $tid = $_GET['tid'];
	   if(isset($_GET['receipt_no']) && $_GET['receipt_no'] !="" ) {$pass_receipt_no = $_GET['receipt_no'];}
	   if(isset($_GET['patient_id']) && $_GET['patient_id'] !="" ) {$patient_id = $_GET['patient_id'];}
?>
<div class="panel-body">
<table cellpadding="0" cellspacing="0" border="0" class="table-hover width_100" id="result_tbl">
<thead align="left">
  <tr class="bg_print_th">
      <th> # </th>
      <th> Reg.#</th>
      <th> Name </th>
      <th><i class="fa fa-male"></i><i class="fa fa-female"></i> </th>
      <th> <i class="fa fa-home"></i> Address </th>
      <th> <i class="fa fa-calendar"></i> Date </th>
      <th class="no-print"> <i class="fa fa-spinner fa-spin fa-lg fa-fw green_color"></i>Update</th>
      <th> Status </th>
      <th> Due </th>
      <th class="no-print">Receipt</th>
      <th class="no-print"><i class="fa fa-search-plus green_color"></i></th>
      <th class="no-print">New</th>
  </tr>
</thead>
<tbody>
<?php
// for receipt no
if($tid == '1'){  // EID, NAME,
$result = mysqli_query($con, "SELECT r.pr_receipt_no, r.pr_date, r.pr_status_id, r.pr_patient_id, r.pr_source_id, p.PI_id, p.PI_name, p.PI_marital_id, p.PI_gender, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_state_id, p.PI_district_id, p.PI_pin, p.PI_phone, patient_payment.PP_bal, s.state_name, d.district_name, m.marital_name, g.gender_name FROM patient_registration r LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = r.pr_receipt_no LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id  LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE r.pr_receipt_no='$pass_receipt_no' ORDER BY r.pr_receipt_no ASC");
}

// for patient_id
if($tid == '2'){ // CS_id, patient_name
$result = mysqli_query($con, "SELECT r.pr_receipt_no, r.pr_date, r.pr_status_id, r.pr_patient_id, r.pr_source_id, p.PI_id, p.PI_name, p.PI_marital_id, p.PI_gender, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_state_id, p.PI_district_id, p.PI_pin, p.PI_phone, patient_payment.PP_bal, s.state_name, d.district_name, m.marital_name, g.gender_name FROM patient_registration r LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = r.pr_receipt_no LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id  LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE r.pr_patient_id='$patient_id' ORDER BY r.pr_receipt_no ASC");
}

// for Date
if($tid == '3'){ // DATE
	$start = date("Y-m-d", strtotime($_GET['start']));
    $end = date("Y-m-d", strtotime($_GET['end']));
$result = mysqli_query($con, "SELECT r.pr_receipt_no, r.pr_date, r.pr_status_id, r.pr_patient_id, r.pr_source_id, p.PI_id, p.PI_name, p.PI_marital_id, p.PI_gender, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_state_id, p.PI_district_id, p.PI_pin, p.PI_phone, patient_payment.PP_bal, s.state_name, d.district_name, m.marital_name, g.gender_name FROM patient_registration r LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = r.pr_receipt_no LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id  LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE DATE_FORMAT(r.pr_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$end."' ORDER BY r.pr_receipt_no ASC");
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
      <td style="color:#00F; cursor:not-allowed;"><?php echo $receipt_no; ?></td>
      <td class="readonly-bg"><?php echo $PI_name; ?></td>
      <td style="cursor:not-allowed;"><?php echo $gender_name.'</br>'.show_age_long($con, $PI_age_y, $PI_age_m, $PI_age_d).'</br>'.$marital_name;?></td>
      <td class="readonly-bg"><?php echo $PI_address.'</br>'.$district_name.', '.$state_name.'</br>'.$PI_pin; ?></td>

      <td class="readonly-bg"><?php echo date("d/m/Y", strtotime($pr_date)); ?><br/><?php echo  date("h:i a", strtotime($pr_date)); ?></td>
      <td class="no-print" title="Click to update Status">

      <form action="patient_investigation_status.php" role="form" method="get" target="_blank" class="form_status">
      <input type="hidden" name="receipt_no" value="<?php echo $receipt_no;?>"/>
      <button class="text-right btn btn-small btn-primary" type="submit" name="report_go">

	  <?php
	  $count_pending = showTest_count($con, $receipt_no, '1');
	  $count_delivered = showTest_count($con, $receipt_no, '5');
	  $count_avail = showTest_count($con, $receipt_no, '11');
	  $count_return = showTest_count($con, $receipt_no, '12');
	  $count_cancel = showTest_count($con, $receipt_no, '3');
	  $count_total = showTest_count($con, $receipt_no, '0');

	  if($count_pending != 0 ){echo 'Pending : '.$count_pending.'<br/>'; }
	  if($count_delivered != 0 ){echo 'Delivered : '.$count_delivered.'<br/>'; }
	  if($count_avail != 0 ){echo 'Available : '.$count_avail.'<br/>'; }
	  if($count_return != 0 ){echo 'Return : '.$count_return.'<br/>'; }
	  if($count_cancel != 0 ){echo 'Cancelled : '.$count_cancel.'<br/>'; }
	  if($count_total != 0 ){echo 'Total : '.$count_total.'<br/>'; }
	   ?>
       </button>
      </form>
      </td>
      <td style="font-style:italic; color: #33C;"><?php echo showStatus($con, $pr_status_id); ?></td>

   <?php $bal = $row['PP_bal'];
   		if($bal > 0 || $bal < 0)
			{ echo '<td style="color:#EE1217;">'.number_format($bal,'2','.','').'</td>';}
		else{ echo '<td style="color:#478C19;">'."0.00".'</td>';}?>

      <td class="no-print" title="Receipt">
      <abbr title="View Receipt">
      <form action="patient_receipt.php" role="form" method="get" target="_blank" class="form_receipt">
      <input type="hidden" name="receipt_no" value="<?php echo $receipt_no;?>"/>
      <button class="btn btn-small btn-primary" type="submit"><i class="fa fa-print"></i></button>
      </form>
      </abbr>
      </td>

      <td class="no-print" title="View History">
      <form action="trace_result_reg.php" role="form" method="get" target="_blank" class="form_trace">
      <input type="hidden" name="receipt_no" value="<?php echo $receipt_no;?>"/>
      <button type="submit" class="btn btn-small btn-primary"><i class="fa fa-search-plus"></i></button>
      </form>
      </td>

      <td class="no-print" title="New Registration">
      <form action="patient_registration_card.php" role="form" method="get" target="_blank" class="form_new">
      <input type="hidden" name="patient_id" value="<?php echo $PI_id;?>"/>
      <button class="btn btn-small btn-primary" type="submit"><i class="fa fa-plus"></i></button>
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
<?php require_once("script_print_bw_div.php"); ?>
<script charset="utf-8" type="text/javascript">
$(document).ready(function() {

  $('.form_receipt').submit(function() {
    window.open('', 'patient_receipt.php', "width=1200,height=550,resizeable,scrollbars");
    this.target = 'patient_receipt.php';
    });

  $('.form_status').submit(function() {
    window.open('', 'patient_investigation_status.php', "width=1300,height=500,resizeable,scrollbars");
    this.target = 'patient_investigation_status.php';
    });

  $('.form_new').submit(function() {
    window.open('', 'patient_registration_card.php', "width=1300,height=500,resizeable,scrollbars");
    this.target = 'patient_registration_card.php';
    });

   $('.form_trace').submit(function() {
    window.open('', 'trace_result_reg.php', "width=1300,height=500,resizeable,scrollbars");
    this.target = 'trace_result_reg.php';
    });


  $('#result_tbl').dataTable({
    "bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
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
		  $('.dataTables_length select').css('float', 'left');}
    });

$('#result_tbl').dataTable().makeEditable({

       // sDeleteURL:   "ajax_patient_registration_delete.php",
		sUpdateURL:   "fd_pending_all_ajax_update.php",

		sAddNewRowFormId:  "formPatient_list",
		sAddNewRowButtonId: "btnAddNewRow",
		sDeleteRowButtonId: "btnDeleteRow",

		oDeleteRowButtonOptions: {
                                label: "Remove",
                                icons: { primary: 'ui-icon-trash' }
		},

		aoColumns: [
					null,
					null,
					null,
					null,
					null,
					null,
					null,
				    	{
							tooltip: 'Click to update',
							loadtext: 'loading...',
							cssclass: 'required',
							width: '50%',
							type: 'select',
							onblur: 'cancel',
							submit: 'ok',
							event: 'click',
							data: "{'1':'Pending','5':'Delivered','6':'Blocked','11':'Report Available', '12':'Report Return' }",
							},

						/*{
							tooltip: 'Click to update',
							loadtext: 'loading...',
							cssclass: 'required',
							onblur: 'cancel',
							submit: 'ok',
							width: '50%',
							event: 'click',
							oValidationOptions :
										   {     rules:{ value: { required: true, number: true, minlength: 1 } },
											 messages: { value: { minlength: "Min. 1 digit" } }
		                                   },
						},*/
					null,
					null,
					null,
				],

	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
								//setTimeout('window.location.reload()', 1000);
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
								//setTimeout('window.location.reload()', 1000);
                                break;
                            case "add":
                                jAlert(message, "Add failed");
                                break;
                        }
                    },
    });

  $('#close_all').click(function(e) {
       myWindow1 = window.open('', 'patient_receipt.php');
     myWindow1.close();
     myWindow2 = window.open('', 'patient_investigation_status.php');
     myWindow2.close();
     myWindow3 = window.open('', 'patient_registration_card.php');
     myWindow3.close();
      myWindow4 = window.open('', 'trace_result_reg.php');
     myWindow4.close();
    });
});
 </script>
</body>
</html>
<?php } ob_flush();?>
