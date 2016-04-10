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
<?php include("css_bootstrap_datatable_header.php"); ob_start(); ?> 
<body>
<?php include("right_top_header_collection.php"); ?>
<div class="container">
 <div class="page-content">

<div class="inv-main">	
  <div class="panel panel-success">  <!----------------------START Sample collection table-------------->
	<div class="panel-heading">
     <h3 class="panel-title"><i class="fa fa-tint fa-fw fa-lg"></i>Sample Collection
        <span class="pull-right inline"> 
        <span id="counterHour" class="text-right">00</span>
       <span class="text-right">:H&nbsp;</span>
        <span id="counterMin" class="text-right">00</span>
        <span class="text-right">:M&nbsp;</span>
        <span id="counterSec" class="text-right">00</span>
       <span class="text-right">:S&nbsp;</span>&nbsp;&nbsp;
        <input type="button" id="timer" class="start btn btn-mini btn-success" value="Start Timer" onclick="check_timer()">
       </span>
    </h3>
    </div>                                      
                          
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="collection_table">
<thead align="left">
<tr>
  <th style="width:1%;"> # </th>
  <th style="width:3%;"> Reg. ID</th>
  <th> Name</th>
  <th style="width:6%;"><i class="fa fa-male"></i><i class="fa fa-female"></i></th>
  <th style="width:1%;"><i class="fa fa-user-md"></i></th>
  <th style="width:14%;"><i class="fa fa-calendar"></i> Registered on</th>
  <th> Patient History</th>
  <th> Lab Notes</th>
  <th style="width:2%;"> <i class="fa fa-flask"></i></th>
 <!-- <th> Collector</th>
  <th> Status</th>
  <th> <i class="fa fa-calendar fa-lg"></i> Colltn</th>-->
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT DISTINCT `patient_registration`.*, `patient_info`.`PI_name`, `patient_info`.`PI_address`, `patient_info`.`PI_age`,  `patient_info`.`PI_gender_id` FROM `patient_registration` LEFT JOIN `patient_info` ON `patient_info`.`PI_id` =  `patient_registration`.`pr_patient_id` LEFT JOIN `patient_test` ON `patient_test`.`PT_receipt_no` = `patient_registration`.`pr_receipt_no` WHERE `patient_test`.`PT_dept_id`='5' AND `patient_test`.`PT_status_id`='1' ORDER BY `patient_registration`.`pr_date` DESC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
?>
 <tr id="<?php echo $row['pr_receipt_no'] ; ?>">
    <td class="readonly-bg"> <?php echo $sl_no; ?> </td>  
    <td class="readonly-bg" style="font-weight:100; color:#00F;"> <?php echo $row['pr_receipt_no']; ?> </td>  
	<td class="readonly-bg"> <?php echo $row['PI_name']; ?></td>
    <td class="readonly-bg"> <?php if ($row['PI_gender_id'] ==1){echo "M / ".$row['PI_age'];}elseif ($row['PI_gender_id'] ==2){echo "F / ".$row['PI_age'];}else{echo "";} ?> </td> 
    <td class="readonly-bg"> <?php if ($row['pr_dr_prescription'] ==1){echo "Yes";} else if($row['pr_dr_prescription'] ==2){echo "No";} else{echo"";} ?> </td> 
    <td class="readonly-bg"> <?php echo date("d-M-Y, h:i a", strtotime($row['pr_date'])); ?></td>
	
    <td><?php echo $row['pr_patient_history'];?></td>
    <td><?php echo $row['pr_lab_notes'];?></td>
    <td style="color:#F00;"><abbr title="No.of Investigations"><?php echo showLab_test($con, $row['pr_receipt_no']);?></abbr> 
    <a href="sample_collection_test_list.php?table_receipt_no=<?php echo $row['pr_receipt_no'] ;?>" class="navbar-link" style="cursor:pointer; color:#00F;"><i class="fa fa-stack-exchange"></i></a></td>
   <!-- <td> <?php echo $row['SC_status_id'];?></td>  
	<td> <?php echo $row['SC_collector_id'];?></td>  
    <td class="readonly-bg"> <?php  
		if(isset($row['SC_status_date']))
			 { echo date("d-M-Y [h:i A]", strtotime($row['SC_status_date'])); }
	   else  { echo ""."<br/>".""; } ?>
     </td>-->
   </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table>

