<?php require_once("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '3')
 {

?>
<!DOCTYPE html>
<html>
<head>
      <title>FD - Registration List</title>
	  <?php require_once("css_bootstrap_datatable_header.php"); ?> 
</head>
<body>
<?php require_once("right_top_header.php"); ?>
<div class="container">
 <div class="page-content">

<div class="inv-main">	
  <div class="panel panel-success">  <!----------------------START Patient list-------------->
	<div class="panel-heading" style="color:#0D9707;">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> Registration List - <span style="color:#000000; font-style:italic">( Pending )</span>
     	<span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
        
        
     <div class="error pull-right" id="trace" style="display:none; margin-right:34%; color:red; font-size:14px;">
      <img width="21" height="21" alt="Warning!" src="images/warning.gif">
      <span id="submit-error"></span><br clear="all">
    </div>
  
     </h3>
    </div>                                      
                               
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover display" id="p_list_table">
<thead align="left">
  <tr>
      <th style="width:1%;"> # </th>
      <th style="width:5%;"> Reg No.</th>
      <th> Name </th>
      <th style="width:6%;"><i class="fa fa-male"></i><i class="fa fa-female"></i> </th>
      <th> <i class="fa fa-home"></i> Address </th>
      <th style="width:11%;"> <i class="fa fa-phone"></i> Phone </th>
      <th style="width:14%;"> <i class="fa fa-calendar"></i> Registered on </th>      
      <th style="width:4%;"> <abbr title="Completed / Total"> <i class="fa fa-spinner fa-spin fa-lg"></i></abbr></th>
      <th> Status </th>
      <th> Due </th>
      <th style="width:0.5%;"> <i class="fa fa-ticket fa-lg"></i> </th>
      <th style="width:0.22%;"> <i class="fa fa-edit fa-lg"></i> </th>
  </tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT patient_registration.*, patient_info.*, patient_payment.* FROM patient_registration LEFT JOIN patient_payment ON patient_payment.PP_receipt_no = patient_registration.pr_receipt_no LEFT JOIN patient_info ON patient_info.PI_id =  patient_registration.pr_patient_id WHERE patient_registration.pr_status_id ='1' ORDER BY patient_registration.pr_date DESC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
?>
 <tr id="<?php echo $row['pr_receipt_no'] ; ?>">
      <td class="readonly-bg"> <?php echo $sl_no; ?> </td>  
      <td style="color:#00F; cursor:not-allowed;"><?php echo $row['pr_receipt_no']; ?> </td>  
      <td class="readonly-bg"><?php echo $row['PI_name']; ?> </td>
      <td style="cursor:not-allowed;"><?php $age_ext = showAge_ext_short($con, $row['PI_age_ext']); if($row['PI_gender_id'] =='1'){ echo "M/".$row['PI_age'].' '.$age_ext;} elseif($row['PI_gender_id'] =='2'){ echo "F/".$row['PI_age'].' '.$age_ext;} ?></td>  
      <td class="readonly-bg"><?php echo $row['PI_address']; ?> </td>
      <td class="readonly-bg"><?php echo "+91 ".$row['PI_phone']; ?> </td>
      <td class="readonly-bg"><?php echo  date("d/m/Y, h:i a", strtotime($row['pr_date'])); ?> </td>      
      <td>
	  <abbr title="Click to update Status">
      <a href="patient_investigation_status.php?receipt_no=<?php echo $row['pr_receipt_no'];?>&msg=list">
	  <?php echo showCompleted_test($con, $row['pr_receipt_no']).'/'.showTotal_test($con, $row['pr_receipt_no']); ?></a>
      </abbr> </td>
      <td style="font-style:italic; color: #33C;"><?php echo  showStatus($con, $row['pr_status_id']); ?></td>  
   
   <?php $bal = $row['PP_bal']; 
   		if($bal > 0 || $bal < 0)
			{ echo '<td style="color:#EE1217;">'.number_format($bal,'2','.','').'</td>';}
		else{ echo '<td style="color:#478C19;">'."0.00".'</td>';}?> 
     
      <td>
      <abbr title="Click to view Receipt">
      <a class="navbar-link" href="patient_receipt.php?receipt_no=<?php echo $row['pr_receipt_no'];?>&msg=direct"><i class="fa fa-print"></i></a></abbr>
      </td>
      <td>
      <abbr title="Click to Edit - View registration detail">
      <a href="patient_registration_view.php?receipt_no=<?php echo $row['pr_receipt_no'];?>&msg=list"><i class="fa fa-stack-exchange"></i></a>
      </abbr>
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
    
    <label style="display:none; ">Phone</label><br/>
    <input type="text" name="patient_phone" id="patient_phone" style="display:none;" rel="5" />
    <br />  
    
    <label style="display:none;">Date</label><br/>
    <input type="text" name="patient_date" id="patient_date" style="display:none;" rel="6" />
     <br />      
       
    <label style="display:none;">tes_number</label><br/>
    <input type="text" name="tes_number" id="tes_number" style="display:none;" rel="7" />    
    <br />  
      <label style="display:none;">test_status</label><br/>
    <select name="test_status" id="test_status" style="display:none;" rel="8" >
      <option value="1">Pending</option>
      <option value="5">Delivered</option>
      <option value="6">Blocked</option>
    </select>
    <br />  
    <label style="display:none; ">Balance</label><br/>
    <input type="text" name="balance_amt" id="balance_amt" style="display:none;" rel="9" />
    <br />  
    <label style="display:none; ">Receipt Print</label><br/>
      <input style="display:none" name="print_receipt" rel="10"/>
     <br />  
     <label style="display:none;">Detail</label>
      <input style="display:none" name="detail" rel="11"/> 
 </form> 
<button id="btnDeleteRow" style="visibility:hidden; display:none">Delete</button>  
<button id="btnAddNewRow" style="visibility:hidden; display:none">Add</button>

<div class="clear"></div>
</div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>     
<script src="js/patient_table.js" charset="utf-8" type="text/javascript"></script>
</body>
</html>
<?php } ob_flush();?>