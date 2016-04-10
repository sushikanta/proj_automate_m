<?php require_once("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '3')
 {
	 resetCounter_value($con, 29); // Reset Ex_id daily
	 ?>
<!DOCTYPE html>
<html>
  <head>
  <title>FD - Expenditures</title>
  <?php include("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php include("right_top_header.php");?>
	<div class="container">
		<div class="page-content">   
        
<div class="inv-main">
    <div class="panel panel-success">
      <div class="panel-heading" style="color:#0D9707;"><h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Front Desk - Daily Expenditure
      <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span><a class="text-right pull-right navbar-link no-print" style="padding-left:30px;" href="FD_report_ac_statement_ui.php"><i class="fa fa-arrow-circle-right fa-lg"></i></a></span>
      </h3>
    </div>    
                                   
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="expenditure_table">
<thead align="left">
<tr>
  <th style="display:none;">EX_id</th>
  <th class="text-center">Sl.no</th>  
  <th> Voucher no.</th>
  <th> Particulars</th>
  <th> Receiver</th>
  <th class="text-center"> Date</th>
  <th class="text-right"> Amount</th>
  <th class="text-center">Edit</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT * FROM `expenditure` WHERE DATE_FORMAT(`EX_date`, '%Y-%m-%d') = CURDATE() ORDER BY `EX_id` DESC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$EX_id = $row['EX_id'];
	$EX_voucher = $row['EX_voucher'];
	$EX_particular = $row['EX_particular'];
	$EX_person = $row['EX_person'];
	$EX_amount = $row['EX_amount'];
	$EX_date = $row['EX_date'];
 ?>
 	<tr id = "<?php echo $EX_id;?>">
	   <td style="display:none;"> <?php echo $EX_id; ?> </td>
       <td class="text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row['EX_voucher']; ?></td> 
       <td><?php echo $row['EX_particular']; ?></td> 
       <td><?php echo $row['EX_person']; ?></td> 
	   <td style="text-align:center;"><?php echo date("d-m-Y h:i a", strtotime($row['EX_date']));?></td>
       <td class="text-right"><?php echo number_format($row['EX_amount'], 2, '.', '');?></td>
       <td style="cursor:pointer; text-align:center;"><a class="table-action-EditExpend"><i class="fa fa-pencil"></i> Edit</a></td>
     </tr>
	
<?php 
$sl_no++;
}
?>
</tbody>
</table>

<!---------------------------------------- Form for new ------------------------->
<form id="formNewExpend" action="#"> 
<label id="lblAddError3" style="display:none" class="error"></label>
 <div id="processing_message3" style="display:none" title="Processing">Please wait while processing....</div>
 
<label style="display:none;" >EX_id</label>
<input style="display:none;" type="hidden" name="ex_id" value="<?php echo $EX_id;?>" rel="0" />

<label style="width:36%; padding:20px 5px 5px 5px;">SL</label>
<input style="width:60%; padding:3px; text-transform:capitalize;" type="text" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="1" /> 
 <br/> 
 
 <label style="width:36%; padding:5px 5px 5px 5px;">Voucher #</label>
 <input style="width:60%; padding:3px; text-transform:capitalize;" type="text" name="voucher" id="voucher" rel="2" autofocus /> 
 <br/>
 
 <label style="width:36%; padding:5px 5px 5px 5px;">Particulars</label>
 <input style="width:60%; padding:3px; text-transform:capitalize;" type="text" name="particulars" id="particulars" rel="3" /> 
 <br/>
 
 <label style="width:36%; padding:5px 5px 5px 5px;">Receiver</label>
 <input style="width:60%; padding:3px; text-transform:capitalize;" type="text" name="receiver" id="receiver" rel="4" /> 
 <br/>
 
 <label style="width:36%; padding:5px 5px 5px 5px;">Date</label>
 <input style="width:60%; padding:3px;" type="text" name="date" id="date" value="<?php echo date("d-m-Y h:i a");?>" readonly rel="5" />    
 <br/>
 
 <label style="width:36%; padding:5px 5px 5px 5px;">Amount</label>
 <input style="width:60%; padding:3px; text-transform:capitalize;" type="text" name="amount" id="amount" rel="6" />   
   <span class="datafield" style="display:none" rel="7"><a class="table-action-EditExpend"><i class="fa fa-pencil"></i> Edit</a></span>
 </form>
 <button id="btnDeleteRow">Delete</button> <button id="btnAddNewRow">Add</button>     
 
 <!---------------------------------------- Form for Edit ------------------------->
<form id="formEditExpend" action="ajax_expenditure_update.php" title="Update selected row"> 
<label style="display:none;" >EX_id</label>
<input style="display:none;" type="hidden" name="ex_id" value="<?php echo $EX_id;?>" rel="0" />

<label style="width:36%; padding:20px 5px 5px 5px;">SL</label>
<input style="width:60%; padding:3px; text-transform:capitalize;" type="text" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="1" /> 
 <br/> 
 
 <label style="width:36%; padding:5px 5px 5px 5px;">Voucher #</label>
 <input style="width:60%; padding:3px; text-transform:capitalize;" type="text" name="voucher" id="voucher" rel="2" autofocus required /> 
 <br/>
 
 <label style="width:36%; padding:5px 5px 5px 5px;">Particulars</label>
 <input style="width:60%; padding:3px; text-transform:capitalize;" type="text" name="particulars" id="particulars" rel="3" required /> 
 <br/>
 
 <label style="width:36%; padding:5px 5px 5px 5px;">Receiver</label>
 <input style="width:60%; padding:3px; text-transform:capitalize;" type="text" name="receiver" id="receiver" rel="4" required /> 
 <br/>
 
 <label style="width:36%; padding:5px 5px 5px 5px;">Date</label>
 <input style="width:60%; padding:3px;" type="text" name="date_edit" id="date_edit" value="<?php echo date("d-m-Y h:i a");?>" readonly rel="5" />    
 <br/>
 
 <label style="width:36%; padding:5px 5px 5px 5px;">Amount</label>
 <input style="width:60%; padding:3px; text-transform:capitalize;" type="text" name="amount" id="amount" rel="6" required />  
    <br />
    <br />
    <button id="formEditExpendCancel" type="button">Cancel</button>      
    <button id="formEditExpendOk" type="submit">Confirm</button>    
   <br /> 
    <br /> 
   <span class="datafield" style="display:none" rel="7"><a class="table-action-EditExpend"><i class="fa fa-pencil"></i> Edit</a></span>
   </form>
   
   </div>
  <div class="clear"></div>
</div>

<?php include("footer.php"); ?>   
<?php include("script_bootstrap_datatable.php"); ?>
<script src="js/bootstrap-datetimepicker.min.js"></script>

<script charset="utf-8" type="text/javascript">
 
$(document).ready(function() {	
    
  $('#expenditure_table').dataTable( {        

		"bJQueryUI": true,
		"bPaginate": true,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
		"bFilter":true,
		"bInfo":true,
		
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
			
				
     } ).makeEditable({
		 
		 aoTableActions: [
								{
								 sAction: "EditExpend",
								 sServerActionURL: "ajax_expenditure_update.php",
								 oFormOptions: { 
								 autoOpen: false, 
								 modal: true,
								 resizable: false,
				                 draggable: true, 
								 width:'auto',
								 height:'auto',
								 backdrop: 'static',
								 cssclass: 'required',				
				                
								width: '50%',
								maxHeight: 600,
								cssclass: 'required',
								overflow: 'scroll',
								minimalTopSpacingOfModalbox : 40,
								  }
								}
						], 
		 
		sAddURL:              "ajax_expenditure_add.php",
        sDeleteURL:           "ajax_expenditure_delete.php",
		sUpdateURL:           "ajax_expenditure_update.php",
		
		sAddNewRowFormId:     "formNewExpend",
		sAddNewRowButtonId: "btnAddNewRow",
		sDeleteRowButtonId: "btnDeleteRow",
		sAddNewRowOkButtonId: "btnAddNewRowOk",
		sAddNewRowCancelButtonId: "btnAddNewRowCancel",
		   
		oAddNewRowButtonOptions: { 
				label: "Add...",
				icons: {primary:'ui-icon-plus'}
				},
	    oDeleteRowButtonOptions: { 
				label: "Remove",
				icons: {primary:'ui-icon-trash'}
				},
		oAddNewRowOkButtonOptions: {
				label: "Confirm",
                icons: { primary: 'ui-icon-check' },
				name: "action",
				value: "add-new"
				},
        oAddNewRowCancelButtonOptions: { 
				label: "Close",
				class: "back-class",
				name: "action",
				value: "cancel-add",
				icons: { primary: 'ui-icon-close' }
				},
        oAddNewRowFormOptions: {
				title: 'Add new Expenditure',
				autoOpen: false,
				modal: true,
				resizable: false,
				draggable: true,
				hide: 'fade', 
				width:'auto',
				height:'auto',	
				cssclass: 'required',
				width: '50%',
								maxHeight: 600,
								cssclass: 'required',
								overflow: 'scroll',
								minimalTopSpacingOfModalbox : 40,
				}, 
		
	
		aoColumns: [
                    	null, 
						null, 
						null,  
						null, 
						null,                    				                  				
						null,                   				                  				
					
                    ],
					
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
                                break;
                            case "add":
                                $("#lblAddError").html(message);
                                $("#lblAddError").show();
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_message").dialog();
						
                    },
                    fnEndProcessingMode: function () {
                        $("#processing_message").dialog("close");    
						//window.location.reload();
                    },
					
                    fnOnDeleting: function (tr, id, fnDeleteRow) {
                        jConfirm('Please confirm that you want to delete selected row', 'Confirm Delete', function (r) {
                            if (r) {
                                fnDeleteRow(id);
                            }
                        });
                        return false;
                    }   
		});
		
	var oTable = $('#expenditure_table').dataTable(); 
    oTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation
	});
	
	
	/*------------------------- Add Validation ------------------------------------*/
$("#formNewExpend").validate({
	ignore: "",
	//errorContainer: ".err",
	//errorLabelContainer: '.span-error',
	onkeyup: true,
	onblur: true,	
	
rules: {
		
    voucher: { required: true,						
						minlength:1,
						maxlength: 10
					}, 
	particulars: { required: true,						
						minlength:1,
						maxlength: 150
					}, 
	receiver: { required: true,						
						minlength:3,
						maxlength: 50
					}, 
	amount: { required: true,						
						number: true,
						minlength:1,
						maxlength: 10
					}, 
			 },
		
messages: {
			voucher: {   required: "Please fill voucher no.",
							minlength: "Min.length is 1 character",
							maxlength: "Max.length is 10 characters" },
		   particulars: {  required: "Please fill particulars",
							minlength: "Min.length is 1 character",
							maxlength: "Max.length is 150 characters" },
		  receiver: {   required: "Please fill person's name",
							minlength: "Min.length is 3 character",
							maxlength: "Max.length is 50 characters" },
		  amount: {   required: "Please fill amount",
							number: "Please fill only number",
							minlength: "Min.length is 1 number",
							maxlength: "Max.length is 10 numbers" },		  
		},
});			

/*-------------------- DATE TIME PICKER ------------------------*/

	$('#date, #date_edit').datetimepicker({
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up: "fa fa-chevron-up",
			down: "fa fa-chevron-down"
		},
		 format: ("DD-MM-YYYY hh:mm a"),
		 pickTime: true,			
	});
 
</script>
</body>
</html>
<?php } ob_flush();?>