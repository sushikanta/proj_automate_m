﻿<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
  <head>
  <title>Add State </title>
  <?php include("css_bootstrap_datatable_header.php");?>
</head>
<body>
<?php include("right_top_header.php");?>
	<div class="container">
		<div class="page-content">

<div class="inv-main">
    <div class="panel panel-success">
      <div class="panel-heading light_purple_color"><h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
      Add <span class="panel_subTitle">( State )</span>
      <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
      </h3></div>

<table cellpadding="0" cellspacing="0" border="0" class=" table-hover" id="state_tbl">
<thead align="left">
<tr>
  <th>Sl No.</th>
  <th>State</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT state_id, state_name FROM state_tbl ORDER BY state_id ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$state_id = $row['state_id'];
	?>
 	<tr id = "<?php echo $state_id;?>">
	   <td class="readonly-bg"> <?php echo $sl_no; ?> </td>
	   <td><?php echo $row['state_name']; ?></td>
     </tr>
<?php
$sl_no++;
}
?>
<button id="btnAddNewRow" class="no-print">Add</button>
<button id="btnDeleteRow" class="no-print" style="display:none;">Delete</button>
</tbody>
</table>

<form id="dr_form" method="post" action="#" title="Add New" style="display:none">
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>

  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>
  <div class="col-lg-7 padding_gap">
  <input type="text" name="sl_no" class="form-control" value="<?php echo $sl_no;?>" readonly rel="0" required>
  </div>
  </div></div>
  <br/>
  <div class="form-group">
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="state">State :</label>
  <div class="col-lg-7 padding_gap">
  <input name="state" class="form-control capital" placeholder="State Name" rel="1" maxlength="50" required autofocus>
   </div></div></div>
  <br/>
    </form>
    <!-- <div class="add_delete_toolbar"/>  -->


<div class="clear"></div>
</div>
<?php include("footer.php"); ?>
<?php include("script_bootstrap_datatable.php"); ?>
<script charset="utf-8" type="text/javascript">

$(document).ready(function(){
  $('#state_tbl').dataTable({
		"bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
		"bInfo": false,

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

        sAddURL:              "state_ajax_add.php",
		sAddNewRowFormId:     "dr_form",

		sDeleteRowButtonId: "btnDeleteRow",
		sAddNewRowButtonId: "btnAddNewRow",
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
				title: 'Add new State',
				resizable: false,
				draggable: false,
				autoOpen: false,
				modal: true,
				width: '45%',
				maxHeight: 350,
				cssclass: 'required',
				overflow: 'scroll',
				//minimalTopSpacingOfModalbox: 20,
				},


		aoColumns: [
					null,
					null,
					  ],

	fnShowError: function (message, action) {
                        switch (action) {
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

    });
});

</script>
</body>
</html>
<?php ob_flush();?>