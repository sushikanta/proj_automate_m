<?php include("function.php");
session_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '4')
 {
?>
<!DOCTYPE html>
<html>
<?php include("css_bootstrap_datatable_header.php"); ob_start();?> 
<body>
<?php include("right_top_header_collection.php");?>
<div class="container">
 <div class="page-content">               
 <div class="inv-main">
<?php 
$table_receipt_no = $_GET['table_receipt_no'];

if(isset($table_receipt_no))
{   
   	$result = mysqli_query($con, "SELECT `patient_registration`.`pr_date`, `patient_registration`.`pr_dr_prescription`, `patient_info`.* FROM `patient_registration` LEFT JOIN `patient_info` ON `patient_info`.`PI_id` = `patient_registration`.`pr_patient_id` WHERE `patient_registration`.`pr_receipt_no` = '".$table_receipt_no."'");
	$sl_no=1;
	while ($row = mysqli_fetch_array($result))
	{
		$pr_receipt_no = $table_receipt_no;
		$pr_dr_letter = $row['pr_dr_prescription'];
		$pr_date = $row['pr_date'];
		$pr_patient_name = $row['PI_name'];
		$pr_patient_address = $row['PI_address'];
		$pr_patient_age = $row['PI_age'];
		$pr_patient_gender = $row['PI_gender_id'];
	}
	?>	
	 <div class="panel panel-success"> <!-----------------START Doctor Information--------------->
		 <div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-user"></i>&nbsp;&nbsp;Patient Investigation Details
            <a class="text-right pull-right navbar-link" href="sample_collection_table.php"><i class="fa fa-arrow-circle-right fa-lg"></i></a>
        <span class="pull-right"> 
        <span id="counterHour" class="text-right">00</span>
        <span class="text-right">:H&nbsp;</span>
        <span id="counterMin" class="text-right">00</span>
        <span class="text-right">:M&nbsp;</span>
        <span id="counterSec" class="text-right">00</span>
       <span class="text-right">:S&nbsp;</span>&nbsp;&nbsp;
        <input type="button" id="timer" class="start btn btn-mini btn-success" value="Start Timer" onclick="check_timer()">&nbsp;&nbsp;&nbsp;&nbsp;
       </span>
            </h3>
		 </div>
<div class="panel-body">         
		<div class="control-group">
			  <label class="col-lg-1-4 control-label text-right">Reg ID :</label>
			  <div class="col-lg-1-5">
				<span class="input-xlarge uneditable-input text-control" style="font-weight:100; color:#00F;"><?php echo $pr_receipt_no;?></span>
			  </div>
			  <label for="inputName" class="col-lg-1-2 control-label text-right"> Name :</label>
			  <div class="col-lg-3">
				<span class="input-xlarge uneditable-input text-control"><?php echo $pr_patient_name;?></span>
			  </div>
			   <label for="pr_patient_gender" class="col-lg-1-1 control-label text-right"><i class="fa fa-male"></i><i class="fa fa-female"></i> :</label>
			  <div class="col-lg-1-5">
				<span class="input-xlarge uneditable-input text-control"><?php if($pr_patient_gender ==1){echo "Male, ".$pr_patient_age." years";}elseif($pr_patient_gender ==2){echo "Female, ".$pr_patient_age." years";}else{echo "";}?></span>
			  </div> 
              <label for="pr_patient_address" class="col-lg-1-3 control-label text-right">Address :</label>
			  <div class="col-lg-3">					      
				<span class="input-xlarge uneditable-input text-control"><?php echo $pr_patient_address;?></span>
			  </div>
              <div class="clear"></div>
		</div>
		
		<div class="control-group">
        <label for="dr_letter" class="col-lg-1-4 control-label text-right">Dr.Letter :</label>
			  <div class="col-lg-1-5">					      
				<span class="input-xlarge uneditable-input text-control"><?php if ($pr_dr_letter ==1){echo "Yes";}elseif ($pr_dr_letter ==2){echo "No";}else{echo "";}?></span>
			  </div> 
			   <label for="dr_letter" class="col-lg-1-2 control-label text-right"><i class="fa fa-calendar"></i> :</label>
			  <div class="col-lg-2">					      
				<span class="input-xlarge uneditable-input text-control"><?php echo date("d-M-Y, h:i a", strtotime($pr_date));?></span>
			  </div> 
			  
             
		</div>
		
	<div class="clear"></div>
	</div> 
    
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="sample_test">
        <thead align="left">
        <tr>
          <th> # </th>
          
          <th> Investigation</th>          
          <th style="width:15%;"> <i class="fa fa-calendar"></i> Last update on</th>          
          <th> Status</th>
        </tr>
       </thead>     
  <tbody>
<?php
$result_test = mysqli_query($con, "SELECT `PT_sl`, `PT_receipt_no`, `PT_test_id`, `PT_test_name`, `PT_status_date1`, `PT_status_date2`, `PT_status_id` FROM `patient_test` WHERE `PT_receipt_no` = '$table_receipt_no' AND `PT_status_id` = '1' OR `PT_status_id` = '9'");
$sl_no=1;
while ($test = mysqli_fetch_array($result_test))
{
?>
 <tr id="<?php echo $test['PT_sl'];?>">
      <td class="readonly-bg"><?php echo $sl_no; ?></td>  
      <!--<td style="display:none;"><?php echo $table_receipt_no; ?></td>  -->
      <td class="readonly-bg"><?php echo $test['PT_test_name']; ?></td>
      <td class="readonly-bg"><?php echo date("m-M-Y, h:i a", strtotime($test['PT_status_date2'])); ?></td>
      <td><?php echo showStatus($con, $test['PT_status_id']); ?></td>
 </tr>
 <?php
	$sl_no++;
}
?>
</tbody>
</table>   

<form id="formSample_collection" action="#">  
    <label id="lblAddError" style="display:none" class="error"></label>
    <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
      
    <label style="display:none;">#</label>
    
    <label style="display:none;">PT_test_name</label>
    <label style="display:none;">PT_status_date2</label>
    <label style="display:none;">PT_status_id</label>
    
    </br>    
   
    <input style="display:none;" type="text" name="sl_no" value="<?php echo $sl_no;?>" disabled rel="0" /> 
   <!-- <input style="display:none;" type="text" name="receipt_no" rel="1" /> -->
    <input style="display:none;" type="text" name="PT_test_name" rel="1" /> 
    <input style="display:none;" type="text" name="PT_status_date2" rel="2" /> 
    <input style="display:none;" type="text" name="PT_status_id" rel="3" /> 
    <br/>               
 </form>  
<div class="add_delete_toolbar" style="display:none;"></div>  
<div class="clear"></div>
 
</div>  	  	<!------------------------------------------- End table ------------------------------------------------->
<?php } ?>
<div class="clear"></div>
</div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap_datatable.php"); ?> 
    
<script type="text/javascript">
 $(document).ready(function() {
    
 /*----------------------------------START CLINIC dataeditable ---------------------------------------------------------*/
$('#sample_test').dataTable( {	

        "bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": false,
        "bStateSave": true,
		"bBootstrap": true,
		"bFilter": false,
		"bInfo": false,
		"bAutoWidth": false,
		"bLengthChange": true,
		
		"fnPreDrawCallback": function( oSettings ) {		
		  $('.dataTables_filter input').addClass('form-control input-sm');
		  $('.dataTables_filter input').attr('placeholder', 'Search');	
		  $('.dataTables_filter input').css('height', '33px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  $('.dataTables_length select').css('height', '33px');	
		  $('.dataTables_length select').css('margin-right', '3px');	
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');
	   }
       }).makeEditable({
		
        sUpdateURL: 		   "ajax_sample_collection_update.php",		
		sAddNewRowFormId:     "formSample_collection",	
							
		aoColumns: [
					null,
					null,
					null,
								
						{							
							tooltip: 'Click to select Status',
							loadtext: 'loading...',
							cssclass: 'required',
							onblur: 'cancel',
							type: 'select',
							submit: 'ok',
							width: '60%',
							event: 'click',
							data: "{'1':'Pending','8':'Collected','9':'Collected-FF'}",
						},
				 			
				],
					
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
								setTimeout('window.location.reload()', 800);
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_message").dialog(); },
						
                    fnEndProcessingMode: function () {
                        $("#processing_message").dialog("close");    
						 window.location.reload();
                    },
        });

});


function check_timer(){
 if($('#timer').hasClass('start')){
	$('#counterSec').fadeOut(500).html(0).fadeIn(500);
	$('#counterMin').fadeOut(500).html(0).fadeIn(500);
	$('#counterHour').fadeOut(500).html(0).fadeIn(500);
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
<?php }?>