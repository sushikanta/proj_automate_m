<?php require_once("check_login_fd.php");
	 resetCounter($con, '29', 'dd'); // Reset Ex_id daily
	 resetcounter($con, 42, 'dd');  // reset audit
	 ?>
<!DOCTYPE html>
<html>
  <head>
  <title>Daily Expenditure</title>
  <?php include("css_bootstrap_datatable_header.php");?>
</head>
<body>
<?php include("right_top_header.php");?>
	<div class="container">
		<div class="page-content">

<div class="inv-main">
    <div class="panel panel-success">
      <div class="panel-heading no-print light_purple_color">
    <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    Expenditure <span class="panel-subTitle">( Daily )</span>
   <span class="date_time pull-right light_purple_color" style="padding-right:10px;"> <i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
    </div>

<table cellpadding="0" cellspacing="0" border="0" class="table-condensed table-hover" id="expenditure_table">
<thead align="left">
<tr>
  <th>Sl.no</th>
  <th> Voucher no.</th>
  <th> Particulars</th>
  <th> Receiver</th>
  <th> Date</th>
  <th class="text-right"> Amount</th>
  <th> Added by</th>

</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT e.EX_id, e.EX_voucher, e.EX_particular, e.EX_person, e.EX_amount, e.EX_date, e.EX_user, u.user_name FROM expenditure e LEFT JOIN user_table u ON u.user_id = e.EX_user WHERE DATE_FORMAT(e.EX_date, '%Y-%m-%d') = CURDATE()");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$EX_id = $row['EX_id'];
	$EX_voucher = $row['EX_voucher'];
	$EX_particular = $row['EX_particular'];
	$EX_person = $row['EX_person'];
	$EX_amount = $row['EX_amount'];
	$EX_date = $row['EX_date'];
	$EX_user = $row['EX_user'];
	$user_name = $row['user_name'];
 ?>
 	<tr id = "<?php echo $EX_id;?>">
       <td> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row['EX_voucher']; ?></td>
       <td><?php echo $row['EX_particular']; ?></td>
       <td><?php echo $row['EX_person']; ?></td>
	   <td><?php echo date("d-m-Y h:i a", strtotime($row['EX_date']));?></td>
       <td class="text-right"><?php echo number_format($row['EX_amount'], 2, '.', '');?></td>
       <td><?php echo $user_name;?></td>
     </tr>

<?php
$sl_no++;
}
?>
<button id="btnDeleteRow" style="display:none;">Delete</button> <button id="btnAddNewRow">Add</button>
</tbody>
</table>

<!------------ Form for new -------------->

<form id="formNewExpend" method="post" action="#" title="(<?php echo $sl_no;?>) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Add New Expenditure" style="display:none;">

<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>

<div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # </label>
  <div class="col-lg-7 padding_gap"><input  type="text" name="sl_no" class="form-control" value="<?php echo $sl_no;?>" readonly rel="0"/>
  </div></div></div>
  <br/>

 <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="voucher">Voucher # </label>
  <div class="col-lg-7 padding_gap"><input  type="text" name="voucher" class="form-control capital" placeholder="voucher" autofocus maxlength="10" required rel="1"/>
  </div></div></div>
  <br/>

  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="particulars">Particulars </label>
  <div class="col-lg-7 padding_gap"><input  type="text" name="particulars" id="particulars" class="form-control capital" placeholder="Particulars" autofocus maxlength="30" required rel="2"/>
  </div></div></div>
  <br/>

  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="receiver">Receiver </label>
  <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control capital" name="receiver" id="receiver" placeholder="Receiver" maxlength="60" required rel="3" />
  </div></div></div>
  <br/>

  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="date_ex">Date </label>
  <div class="col-lg-7 padding_gap">
  <input  type="text" class="form-control capital" name="date_ex" id="date_ex" value="<?php echo date("d-m-Y h:i A");?>" required readonly rel="4" />
  </div></div></div>
  <br/>

  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="amount">Amount </label>
  <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" required rel="5" />
  </div></div></div>
  <br/>

  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="user">Added By </label>
  <div class="col-lg-7 padding_gap">
  <input  type="text" class="form-control" name="user" id="user" value="<?php echo $_SESSION['user_name']; ?>" required rel="6" readonly/>
  <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']; ?>"/>
  </div></div></div>
  <br/>
  <br/>
</form>
<!-- <div class="add_delete_toolbar"/> -->
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
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
		"bFilter":true,
		"bInfo":false,

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

		sAddURL:              "expenditure_ajax_add.php",
        // sDeleteURL:           "delete_not_authorised.php",
		//sUpdateURL:           "delete_not_authorised.php",

		sAddNewRowFormId:     "formNewExpend",
		sAddNewRowButtonId: "btnAddNewRow",
		sDeleteRowButtonId: "btnDeleteRow",
		sAddNewRowOkButtonId: "btnAddNewRowOk",
		sAddNewRowCancelButtonId: "btnAddNewRowCancel",
		//sAddDeleteToolbarSelector: ".dataTables_length",

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
                            case "delete":
                                jAlert(message, "Delete failed");
                                break;
                            case "add":
                                jAlert(message, "Add Failed");
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
	});


	/*------------------------- Add Validation ------------------------------------*/
$("#formNewExpend").validate({
	ignore: "",
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

	$('#date_ex').datetimepicker({
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up: "fa fa-chevron-up",
			down: "fa fa-chevron-down"
		},
		 format: ("DD-MM-YYYY hh:mm A"),
		 pickTime: true,
	});

</script>
</body>
</html>
<?php ob_flush();?>