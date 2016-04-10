<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
<head>
 <title>List</title>
   <?php require_once("css_bootstrap_datatable_header.php"); ?>
   <?php require_once("print-borderless-tbl.php"); ?>
</head>
<body id="myBody">
<?php require_once("right_top_header.php"); ?>
<div class="container">
 <div class="page-content">
 <div class="inv-main" id="printableArea">

  <div class="panel panel-success">
	<div class="panel-heading light_purple_color">

     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     List <span class="panel_subTitle no-print">
	 <?php if(isset($_GET['tid']) && $_GET['tid'] =='1') { echo "( All Pendings )";}
	 	   if(isset($_GET['tid']) && $_GET['tid'] =='2') { echo "( REGs Today )";}
		   ?>
	 </span>

<button id="close_all" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-times fa-lg"></i> Reset&nbsp;</button>

<!-- Print & SAve -->
<button onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
<i class="fa fa-print fa-lg"></i> Print&nbsp;</button>
<button type="button" onclick="tableToExcel('p_list_table', 'Pending List')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;"><i class="fa fa-file-excel-o fa-fw"></i> Save</button>
<span class="date_time pull-right light_purple_color" style="padding-right:10px;"> <i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div>

<div class="panel-body">
<table cellpadding="0" cellspacing="0" border="0" class="table-hover width_100" id="p_list_table">
<thead align="left">
  <tr>
      <th># </th>
      <th>Reg No.</th>
      <th>Name </th>
      <th><i class="fa fa-male"></i><i class="fa fa-female"></i> </th>
      <th><i class="fa fa-home"></i> Address </th>
      <th><i class="fa fa-calendar"></i> Date </th>
      <th class="no-print"> <i class="fa fa-spinner fa-spin fa-lg fa-fw green_color"></i>Report</th>
      <th>Status </th>
      <th>Due </th>
      <th class="no-print">Receipt</th>
      <th class="no-print"><i class="fa fa-search-plus green_color"></i></th>
      <th class="no-print">New</th>
  </tr>
</thead>
<tbody>
<?php
if(isset($_GET['tid']) && $_GET['tid'] =='1'){
$result = mysqli_query($con, "SELECT r.pr_receipt_no, r.pr_date, r.pr_status_id, r.pr_patient_id, r.pr_source_id, p.PI_id, p.PI_name, p.PI_marital_id, p.PI_gender, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_state_id, p.PI_district_id, p.PI_pin, p.PI_phone, y.PP_bal, s.state_name, d.district_name, m.marital_name, g.gender_name FROM patient_registration r LEFT JOIN patient_payment y ON y.PP_receipt_no = r.pr_receipt_no LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id  LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE r.pr_status_id='1'");
}

