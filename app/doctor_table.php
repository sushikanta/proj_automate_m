<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Doctor List</title>
<?php require_once("css_bootstrap_datatable_header.php"); ?>
</head>
<body>

<?php require_once("right_top_header_admin.php"); ?>
<div class="container">
 <div class="page-content">

 <div class="inv-main">

 <div class="panel panel-success">  <!----------------------START Employee Information-------------->
    <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Doctor <span class="panel-subTitle"> ( List ) </span>
   	 <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
  </div>

<table cellpadding="0" cellspacing="0" border="0" class="table-hover table-condensed" id="dr_table">
<thead align="left">
<tr>
<!--<th style="display: none;"> dr_id</th>-->
<th> # </th>
<th> Name</th>
<th> Address</th>
<th> Phone</th>
<th> DoB</th>
<th> Marital</th>
<th> Working at</th>
<th> Position</th>
<th> Dept</th>
<th> View</th>
<th> Add/Edit</th>
</tr>
</thead>
<tbody>
<?php
$result = mysqli_query($con, "SELECT i.dr_id, i.dr_name, i.dr_address, i.dr_phone, i.dr_dob, m.marital_name, p.dp_specialization, p.dp_designation, p.dp_institute FROM dr_info i LEFT JOIN marital_tbl m ON m.marital_id = i.dr_marital LEFT JOIN dr_profile p ON p.dp_dr_id = i.dr_id ORDER BY i.dr_name ASC");
$sl_no=1;
while ($row = mysqli_fetch_array($result))
{
	$dr_id=$row['dr_id'];
	$dr_dob=$row['dr_dob'];
?>
 <tr id="<?php echo $dr_id; ?>">
    <td class="readonly-bg"><?php echo $sl_no; ?></td>
    <td class="readonly-bg"><?php echo $row['dr_name'];?></td>
	<td class="readonly-bg"><?php echo $row['dr_address'];?></td>
    <td class="readonly-bg"><?php if($row['dr_phone'] !='')echo "+91 ".$row['dr_phone']; ?> </td>
    <td class="readonly-bg"><?php if($dr_dob !='0000-00-00')echo date("d-M-Y", strtotime($dr_dob)); ?> </td>
    <td class="readonly-bg"><?php echo  $row['marital_name']; ?></td>
    <td class="readonly-bg"><?php echo  $row['dp_institute']; ?></td>
    <td class="readonly-bg"><?php echo  $row['dp_designation']; ?></td>
    <td class="readonly-bg"><?php echo $row['dp_specialization'];?></td>
	 <form action="doctor_view.php" role="form" method="get" target="_blank" class="form_profile">
  	<input type="hidden" name="dr_id" value="<?php echo $dr_id;?>">
  	<td class="text-center"><button class=" btn-link" type="submit" name="submit_view" title="View Employee Profile">
    <i class="fa fa-stack-exchange"></i></button></td>
 	</form>

    <form action="doctor_edit.php" role="form" method="get" target="_blank" class="form_view">
  	<input type="hidden" name="dr_id" value="<?php echo $dr_id;?>">
  	<td class="text-center"><button class=" btn-link" type="submit" name="submit_view" title="Add/Edit Employee Profile">
    <i class="fa fa-plus"> <i class="fa fa-edit"></i></button></td>
 	</form>

 
 </tr>
 <?php
	$sl_no++;
}
?>
<button id="btnDeleteRow" class="no-print">Delete</button>
</tbody>
</table>

<div class="clear"></div>
</div>

<?php include("footer.php"); ?>
<?php include("script_bootstrap_datatable.php"); ?>
<script charset="utf-8" type="text/javascript">
$(document).ready(function() {

  $('#dr_table').dataTable( {

    "bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
    "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth":false,

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
         sDeleteURL:        "doctor_ajax_delete.php",   
    sDeleteRowButtonId: "btnDeleteRow",
    sAddNewRowButtonId: "btnAddNewRow",
    //sAddDeleteToolbarSelector: ".dataTables_length",

      oDeleteRowButtonOptions: {
        label: "Remove",
        icons: {primary:'ui-icon-trash'}
        },


    aoColumns: [
            null,
            null,
            null,
            ],

  fnShowError: function (message, action) {
                        switch (action) {
                            case "delete":
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
<?php ob_flush() ?>