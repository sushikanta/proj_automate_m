<?php require_once("check_login_super.php");?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>15 days - Report</title>
  <?php require_once("css_bootstrap_header.php");?>
  <?php require_once("print-borderless-simple.php");?>
</head>

<body id="myBody">
<?php
if(isset($_GET['start']) && $_GET['start'] !='' && isset($_GET['stop']) && $_GET['stop'] !='' && isset($_GET['src']) && $_GET['src'] !='' && isset($_GET['ref']) && $_GET['ref'] !=''){
	$start = $_GET['start'];
	$stop = $_GET['stop'];
	$src = $_GET['src'];
	$ref = $_GET['ref'];

?>
<?php require_once("right_top_header_popup.php"); ?>

<div class="container">
 <div class="page-content">
   <div class="inv-main">

   <div class="panel panel-success">
   <div class="panel-heading light_purple_color">

    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Report <span class="panel_subTitle no-print">(<?php echo date("d/m/Y", strtotime($start)).' - '.date("d/m/Y", strtotime($stop)); ?>)</span>
<!------------ Print & SAve------------>
<button onclick="window.print()" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
<i class="fa fa-print fa-lg"></i> Print&nbsp;</button>

<button type="button" onClick ="tableToExcel('testTable', 'W3C Example Table')" class="no-print btn btn-mini btn-primary pull-right"  style="margin-top:-5px;">
<i class="fa fa-file-excel-o fa-fw"></i> Save
</button>

<span class="date_time pull-right light_purple_color" style="padding-right:10px;"> <i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
    </div>

<div class="panel-body">

<div class="width_100">
<table class="table-hover table-condensed width_100" id="testTable">
<thead align="left">

<tr>
    <th colspan="8" class="text-center" style="color:#C9002F; font-size:10pt;"><?php if($src =='1'){echo 'Dr. '.showDoctor_name($con, $ref); } if($src >'3'){echo showReferral($con, $src, $ref);} ?><br/>
  ( <?php echo date("jS F", strtotime($start)).' - '.date("jS F, Y", strtotime($stop)); ?> )</th>
    </tr>
<tr>
<tr class="blank"><th colspan="8" class="blank"></th></tr>

  <th class="width_2 text-center">SL</th>
  <th class="width_15">Patient Name</th>
  <th class="width_10">Date</th>
  <th class="blank">Excel Investigation</th>
  <th class="blank">Excel RATE</th>
  <th class="width_30 print_67">Investigation</th>
  <th class="blank text-right width_8">Rate</th>

  <th class="text-right width_8">
  <span class="pull-right">%</span>
  <input id="comm_per" class="pull-right text-right no-border width_80" name="comm_per" style="border:1px solid tranparent;" maxlength="3">
  </th>

 </tr>

</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT y.PP_net, y.PP_date, y.PP_receipt_no, patient_info.PI_name FROM patient_registration r LEFT JOIN patient_payment y ON r.pr_receipt_no = y.PP_receipt_no LEFT JOIN patient_info ON patient_info.PI_id = r.pr_patient_id WHERE r.pr_dr_prescription ='$ref' AND DATE_FORMAT(r.pr_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$stop."' AND y.PP_bal = 0 AND y.PP_disc ='2' ORDER BY r.pr_date ASC");
$sl_no=1;
$total_net=0;
while ($row = mysqli_fetch_array($result))
{
	$PI_name = $row['PI_name'];
	$PP_receipt_no = $row['PP_receipt_no'];
	$PP_net = $row['PP_net'];
	$PP_paid_date = $row['PP_date'];
  ?>
 	<tr>
	   <td class="readonly-bg text-center"> <?php echo $sl_no; ?></td>
	   <td><?php echo $PI_name; ?></td>
       <td><?php echo date("d/m/Y", strtotime($PP_paid_date)); ?></td>
       <td class="blank"><?php $all_test = allTest_ED($con, $PP_receipt_no); echo $all_test; ?></td>
       <td class="blank"> <?php echo $PP_net;?></td>
       <td>
       <textarea class="no-border width_100" style=" visibility: visible;"><?php echo allTest_ED($con, $PP_receipt_no); ?></textarea>
       </td>
       <td class="blank">
       <input class="width_100 pull-right text-right no-border rate blank" id="net<?php echo $sl_no;?>" value="<?php echo $PP_net; ?>" >
       </td>
       <td>
       <input class="comm pull-right text-right no-border width_100" id="comm<?php echo $sl_no;?>" value="<?php echo $PP_net;?>" readonly>
       </td>

     </tr>
<?php
$sl_no++;
$total_net = $total_net + $PP_net;
}
?>
<input type="hidden" id="count" value="<?php echo $sl_no;?>"/>
<tr>
    <td></td>
    <td></td>
    <td class="blank"></td>
    <td class="blank"></td>
    <td></td>
    <td style="text-align:right;">
    <span class="pull-right" style="font-weight:bolder;"> Total (Rs) :</span>
    </td>
   <td class="text-right blank">
   <input id="netSum" class="text-right pull-right" value="<?php echo $total_net;// sumNet_eachPerson($con, $ref, $start, $stop);?>" readonly>
   </td>
   <td>
    <input id="commSum" class="no-border text-right pull-right" value="<?php echo $total_net;?>" readonly>
   </td>
  </tr>
 </tbody>
 </table>
   </div>
</div>
<div class="clear"></div>
<?php require_once("footer.php"); ?>
<?php require_once("script_bootstrap_datatable.php");?>
<?php require_once("script_saveto_excel.php");?>
<script type="text/javascript">
$(document).ready(function() {
	var count = Number($('#count').val());
	var newCount =  new Number (count - 1);
	var i =1;

  $('#comm_per').bind('keyup keypress blur', function() {
  var sum_net=0;
  var sum_comm=0;
		for (i =1; i<count; i++)
		{
		var net = Number($('#net' + i).val());
		var comm_per = Number($('#comm_per').val());
		var amt = (comm_per/100) * net;
		$('#comm' + i).val(amt.toFixed(2));
    sum_net = sum_net + net;
    sum_comm = sum_comm + amt;
		}

		// var netSum = Number($('#netSum').val());
		// var comm_per = Number($('#comm_per').val());
		// var comAmt = (comm_per/100) * netSum;
		$('#netSum').val(sum_net.toFixed(2));
    $('#commSum').val(sum_comm.toFixed(2));
	});

//change on rate column
$('.rate').keyup(function(event) {
  var sum_net=0;
  var sum_comm=0;
    for (i =1; i<count; i++)
    {
    var net = Number($('#net' + i).val());
    var comm_per = Number($('#comm_per').val());
    var amt = (comm_per/100) * net;
    $('#comm' + i).val(amt.toFixed(2));
    sum_net = sum_net + net;
    sum_comm = sum_comm + amt;
    }

    // var netSum = Number($('#netSum').val());
    // var comm_per = Number($('#comm_per').val());
    // var comAmt = (comm_per/100) * netSum;
    $('#netSum').val(sum_net.toFixed(2));
    $('#commSum').val(sum_comm.toFixed(2));
});

 });


</script>
</body>
</html>
<?php } ob_flush();?>
