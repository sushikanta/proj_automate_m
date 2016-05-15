<?php require_once("function.php");
session_start();
ob_start();

if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '1')
 {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>FD - A/C Statement b/w dates</title>
  <?php require_once("css_bootstrap_header.php");?> 
  <?php require_once("print-borderless-ac.php");?> 
  
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
	<div class="panel-heading no-print" style="color:#0D9707;">
    <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> Report - b/w dates Account Statement
   <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span><a class="text-right pull-right navbar-link no-print" href="SAD_report_ac_statement_ui.php" style="padding-left:30px;"><i class="fa fa-arrow-circle-right fa-lg"></i></a></span>
     <button onclick="printDiv('printableArea')" class="text-right pull-right no-print btn btn-small btn-primary" style="margin-right:15px; margin-top:-5px; width:55px;">Print</button> 
     
     <!--<button onclick="tableToExcel('testTable', 'W3C Example Table')" class="text-right pull-right no-print btn btn-small btn-primary" style="margin-right:5px; margin-top:-5px; width:55px;">Excel</button> -->
     
     <button id="btn" class="text-right pull-right no-print btn btn-small btn-primary" style="margin-right:5px; margin-top:-5px; width:55px;">Excel</button> 
     
     </h3>
    </div>      
     
<div class="panel-body"  id="printableArea">

<div id="dvData">


<div>
<label style="width:100%; text-align:center; font-size:12pt; font-weight:normal; color:#00F;"><span style="text-decoration: underline;">Account Statement ( <?php echo date("d/m/Y, h:i a", strtotime($start));?> - <?php echo date("d/m/Y, h:i a", strtotime($stop));?> )</span> </br> <span style="font-size:12px !important; font-style:italic;">Generated on <?php echo date("l, F jS Y, h:i a", time());?> by : <?php echo $_SESSION['name'];?></span></label>   

<table class="table table-striped table-bordered" style="width:100%;">
    <thead>
    <tr>
    <th colspan="13" class="text-center" style="color:#C9002F; font-size:9pt;">TOTALS</th>
    </tr>
	<tr>
        <th style="text-align:center;">RegID</th>
        <th style="text-align:center;">Invst</th>		
		<th style="text-align:center;">Bill</th>        
        <th style="text-align:center;">Tax</th>
        <th style="text-align:center;">Disc</th>
        <th style="text-align:center;">Net</th>
        <th style="text-align:center;">Due</th>
        <th style="text-align:center;">Cur. Recvd</th>
        <th style="text-align:center;">CurDue Clear</th>
        <th style="text-align:center;">Received</th>
        <th style="text-align:center;">OldDue Clear</th>        
        <th style="text-align:center;">Expd</th>
        <th style="text-align:center;">Deposit</th>
	</tr>
	</thead>
	<tbody>
  		<tr>
        
        <td style="text-align:center;"><?php echo total_registration_bw($con, $start, $stop);?></td>
        
        <td style="text-align:center;"><?php echo total_investigation_bw($con, $start, $stop);?></td>		
		
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php $totalBill_registration_bw = totalBill_registration_bw($con, $start, $stop); echo number_format($totalBill_registration_bw, 2, '.', ',');?>
        </td>
        
        </td>
        
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php $totalTax_registration_bw = totalTax_registration_bw($con, $start, $stop); echo number_format($totalTax_registration_bw, 2, '.', ','); ?>
        </td>
        
        <td style="text-align:center;"><i class="fa fa-inr"></i> 
		<?php $totalDiscount_registration_bw = totalDiscount_registration_bw($con, $start, $stop); echo number_format($totalDiscount_registration_bw, 2, '.', ',');?></td>
       		  
		<td style="text-align:center;"><i class="fa fa-inr"></i> 
		  <?php $totalNet_registration_bw = totalNet_registration_bw($con, $start, $stop); $curClear_bw = curClear_bw($con, $start, $stop); $received = totalReceived_registration_bw($con, $start, $stop); echo number_format($totalNet_registration_bw, 2, '.', ',');?>
        </td>
        
        <td style="text-align:center; color:#F00;"><i class="fa fa-inr"></i> 
		  <?php $final_due = $totalNet_registration_bw - ($curClear_bw + $received); echo number_format($final_due, 2, '.', ',');?>
        </td>
         		  
         <td style="text-align:center; color: #393;"><i class="fa fa-inr"></i>  
		  <?php $received = totalReceived_registration_bw($con, $start, $stop); echo number_format($received, '2','.',','); ?>
        </td>
        
        <td style="text-align:center; color: #393;"><i class="fa fa-inr"></i> 
		  <?php echo number_format($curClear_bw, '2','.',','); ?>
        </td>
        
        <td style="text-align:center; color: #00F;"><i class="fa fa-inr"></i>  
		  <?php $acutual_received = $received + $curClear_bw; echo number_format($acutual_received, '2','.',','); ?>
        </td>
        
         <td style="text-align:center; color: #00F;"><i class="fa fa-inr"></i>  
		  <?php $totalDues_paid_bw = totalDues_paid_bw($con, $start, $stop); $pastClear_bw = $totalDues_paid_bw - $curClear_bw; echo number_format($pastClear_bw, '2','.',','); 
		  
		  ?>
        </td>
       
        <td style="text-align:center; color: #D43F00;"><i class="fa fa-inr"></i>
		  <?php $totalExpenditure_amount_bw = totalExpenditure_amount_bw($con, $start, $stop); echo number_format($totalExpenditure_amount_bw,'2','.',',');?></td>
        <td style="text-align:center; color: #00F; font-weight:bold;"><i class="fa fa-inr"></i>
		  <?php echo number_format((($acutual_received + $pastClear_bw) - $totalExpenditure_amount_bw),'2','.',',');?>
        </td>
		</tr>     
       </tbody>   
	</table>
    </div>
   
<div style=" margin-top:30px;">
<table class="table table-striped table-bordered" style="width:100%; margin-top:30px;" id="testTable">
<thead align="left">

	 <tr>
    <th colspan="13" class="text-center" style="color:#C9002F; font-size:9pt;">REGISTRATION</th>
    </tr>

<tr>
  <th class="text-center">SL</th>
  <th>Reg ID</th>
  <th>Name</th>
  <th>Referred by</th>
  <th>Investigation</th>
  <th class="text-left" style="width:9%;">Date</th>
  <th class="text-right">Bill</th>  
  <th class="text-right">Tax</th>
  <th class="text-right">Disc</th>
  <th class="text-right">Net</th>
  <th class="text-right">Due</th>
  <th class="text-right">Clear</th>
  <th class="text-right">Cur.Recvd</th>
</tr>
</thead>
<tbody>
<?php
$result2 = mysqli_query($con, "SELECT patient_payment.*, patient_info.PI_name, patient_registration.pr_dr_prescription, patient_registration.pr_source_id, patient_registration.pr_referred_id FROM patient_payment LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no LEFT JOIN patient_info ON patient_info.PI_id = patient_payment.PP_patient_id WHERE patient_payment.PP_paid_date BETWEEN '".$start."' AND '".$stop."'");
$sl_no=1;
while ($row = mysqli_fetch_array($result2))
{
	$PP_sl = $row['PP_sl'];
	$PP_receipt_no = $row['PP_receipt_no'];
	$PP_patient_id = $row['PP_patient_id'];
	$PP_total = $row['PP_total'];
	$PP_tax = $row['PP_tax'];
	$PP_tax_value = $row['PP_tax_value'];
	$pr_source_id = $row['pr_source_id'];
	$pr_referred_id = $row['pr_referred_id'];
	$PP_tax_value = $row['PP_tax_value'];
	$PP_disc_option = $row['PP_disc_option'];
	$PP_net = $row['PP_net'];
	$PP_paid = $row['PP_paid'];
	$PP_paid_date = $row['PP_paid_date'];
	$PP_bal = $row['PP_bal'];
  ?>
 	<tr>
	   <td class="readonly-bg text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $PP_receipt_no; ?></td> 
       <td><?php echo $row['PI_name']; ?></td> 
       <td><?php if($row['pr_dr_prescription'] =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $row['pr_dr_prescription']);} ?> ( <?php echo "<span style='font-style: italic;'>" .showReferral($con, $pr_source_id, $pr_referred_id). " - ".showSourceName($con, $pr_source_id)."</span> )"; ?> </td>
       <td><?php showTest_PID($con, $PP_receipt_no); ?></td>
       <td><?php echo date("d/m/Y h:i a", strtotime($PP_paid_date)); ?></td>
       <td class="text-right"><?php echo number_format($PP_total, 2, '.', ','); ?></td>
       
      <td class="text-right"><?php if($PP_tax =='1'){$tax = ($PP_tax_value/100) * $PP_total; echo number_format($tax, 2, '.', ',');} if($PP_tax =='2'){echo '0.00';}  ?></td>
       <td class="text-right"><?php if($PP_disc_option == '1'){echo calcDiscount_EID($con, $PP_receipt_no);}else {echo '0.00';} ?></td>
       <td class="text-right"><?php echo number_format($PP_net, 2, '.', ','); ?></td>
       <td class="text-right"><?php $dueClear_btw = dueClear_btw_pp_sl($con, $PP_sl, $start, $stop); $due_btw = $PP_net - ($PP_paid + $dueClear_btw); echo number_format($due_btw, 2, '.', ','); ?></td>
       <td class="text-right"><?php  if($dueClear_btw ==''){ echo '0.00';}else{echo number_format($dueClear_btw, 2, '.', ',');} ?></td>
       
	   <td class="text-right"><?php echo number_format($PP_paid, 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="6" style="text-align:right;">
    <span class="pull-right" style="font-weight:bolder;"> Total (Rs) :</span>
    </td>
   <td style="text-align:right;" class="text-right"><?php echo number_format($totalBill_registration_bw,'2','.',',');?> </td>     
   <td style="text-align:right;" class="text-right"><?php echo number_format($totalTax_registration_bw,'2','.',',');?> </td>
   <td style="text-align:right;" class="text-right"><?php echo number_format($totalDiscount_registration_bw,'2','.',',');?> </td>
   <td style="text-align:right;" class="text-right"><?php echo number_format($totalNet_registration_bw,'2','.',',');?> </td>
   <td style="text-align:right;" class="text-right"><?php $due_total = $totalNet_registration_bw - ($curClear_bw + $received); echo number_format($due_total,'2','.',',');?> </td>
   <td style="text-align:right;" class="text-right"><?php echo number_format($curClear_bw, '2','.',',');?> </td>
   <td style="text-align:right; color:#00F;" class="text-right"><?php if($received ==""){ echo "0.00";}else{echo number_format($received,'2','.',','); } ?> </td>
  </tr>
 <tbody>
 </table>
   </div>
   
   
   <!----------------------------------Due clear collection --------------------------------------------->

<?php
$result3 = mysqli_query($con, "SELECT patient_due_tbl.PD_bal_paid, patient_due_tbl.PD_date, patient_payment.PP_receipt_no, patient_registration.pr_source_id, patient_registration.pr_referred_id, patient_registration.pr_dr_prescription, patient_info.PI_name FROM patient_due_tbl LEFT JOIN patient_payment ON patient_due_tbl.PD_pp_sl = patient_payment.PP_sl LEFT JOIN patient_registration ON patient_registration.pr_receipt_no = patient_payment.PP_receipt_no LEFT JOIN patient_info ON patient_info.PI_id = patient_registration.pr_patient_id WHERE patient_due_tbl.PD_bal_paid !='0' AND patient_due_tbl.PD_date BETWEEN '".$start."' AND '".$stop."' AND patient_payment.PP_paid_date NOT BETWEEN '".$start."' AND '".$stop."' ORDER BY patient_registration.pr_dr_prescription ASC");

if(mysqli_num_rows($result3) !=0)
 {
?>

<div style="margin-top:30px;">
<table class="table table-striped table-bordered" style="width:100%; margin-top:30px;"  id="testTable1">
<thead align="left">

	 <tr>
    <th colspan="7" class="text-center" style="color:#C9002F; font-size:9pt;">BALANCE DUE CLEARANCE</th>
    </tr>
<tr>
  <th class="text-center"> SL</th>
  <th>Reg ID</th>
  <th>Name</th>
  <th>Referred by</th>
  <th >Investigation</th>
  <th style="width:13%;">Clear on</th>
   <th class="text-right" style="width:13%;">Clear Amount</th>
</tr>
</thead>
<tbody>
<?php

$sl_no=1;
while ($row3 = mysqli_fetch_array($result3))
{
	$PD_bal_paid = $row3['PD_bal_paid'];	
	$PD_date = date("d/m/Y, h:i a", strtotime($row3['PD_date']));
	$PP_receipt_no = $row3['PP_receipt_no'];
	$pr_source_id = $row3['pr_source_id'];
	$pr_referred_id = $row3['pr_referred_id'];
	$PI_name = $row3['PI_name'];
	
  ?>
 	<tr>
	   <td class="text-center"><?php echo $sl_no; ?></td>
	   <td><?php echo $PP_receipt_no; ?></td> 
       <td><?php echo $PI_name; ?></td> 
      
       <td><?php if($row3['pr_dr_prescription'] =='NO'){echo "Self";}else{echo 'Dr. '.showDoctor_name($con, $row3['pr_dr_prescription']);} ?> ( <?php echo "<span style='font-style: italic;'>" .showReferral($con, $pr_source_id, $pr_referred_id). " - ".showSourceName($con, $pr_source_id)."</span> )"; ?> </td>

        
       <td><?php showTest_PID($con, $PP_receipt_no); ?></td> 
        <td><?php echo $PD_date; ?></td>     
       <td class="text-right"><?php echo number_format($PD_bal_paid, 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="6" class="price-amount" style="text-align:right;">
    <span class="pull-right" style="font-weight:bolder;"> Total Rs :</span>
    </td>
     
    <td style="text-align:right; color:#00F;" class="text-right"><i class="fa fa-inr"></i> <?php echo number_format($pastClear_bw,'2','.',','); ?> </td>
  </tr>
 </tbody>
 </table>
   </div>
  
<?php 
}
?> 
  
   
 <!------------------------------- Expenditure Table ------------------------------------------->
   
<?php
$result1 = mysqli_query($con, "SELECT * FROM expenditure WHERE EX_date BETWEEN '".$start."' AND '".$stop."' ORDER BY EX_date ASC");

if(mysqli_num_rows($result1) !=0)
 {
?>


<div style="margin-top:30px;">   
<table class="table table-striped table-bordered font-table" style="width:100%; margin-top:8px;">
<thead align="left">

  <tr>
    <th colspan="6" class="text-center" style="color:#C9002F; font-size:9pt;">EXPENDITURE</th>
    </tr>
    
<tr>
  <th class="text-center"> Sl.no.</th>
  <th >Voucher no. </th>
  <th>Particulars</th>
  <th >Receiver</th>
  <th class="text-center">Date</th>
  <th class="text-right"> Amount</th>
</tr>
</thead>
<tbody>
<?php

$sl_no=1;
while ($row1 = mysqli_fetch_array($result1))
{
	$EX_id = $row1['EX_id'];
	$EX_voucher = $row1['EX_voucher'];
	$EX_particular = $row1['EX_particular'];
	$EX_person = $row1['EX_person'];
	$EX_date = $row1['EX_date'];
	$EX_amount = $row1['EX_amount'];
  ?>
 	<tr>
	   <td class="text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row1['EX_voucher']; ?></td> 
       <td><?php echo $row1['EX_particular']; ?></td> 
       <td><?php echo $row1['EX_person']; ?></td>
       <td class="text-center"><?php echo date("d/m/Y, h:i a", strtotime($EX_date)); ?></td>  
	   <td class="text-right"><?php echo number_format($row1['EX_amount'], 2, '.', ',');?></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
<tr>            
    <td colspan="5" class="price-amount" style="text-align:right;">
    <span style="font-style:italic;" class="pull-left">Generated on <?php echo date("l, F jS Y, h:i a", time());?> by : <?php echo $_SESSION['name'];?></span>
    <span class="pull-right" style="font-weight:bolder;"> Total (Rs) :</span>
    </td>
    <td style="text-align:right; color:#00F;" class="text-right"><i class="fa fa-inr"></i> 
	<?php if ($totalExpenditure_amount_bw == ""){echo '0.00';} else{echo number_format($totalExpenditure_amount_bw, '2','.',',');}?>
    </td>
  </tr>
</tbody>
	</table>
   </div>
<?php 
}
?> 

  </div>
</div>
</div>
<div class="clear"></div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?> 
<script src="js/dataTables.tableTools.js"></script>   
<script type="text/javascript">
function printDiv(divID) {
	
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = "<html><head><title></title></head><body>" + divElements + "</body></html>";
			document.getElementById("myBody").style.margin="-10mm 0mm 0mm 0mm"
			//document.getElementById("myBody").style.padding="0"
			//document.getElementById("myBody").style.boxShadow="none"
			document.getElementById("myBody").style.fontSize="8pt"
			document.getElementById("myBody").style.fontWeight="normal"
			//document.getElementById("example").style.border ="1px solid #000";
			
			
			//document.body.className += 'test'
			
		
           // Print Page
            window.print();
			document.getElementById("myBody").style.marginTop="0px";
			document.getElementById("myBody").style.fontSize="14px";

            //Restore orignal HTML
            document.body.innerHTML = oldPage;
}

/*var tableToExcel = (function() {
  var uri = 'data:application/vnd.ms-excel;base64,', template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
  return function(table, name) {
    if (!table.nodeType) table = document.getElementById(table)
    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
    window.location.href = uri + base64(format(template, ctx))
  }
})()*/


(function () {
    var cache = {};

    this.tmpl = function tmpl(str, data) {
        // Figure out if we're getting a template, or if we need to
        // load the template - and be sure to cache the result.
        var fn = !/\W/.test(str) ? cache[str] = cache[str] || tmpl(document.getElementById(str).innerHTML) :

        // Generate a reusable function that will serve as a template
        // generator (and which will be cached).
        new Function("obj",
            "var p=[],print=function(){p.push.apply(p,arguments);};" +

        // Introduce the data as local variables using with(){}
        "with(obj){p.push('" +

        // Convert the template into pure JavaScript
        str.replace(/[\r\t\n]/g, " ")
            .split("{{").join("\t")
            .replace(/((^|}})[^\t]*)'/g, "$1\r")
            .replace(/\t=(.*?)}}/g, "',$1,'")
            .split("\t").join("');")
            .split("}}").join("p.push('")
            .split("\r").join("\\'") + "');}return p.join('');");

        // Provide some basic currying to the user
        return data ? fn(data) : fn;
    };
})();

var tableToExcel = (function () {
    var uri = 'data:application/vnd.ms-excel;base64,',
        template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{{=worksheet}}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body>{{for(var i=0; i<tables.length;i++){ }}<table>{{=tables[i]}}</table>{{ } }}</body></html>',
        base64 = function (s) {
            return window.btoa(unescape(encodeURIComponent(s)))
        },
        format = function (s, c) {
            return s.replace(/{(\w+)}/g, function (m, p) {
                return c[p];
            })
        }
    return function (tableList, name) {
        if (!tableList.length > 0 && !tableList[0].nodeType) table = document.getElementById(table)
        var tables = [];
        for (var i = 0; i < tableList.length; i++) {
            tables.push(tableList[i].innerHTML);
        }
        var ctx = {
            worksheet: name || 'Worksheet',
            tables: tables
        };
        window.location.href = uri + base64(tmpl(template, ctx))
    }
})();

function download(){
    tableToExcel(document.getElementsByTagName("table"), "one");
}
var btn = document.getElementById("btn");
btn.addEventListener("click",download);


</script>
</body>
</html>
<?php  } } ob_flush();?>