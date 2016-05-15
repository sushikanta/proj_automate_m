<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Search</title>
<?php require_once("css_bootstrap_header.php");?>
<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
<?php require_once("right_top_header.php");?>
<div class="container">
 <div class="page-content">
  <div class="inv-main">

  <div class="panel panel-success">

  <div class="panel-heading light_purple_color">
    <h3 class="panel-title"><i class="fa fa-cubes fa-lg fa-fw"></i> &nbsp;&nbsp;&nbsp;
    Search  <span class="panel-subTitle"> ( Front Desk )</span>
    <button id="close_all" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-times fa-lg"></i> Reset Here&nbsp;</button>
    <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
  </div>
<div class="panel-body>">

  <!-- ROW 1 -->
  <div class="row">
    <div><h4 align="center" class="blue_color" style="margin-bottom:-15px;"> For Existing Registration</h4><hr /></div>
     <div class="form-group">
    <form  action="fd_search_result.php"class="form-inline inv-form" role="form" method="get" target="_blank" id="search_eid">
    <div class="form-control-group">
    <label for="reg_no" class="col-lg-2 control-label text-right"></label>
    <div class="col-lg-8">
    <input type="text" class="form-control height_lg" id="reg_no" placeholder="Search by Registration # (eg. 1550910) - - - - - - min.4 digits" name="reg_no" required>
    <input type="hidden" name="receipt_no" id="reg_no_eid">
    <input type="hidden" name="tid" value="1">
    </div>
    <button name="eid_go" class="btn btn-primary font_18" type="submit">GO</button>
    </div>
    </form>
    </div>
  </div>

  <!-- ROW 2 patient_name-->
  <div class="row">
   <div class="form-group">
    <form  action="fd_search_result.php"class="form-inline inv-form" role="form" method="get" target="_blank" id="search_name">
    <div class="form-control-group">
    <label for="patient_name" class="col-lg-2 control-label text-right"></label>
    <div class="col-lg-8">
    <input type="text" class="form-control height_lg" id="patient_name" placeholder="Search Patient name (eg. Salam Sonia) - - - - - - -  min.3 characters" name="patient_name" required>
    <input type="hidden" name="receipt_no" id="receipt_no">
    <input type="hidden" name="tid" value="1">
    </div>
    <button name="name_go" class="btn btn-primary font_18" type="submit">GO</button>
    </div>
    </form>
   </div>
  </div>

  <!-- ROW 3 -->
  <div class="row">
    <div class="form-group">
    <form  action="fd_search_result.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="search_cs">
    <div class="form-control-group">
    <label for="cs_no" class="col-lg-2 control-label text-right" > </label>
    <div class="col-lg-8">
    <input type="text" class="form-control height_lg" id="cs_no" placeholder="Search by CustomerID (eg. 155901) - - - - - - min.4 digits" name="cs_no" required>
    <input type="hidden" name="patient_id" id="patient_id">
    <input type="hidden" name="tid" value="2">
    </div>
    <button name="cs_go" class="btn btn-primary font_18" type="submit">GO</button>
    </div>
    </form>
    </div>
  </div>

  <!-- ROW 4 -->
   <div class="row">
    <div class="form-group">
    <form  action="fd_search_result.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="search_date">     
      <div class="form-control-group">
      <label for="member" class="col-lg-2 control-label" ></label>
      <div class="col-lg-4">
      <input type="text" class="form-control height_lg" id="start_date" name="start" value="<?php echo date('d-m-Y');?>" readonly/>
      </div>
      </div>

       <label for="member" class="control-label" ></label>
      <div class="col-lg-4">
      <input type="text" class="form-control height_lg" id="end_date" name="end" value="<?php echo date('d-m-Y');?>" readonly>
      <input type="hidden" name="tid" value="3">
      </div>

      <button name="date_go" class="btn btn-primary font_18" type="submit">GO</button>
      </form>
      </div>
      </div>

 <!-- ROW 5 -->
  <div class="row">
  <div><h4 align="center" class="blue_color"  style=" margin-bottom:-15px;">
  New Registration <span class="panel-subTitle">( for Registered Customer )</span>
  </h4><hr />
  </div>

  <div class="form-group">
    <form  action="patient_registration_card.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="new_pname">
    <div class="form-control-group">
    <label for="patient_name_new" class="col-lg-2 control-label"></label>
    <div class="col-lg-8">
    <input type="text" class="form-control height_lg" id="patient_name_new" placeholder="Search by Customer name (eg. Salam Sonia) - - - - - - Min.4 character" name="patient_name_new" required>
    <input type="hidden" name="patient_id" id="hname_patient">
    </div>
    <button name="patient_name_new_go" class="btn btn-primary font_18" type="submit">GO</button>
    </div>
    </form>
    </div>
    </div>

  <!-- ROW 6 -->
  <div class="row">
   <div class="form-group">
    <form  action="patient_registration_card.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_cs">
    <div class="form-control-group">
    <label for="new_csid" class="col-lg-2 control-label"></label>
    <div class="col-lg-8">
    <input type="text" class="form-control height_lg" id="new_csid" placeholder="Search by Customer ID ( eg. 155901 ) - - - - - - Min.4 digits" name="new_csid" required>
    <input type="hidden" name="patient_id" id="hcs_patient">
    </div>
    <button name="new_csidgo" class="btn btn-primary font_18" type="submit">GO</button>
    </div>
    </form>
    </div>
  </div>

   </div>
 <div class="clear"></div>
