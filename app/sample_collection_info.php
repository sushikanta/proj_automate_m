<?php include("function.php");?>
<!DOCTYPE html>
<html>
<?php include("css_bootstrap_datatable_header.php"); ob_start();?> 
<body>
<?php include("right_top_header_admin.php"); ?>
<div class="container">
 <div class="page-content">

<div class="inv-main">	
  <div class="panel panel-info">  <!----------------------START Patient Information-------------->
	<div class="panel-heading">Patient Information</div>                                      
                               
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="p_list_table">
<thead align="left">
<tr>
<th> # </th>
<th> LAB ID</th>
<th> Patient Name</th>
<th> Sex/Age</th>
<th> Date/Time (Front Desk)</th>
<th> Address</th>
<th> Phone</th>
<th> Status</th>
<th> Back</th>
</tr>
</thead>
<tbody>
<?php
if(isset($_GET['receipt_no']))
{
$receipt_no = $_GET['receipt_no'];
	
	$result = mysqli_query($con, "SELECT `patient_registration`.`pr_receipt_no`, `patient_registration`.`pr_patient_name`, `patient_registration`.`pr_patient_age`, `patient_registration`.`pr_patient_gender`, `patient_registration`.`pr_patient_address`, `patient_registration`.`pr_patient_phone`, `patient_registration`.`pr_source_id`, `patient_registration`.`pr_referred_id`, `patient_registration`.`pr_date`, `patient_payment`.`PP_bal`, `patient_receipt_status`.`PRS_status_id`, `patient_receipt_status`.`PRS_date` FROM `patient_registration` LEFT JOIN `patient_payment` ON `patient_payment`.`PP_receipt_no` = `patient_registration`.`pr_receipt_no` LEFT JOIN  `patient_receipt_status` ON  `patient_receipt_status`.`PRS_receipt_no` = `patient_payment`.`PP_receipt_no` WHERE `patient_registration`.`pr_receipt_no` = '".$receipt_no."' ORDER BY  `patient_registration`.`pr_date` DESC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
?>
 <tr id="<?php echo $row['pr_receipt_no'] ; ?>">
    <td> <?php echo $sl_no; ?> </td>  
    <td><?php echo $row['pr_receipt_no']; ?> </td>  
	<td><?php echo $row['pr_patient_name']; ?> </td>
    <td><?php echo $row['pr_patient_gender']." / ".$row['pr_patient_age']; ?> </td>  
    <td><?php echo  date("d-M-Y (h:i A)", strtotime($row['pr_date'])); ?> </td>
     <td> <?php echo  $row['pr_patient_address']; ?> </td>
	 <td> <?php echo $row['pr_patient_phone']; ?> </td>  
	<td><?php echo  showStatus($con, $row['PRS_status_id']); ?> </td>  
    <td><a href="sample_collection_table.php" style=" text-decoration:none;">&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-circle-right icon-large icon-white"></i></a></td>
 </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table>
</div>


 <div class="panel panel-info">  <!----------------------START Investigation Information-------------->
	<div class="panel-heading">Investigation Details</div>
 <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="p_list_table">
<thead align="left">
<tr>
<th> # </th>
<th> LAB ID</th>
<th> Investigation</th>
<th> Category</th>
<th> Department</th>
<th> Date/Time(Front Desk)</th>
<th> Status</th>
<th> Last update</th>
<th> Back</th>
</tr>
</thead>
<tbody>
    
<?php

    $result = mysqli_query($con, "SELECT `patient_registration`.`pr_receipt_no`, `patient_registration`.`pr_patient_name`, `patient_registration`.`pr_patient_age`, `patient_registration`.`pr_patient_gender`, `patient_registration`.`pr_patient_address`, `patient_registration`.`pr_patient_phone`, `patient_registration`.`pr_source_id`, `patient_registration`.`pr_referred_id`, `patient_registration`.`pr_date`, `patient_payment`.`PP_bal`, `patient_receipt_status`.`PRS_status_id`, `patient_receipt_status`.`PRS_date` FROM `patient_registration` LEFT JOIN `patient_payment` ON `patient_payment`.`PP_receipt_no` = `patient_registration`.`pr_receipt_no` LEFT JOIN  `patient_receipt_status` ON  `patient_receipt_status`.`PRS_receipt_no` = `patient_payment`.`PP_receipt_no` WHERE `patient_registration`.`pr_receipt_no` = '".$receipt_no."' ORDER BY  `patient_registration`.`pr_date` DESC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
?>
 <tr id="<?php echo $row['pr_receipt_no'] ; ?>">
    <td> <?php echo $sl_no; ?> </td>  
    <td><?php echo $row['pr_receipt_no']; ?> </td>  
	<td><?php echo $row['pr_patient_name']; ?> </td>
    <td><?php echo $row['pr_patient_gender']." / ".$row['pr_patient_age']; ?> </td>  
     <td> <?php echo $row['pr_patient_address']; ?> </td>
     <td><?php echo date("d-M-Y (h:i A)", strtotime($row['pr_date']));?></td>
     <td><?php echo  showStatus($con, $row['PRS_status_id']); ?> </td>  
	 <td> <?php echo $row['pr_patient_phone']; ?> </td>  
	
    <td><a href="sample_collection_table.php" style=" text-decoration:none;">&nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-circle-right icon-large icon-white"></i></a></td>
 </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table>
    
  </div>
    
    
 
 <div class="panel panel-info">  <!----------------------START Employee Information-------------->
	<div class="panel-heading">Sample Collection - Add info</div>
    <div>

 </div>
 
 
 <?php
}
?>
 Counter : &nbsp;</div>
<div id="counterHour" style="float: left;">
0</div>
<div style="float: left;">
&nbsp; Hours &nbsp;</div>
<div id="counterMin" style="float: left;">
0</div>
<div style="float: left;">
&nbsp; minutes &nbsp;</div>
<div id="counterSec" style="float: left;">
0</div>
<div style="float: left;">
&nbsp; seconds &nbsp;</div>
<input type="button" id="timer" class="start" value="Start Timer" onclick="check_timer()">
    
    </div>
 
<div class="clear"></div>
</div>

<?php include("footer.php"); ob_flush();?> 
<?php include("script_bootstrap_datatable.php"); ?>     
<script charset="utf-8" type="text/javascript">

function check_timer(){
 if($('#timer').hasClass('start')){
  $('#counterSec').fadeOut(0).html(0).fadeIn(0);
  $('#counterMin').fadeOut(0).html(0).fadeIn(0);
  $('#counterHour').fadeOut(0).html(0).fadeIn(0);
  $('#timer').val("Stop Timer");
  timer = setInterval ( "increaseCounter()", 1000 );
  $('#timer').removeClass('start')
 }
 else{
  if(typeof timer != "undefined"){
   clearInterval(timer);  
  }
  $('#timer').val("Start Timer");
  $('#timer').addClass('start')
 }
}
 
function increaseCounter(){
 
 var secVal ;
 var minVal ;
 secVal = parseInt($('#counterSec').html(),10) 
 minVal = parseInt($('#counterMin').html(),10)
 if(secVal != 59)
 $('#counterSec').html((secVal+1));
 else{
  if(minVal != 59){
   $('#counterMin').html((minVal+1)); 
  }
  else{
   $('#counterHour').html((parseInt($('#counterHour').html(),10)+1));
   $('#counterMin').html(0);
  }
  $('#counterSec').html(0);
 }
} 
	
    
</script>

</body>
</html>