if(isset($_GET['tid']) && $_GET['tid'] =='2'){

$today = date("Y-m-d");
$result = mysqli_query($con, "SELECT r.pr_receipt_no, r.pr_date, r.pr_status_id, r.pr_patient_id, r.pr_source_id, p.PI_id, p.PI_name, p.PI_marital_id, p.PI_gender, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_state_id, p.PI_district_id, p.PI_pin, p.PI_phone, y.PP_bal, s.state_name, d.district_name, m.marital_name, g.gender_name FROM patient_registration r LEFT JOIN patient_payment y ON y.PP_receipt_no = r.pr_receipt_no LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id  LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE DATE_FORMAT(r.pr_date,'%Y-%m-%d')='$today'");
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
      <td style="color:#00F; cursor:not-allowed;"><?php echo $receipt_no; ?> </td>
      <td class="readonly-bg"><?php echo $PI_name; ?><br/> (Cus ID: <?php echo $PI_id; ?>) </td>
      <td style="cursor:not-allowed;"><?php echo $gender_name.'</br>'.show_age_long($con, $PI_age_y, $PI_age_m, $PI_age_d).'</br>'.$marital_name;?></td>
      <td class="readonly-bg"><?php echo $PI_address.'</br>'.$district_name.', '.$state_name.'</br>'.$PI_pin; ?></td>

      <td class="readonly-bg"><?php echo date("d/m/Y", strtotime($pr_date)); ?><br/><?php echo  date("h:i a", strtotime($pr_date)); ?></td>
      <td class="no-print">
	  <abbr title="Click to update Status" class="no-print">
      <form action="patient_investigation_status.php" role="form" method="get" target="_blank" class="form_status">
      <input type="hidden" name="receipt_no" value="<?php echo $receipt_no;?>"/>
      <button class="text-right btn btn-small btn-primary" type="submit">

	  <?php
	  $count_pending = showTest_count($con, $receipt_no, '1');
	  $count_cancel = showTest_count($con, $receipt_no, '3');
	  $count_delivered = showTest_count($con, $receipt_no, '5');
	  $count_avail = showTest_count($con, $receipt_no, '11');
	  $count_return = showTest_count($con, $receipt_no, '12');
	  $count_total = showTest_count($con, $receipt_no, '0');

	  if($count_pending != 0 ){echo 'Pending : '.$count_pending.'<br/>'; }
	  if($count_delivered != 0 ){echo 'Delivered : '.$count_delivered.'<br/>'; }
	  if($count_avail != 0 ){echo 'Available : '.$count_avail.'<br/>'; }
	  if($count_return != 0 ){echo 'Return : '.$count_return.'<br/>'; }
	  if($count_cancel != 0 ){echo 'Cancelled : '.$count_cancel.'<br/>'; }
	  if($count_total != 0 ){echo 'Total : '.$count_total.'<br/>'; }
	   ?>
       </button>
     </abbr>
      </form>
      </td>
      <td style="font-style:italic; color: #33C;"><?php echo  showStatus($con, $pr_status_id); ?></td>

   <?php $bal = $row['PP_bal'];
   		if($bal > 0 || $bal < 0)
			{ echo '<td style="color:#EE1217;">'.number_format($bal,'2','.','').'</td>';}
		else{ echo '<td style="color:#478C19;">'."0.00".'</td>';}?>

      <td class="no-print" title="View Receipt">
      <form action="patient_receipt.php" role="form" method="get" target="_blank" class="form_receipt">
      <input type="hidden" name="receipt_no" value="<?php echo $receipt_no;?>"/>
      <button type="submit" class="btn btn-small btn-primary"><i class="fa fa-print"></i></button>
      </form>
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
      <button type="submit" class="btn btn-small btn-primary"><i class="fa fa-plus"></i></button>
      </form>
      </td>
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>
<form id="formPatient_list" action="#">
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>

    <label style="display:none; ">Sl No</label><br/>
    <input type="text" name="sl_no" id="sl_no" style="display:none; " value="<?php echo $sl_no;?>" disabled rel="0" />
    <br/>
    <label style="display:none; " >Receipt No.</label><br/>
    <input type="text" name="receipt_no" style="display:none;" id="receipt_no" class="required" rel="1" />
    <br />

     <label style="display:none; ">Patient Name</label><br/>
    <input type="text" name="patient_name" id="patient_name" style="display:none; " rel="2" />
    <br />

     <label style="display:none; ">Sex_age</label><br/>
    <input type="text" name="patient_sex_age" id="patient_sex_age" style="display:none;" rel="3" />
    <br />

     <label style="display:none; ">Address</label><br/>
    <input type="text" name="patient_address" id="patient_address" style="display:none;" rel="4" />
    <br />

    <label style="display:none;">Date</label><br/>
    <input type="text" name="patient_date" id="patient_date" style="display:none;" rel="5" />
     <br />

    <label style="display:none;">tes_number</label><br/>
    <input type="text" name="tes_number" id="tes_number" style="display:none;" rel="6" />
    <br />
      <label style="display:none;">test_status</label><br/>
    <select name="test_status" id="test_status" style="display:none;" rel="7" >
      <option value="1">Pending</option>
      <option value="5">Delivered</option>
      <option value="6">Blocked</option>
    </select>
    <br />
    <label style="display:none; ">Balance</label><br/>
    <input type="text" name="balance_amt" id="balance_amt" style="display:none;" rel="8" />
    <br />
    <label style="display:none; ">Receipt Print</label><br/>
      <input style="display:none" name="print_receipt" rel="9"/>
     <br />
     <label style="display:none;">Edit</label>
      <input style="display:none" name="detail" rel="10"/>
       <br />
      <label style="display:none;">New</label>
      <input style="display:none" name="detail" rel="11"/>
       <br />
 </form>
<button id="btnDeleteRow" style="visibility:hidden; display:none">Delete</button>
<button id="btnAddNewRow" style="visibility:hidden; display:none">Add</button>

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

  $('.form_receipt').submit(function() {
    myWindow1 = window.open('', 'patient_receipt.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'patient_receipt.php';
    });

  $('.form_status').submit(function() {
    myWindow2 = window.open('', 'patient_investigation_status.php', "width=1300,height=500,resizeable,scrollbars");
    this.target = 'patient_investigation_status.php';
    });

  $('.form_trace').submit(function() {
    window.open('', 'trace_result_reg.php', "width=1300,height=500,resizeable,scrollbars");
    this.target = 'trace_result_reg.php';
    });

  $('.form_new').submit(function() {
    window.open('', 'patient_registration_card.php', "width=1300,height=500,resizeable,scrollbars");
    this.target = 'patient_registration_card.php';
    });

  $('#p_list_table').dataTable( {

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
		  $('.dataTables_length select').css('float', 'left');  }


     } ).makeEditable({

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
<?php ob_flush();?>