</div>
<?php require_once("footer.php"); ?>
<?php require_once("script_bootstrap_datatable.php"); ?>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	// Pop-up windows
	$('#form_cs, #new_pname').submit(function() {
    window.open('', 'patient_registration_card.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'patient_registration_card.php';
    });

	// AUTOCOMPLETE
		$("#reg_no").autocomplete({
          source:'fd_search_auto_eid.php',
		  minLength:4,
		  scroll: true,
		  change: function (event, ui){
					if (ui.item == null)
					  { $('#reg_no').val("");
					  	$('#reg_no_eid').val("");
						return false; }
				   else
					  { $('#reg_no').val(ui.item.value);
					    $('#reg_no_eid').val(ui.item.receipt_no);
					    return false; } }
		}).focus(function() {
                $(this).autocomplete("search");
            });

		$("#patient_name").autocomplete({
          source:'fd_search_auto_patient_name.php',
		  minLength:3,
		  scroll: true,
		  change: function (event, ui){
					if (ui.item == null)
					  { $('#patient_name').val("");
					  	$('#receipt_no').val("");
						return false; }
				   else
					  { $('#patient_name').val(ui.item.value);
					    $('#receipt_no').val(ui.item.receipt_no);
					    return false; } }
		}).focus(function() {
                $(this).autocomplete("search");
            });


		$("#cs_no").autocomplete({
          source:'fd_search_auto_cs.php',
		  minLength:4,
		  scroll: true,
		  change: function (event, ui){
					if (ui.item == null)
					  { $('#cs_no').val("");
					  	$('#patient_id').val("");
						return false; }
				   else
					  { $('#cs_no').val(ui.item.value);
					    $('#patient_id').val(ui.item.patient_id);
					    return false; } }
		}).focus(function() {
                $(this).autocomplete("search");
            });

		// for new registration only
		$("#new_csid").autocomplete({
          source:'fd_search_auto_name_csid.php',
		  minLength:4,
		  scroll: true,
		  change: function (event, ui){
					if (ui.item == null)
					  { $('#new_csid').val("");
					  	$('#hcs_patient').val("");
						return false; }
				   else
					  { $('#new_csid').val(ui.item.value);
					    $('#hcs_patient').val(ui.item.patient_id);
					    return false; } }
		})

		$("#patient_name_new").autocomplete({
          source:'fd_search_auto_name_new.php',
		  minLength:4,
		  scroll: true,
		  change: function (event, ui){
					if (ui.item == null)
					  { $('#patient_name_new').val("");
					  	$('#hname_patient').val("");
						return false; }
				   else
					  { $('#patient_name_new').val(ui.item.value);
					    $('#hname_patient').val(ui.item.patient_id);
					    return false; } }
		}).focus(function() {
                $(this).autocomplete("search");
            });

$('#close_all').click(function(e) {
       myWindow1 = window.open('', 'patient_registration_card.php');
	   myWindow1.close();
    });

})

$(function () {
            $('#start_date, #end_date').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                },
				 pickTime: false,
				 format: ("DD-MM-YYYY"),

            });
		 });
</script>
  </body>
</html>
<?php ob_flush();?>