<form id="formSample_collection" action="#">  
    <label id="lblAddError" style="display:none;" class="error"></label>
    <div id="processing_message" style="display:none;" title="Processing">Please wait while processing....</div>
  
    <label style="display:none;" for="sl_no">#</label>
    <label style="display:none;" >Registration ID</label>
    <label style="display:none;" >Patient Name</label>
    <label style="display:none;" >Gender/age</label>
    <label style="display:none;" >Dr.letter</label>
    <label style="display:none;" >Date</label>
    <label style="display:none;" >Patient History</label>
   </br>    
   
    <input style="display:none;" type="text" name="sl_no" value="<?php echo $sl_no;?>" disabled rel="0" /> 
    <input style="display:none;" type="text" name="receipt_no" rel="1" /> 
    <input style="display:none;" type="text" name="patient_name" rel="2" /> 
    <input style="display:none;" type="text" name="gender_age" rel="3" /> 
    <input style="display:none;" type="text" name="dr_letter" rel="4" />
    <input style="display:none;" type="text" name="patient_history" rel="5" />
    <input style="display:none;" type="text" name="lab_notes" rel="6">
    <input style="display:none;" type="text" name="view" rel="7"> 
    <br/>               
 </form>  
<div class="add_delete_toolbar" style="display:none;"></div>  
<div class="clear"></div>
</div>

<?php include("footer.php"); ob_flush();?> 
<?php include("script_bootstrap_datatable.php"); ?>     
<script charset="utf-8" type="text/javascript">
$(document).ready(function() {

$('#collection_table').dataTable( {        

		"bJQueryUI": true,
		"bPaginate": true,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,		

		"fnPreDrawCallback": function( oSettings ) {		
		  $('.dataTables_filter input').addClass('form-control input-sm');
		  $('.dataTables_filter input').attr('placeholder', 'Search');	
		  $('.dataTables_filter input').css('height', '33px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  $('.dataTables_length select').css('height', '33px');	
		  $('.dataTables_length select').css('margin-right', '3px');	
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');}
				
        }).makeEditable({
		
        sUpdateURL: 		   "ajax_sample_collection_update.php",		
		sAddNewRowFormId:     "formSample_collection",	
							
		aoColumns: [
					null,
					null,
					null,
					null,
					null,
					null,
						{
							tooltip: 'Click to update Patient History',
							loadtext: 'loading...',
							//cssclass: 'required',
							width: '75%',
							type: 'textarea',
							onblur: 'cancel',
							submit: 'ok',
							event: 'click',
							
							},					
						{							
							tooltip: 'Click to update Lab Notes',
							loadtext: 'loading...',
							//cssclass: 'required',
							onblur: 'cancel',
							type: 'textarea',
							submit: 'ok',
							width: '73%',
							event: 'click',
						},
						null,
						/*{							
							tooltip: 'Click to select User',
							loadtext: 'loading...',
							cssclass: 'required',
							onblur: 'cancel',
							type: 'select',
							submit: 'OK',
							width: '70%',
							event: 'click',
							loadurl: "ajax_sample_collectors_list.php",
						},
						{							
							tooltip: 'Click to select Status',
							loadtext: 'loading...',
							cssclass: 'required',
							onblur: 'cancel',
							type: 'select',
							submit: 'OK',
							width: '60%',
							event: 'click',
							loadurl: "ajax_sample_collection_status_list.php",
						},
				  null, 				 */
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