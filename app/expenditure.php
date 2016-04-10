<?php require_once("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php");
	exit;
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '2')
 {
	 ?>
<!DOCTYPE html>
<html>
  <head>
  <title>Admin - Expenditures</title>
  <?php include("css_bootstrap_datatable_header.php");?>
</head>
<body>
<?php include("right_top_header_admin.php");?>
	<div class="container">
		<div class="page-content">

<div class="inv-main">
    <div class="panel panel-success">
      <div class="panel-heading" style="color:#0D9707;"><h3 class="panel-title"><i class="fa fa-square fa-spin fa-fw fa-lg"></i> ED - Expenditures
      <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <?php echo date("jS F Y (l), h:i A", time());?><a class="text-right pull-right navbar-link no-print" style="padding-left:30px;" href="report_daily_ui.php"><i class="fa fa-arrow-circle-right fa-lg"></i></a></span>
      </h3>
    </div>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display" id="expenditure_table">
<thead align="left">
<tr>
  <th class="text-center">Sl.no</th>
  <th> Voucher no.</th>
  <th> Particulars</th>
  <th> Receiver</th>
  <th class="text-center"> Date</th>
  <th class="text-right"> Amount</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT * FROM `expenditure` ORDER BY `EX_date` DESC");
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
	   <td class="text-center"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row['EX_voucher']; ?></td>
       <td><?php echo $row['EX_particular']; ?></td>
       <td><?php echo $row['EX_person']; ?></td>
	   <td class="text-center"><?php echo date("d-m-Y", strtotime($row['EX_date']));?></td>
       <td class="text-right"><?php echo number_format($row['EX_amount'], 2, '.', '');?></td>
     </tr>

<?php
$sl_no++;
}
?>
</tbody>
</table>
<!-- <div class="add_delete_toolbar" /> -->
<form id="addme" action="#">
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>

 <label style="margin-right:32px;" >#</label>
 <label style="margin-right:15px;">Voucher #</label>
 <label style="margin-right:217px;">Particulars</label>
 <label style="margin-right:72px;">Receiver</label>
  <label style="margin-right:88px;">Date</label>
 <label style="margin-right:0px;">Amount</label>


   <br/>
    <input style="width:35px; margin-right:10px;" type="text" name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" disabled rel="0" />
    <input style="width:92px; margin-right:10px; text-transform:capitalize;" type="text" name="voucher" id="voucher" rel="1" maxlength="10" />
    <input style="width:300px; margin-right:10px; text-transform:capitalize;" type="text" name="particulars" id="particulars" rel="2" maxlength="150" />
    <input style="width:130px; margin-right:10px; text-transform:capitalize;" type="text" name="receiver" id="receiver" rel="3" maxlength="50" />
    <input style="width:110px; margin-right:10px;" type="text" name="cur_date" id="cur_date" value="<?php echo date("d-m-Y");?>" readonly rel="4" />
    <input style="width:100px; margin-right:10px;" type="text" name="amount" id="amount" rel="5" maxlength="10" />
     <br />
 </form>
 <button id="btnDeleteRowF">Delete</button> <button id="btnAddNewRowF">Add</button>
<div class="clear"></div>
</div>
<?php include("footer.php"); ?>
<?php include("script_bootstrap_datatable.php"); ?>
<script src="js/jquery.jeditable.datepicker.js" type="text/javascript"></script>
<script charset="utf-8" type="text/javascript">

$(document).ready(function() {

  $('#expenditure_table').dataTable( {

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
		  //$('.dataTables_filter input').css('margin-right', '15px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  //$('.dataTables_length label').addClass('form-control input-sm');
		  //$('.dataTables_length label').css('width', '400px');
		  $('.dataTables_length select').css('height', '33px');
		  $('.dataTables_length select').css('margin-right', '3px');
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');

	   }


     } ).makeEditable({

        sAddURL:              "ajax_expenditure_add.php",
        sDeleteURL:           "ajax_expenditure_delete.php",
		sUpdateURL: 		   "ajax_expenditure_update.php",
		sAddNewRowFormId:     "addme",
		sAddDeleteToolbarSelector: ".dataTables_length",

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
				resizable: false,
				draggable: true,
				width:'auto',
				height:'auto',
				},


		aoColumns: [
						null,
							{
							  loadtext: 'loading...',
							  indicator: 'saving...',
							  tooltip: 'click to update Voucher No.',
							  type: 'text',
							  onblur: 'cancel',
							  submit: 'ok',
							  event: 'click',
							  width: '40%',

							   oValidationOptions :
                                   {   rules:{ value: { required: true, maxlength: 10 } },
                                   messages: { value: { maxlength: "Oops ! Max.length is 10 characters" } }
                                   }
							},
							{
							tooltip: 'Click to update Particulars',
							loadtext: 'loading...',
							indicator: 'saving...',
							cssclass: 'required',
							width: '80%',
							type: 'textarea',
							onblur: 'cancel',
							submit: 'ok',
							event: 'click',
							oValidationOptions :
                                   {   rules:{ value: { required: true, maxlength: 150 } },
                                   messages: { value: { maxlength: "Oops ! Max.length is 150 characters" } }
                                   }
							},
							{
							tooltip: 'Click to update Receiver',
							loadtext: 'loading...',
							indicator: 'saving...',
							cssclass: 'required',
							width: '50%',
							type: 'text',
							onblur: 'cancel',
							submit: 'ok',
							event: 'click',
							oValidationOptions :
                                   {   rules:{ value: { required: true, maxlength: 50 } },
                                   messages: { value: { maxlength: "Oops ! Max.length is 50 characters" } }
                                   }
							},

							{
							  tooltip: 'Click to update Date',
							  type: 'datepicker',
							  format:'dd-mm-yy',
							  event: 'click',
 							  sSuccessResponse: "IGNORE"
                                     },

							{
							tooltip: 'Click to update Amount',
							loadtext: 'loading...',
							indicator: 'saving...',
							cssclass: 'required',
							width: '30%',
							type: 'text',
							onblur: 'cancel',
							submit: 'ok',
							event: 'click',
							oValidationOptions :
                                   {   rules:{ value: { required: true, number: true, maxlength: 10 } },
                                   messages: { value: { maxlength: "Oops ! Max.length is 10 numbers" } }
                                   }
							},



				  ],

	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
								window.location.reload();
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
								window.location.reload();
                                break;
                            case "add":
                                $("#lblAddError").html(message);
                                $("#lblAddError").show();
								window.location.reload();
                                break;
                        }
                    },
                    fnStartProcessingMode: function () {
                        $("#processing_message").dialog();

                    },
                    fnEndProcessingMode: function () {
                        $("#processing_message").dialog("close");
						// window.location.reload();
                    },

                    fnOnDeleting: function (tr, id, fnDeleteRow) {
                        jConfirm('Please confirm that you want to delete selected row', 'Confirm Delete', function (r) {
                            if (r) {
                                fnDeleteRow(id);
                            }
                        });
                        return false;
                    }
    } );

/*------------------------- Add Validation ------------------------------------*/


$("#addme").validate({
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



} );

$("#cur_date").datepicker({   //family member date of birth
changeMonth: false,
changeYear: false,
yearRange: "-1:+0", // Setting yearRange of 1 years ago
dateFormat: "dd-mm-yy",
});

</script>
</body>
</html>
<?php } ob_flush();?>