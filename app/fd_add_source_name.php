<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
  <head>
  <title>Add Source Name</title>
  <?php include("css_bootstrap_datatable_header.php");?>
</head>
<body>
<?php include("right_top_header.php");?>
	<div class="container">
		<div class="page-content">

<div class="inv-main">
    <div class="panel panel-success">
          <div class="panel-heading light_purple_color"><h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
          Add <span class="panel_subTitle">( Source Name )</span>
          <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
       </h3></div>

<table cellpadding="0" cellspacing="0" border="0" class=" table-hover" id="dr_add_tbl">
<thead align="left">
<tr>
  <th> Sl No.</th>
  <th>Source Person</th>
  <th>Source Type</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT r.referred_id, r.referred_name, r.source_id, s.source_name FROM referred_tbl r LEFT JOIN source_tbl s ON s.source_id = r.source_id  ORDER BY referred_name ASC ");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$referred_id = $row['referred_id'];

	?>
 	<tr id = "<?php echo $referred_id;?>">
	   <td class="readonly-bg"> <?php echo $sl_no; ?></td>
	   <td><?php echo $row['referred_name']; ?></td>
	   <td><?php echo $row['source_name'];?></td>
     </tr>

<?php
$sl_no++;
}
?>
<button id="btnDeleteRow" style="display:none;">Delete</button> <button id="btnAddNewRow">Add</button>
</tbody>
</table>

<form id="dr_form" action="#">
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>

 <label style="margin-right:68px;" >Sl no</label>
 <label style="margin-right:345px;">Source Name</label>
 <label style="margin-right:0px;">Source Type</label>
     <br/>

    <input style="width:100px; margin-right:10px;" type="text"  name="sl_no" id="sl_no" value="<?php echo $sl_no;?>" readonly rel="0" />
    <input style="width:450px; margin-right:10px;" type="text" name="ref_name" id="ref_name" rel="1" required />

     <?php
	$result2 = mysqli_query($con, "SELECT source_id, source_name FROM source_tbl WHERE source_id > '3' ORDER BY source_name ASC");
	?>
     <select style="width:240px; margin-right:10px;" name="source_id" id="source_id" rel="2" required>
    <option value="">Select Source Type</option>
    <?php
       while($row1=mysqli_fetch_array($result2)) {
	?>
        <option value="<?php echo $row1['source_id']; ?>"> <?php echo $row1['source_name']; ?></option>
    <?php
	  }
	?>
    </select>
     <br />
    </form>
     <!-- <div class="add_delete_toolbar"/> -->
<!--<button id="btnAddNewRow" class="no-print">Add</button>
<button id="btnDeleteRow" class="no-print" style="display:none;">Delete</button>   -->

<div class="clear"></div>
</div>
<?php include("footer.php"); ?>
<?php include("script_bootstrap_datatable.php"); ?>
<script charset="utf-8" type="text/javascript">

$(document).ready(function() {

  $('#dr_add_tbl').dataTable( {

		"bJQueryUI": true,
		"bPaginate": false,
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

        sAddURL:              "fd_add_source_name_ajax_add.php",
        //sUpdateURL: 		   "fd_add_source_name_ajax_update.php",
		sDeleteURL: 		   "delete_not_authorised.php",
		sAddNewRowFormId:     "dr_form",

		sDeleteRowButtonId: "btnDeleteRow",
		sAddNewRowButtonId: "btnAddNewRow",
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
				title: 'Add new Category',
				resizable: false,
				draggable: true,
				width:'auto',
				height:'auto',
				},


		aoColumns: [
						null,
						null,

				  ],

	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                alert();
								jAlert(message, "Update failed");
								//window.location.reload();
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
								//window.location.reload();
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
						 //sswindow.location.reload();
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

} );

</script>
</body>
</html>
<?php ob_flush();?>