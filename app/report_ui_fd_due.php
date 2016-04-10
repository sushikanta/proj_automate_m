<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
<title>Due</title>
 <?php include("css_bootstrap_header.php");?>
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
<?php require_once("right_top_header.php");?>
<div class="container">
 <div class="page-content">

 <?php
 if(isset($_GET['submit_exp_bw_date']))
    {
	$start_date_exp = date("Y-m-d h:i a", strtotime($_GET['start_date_exp']));
	$stop_date_exp = date("Y-m-d h:i a", strtotime($_GET['stop_date_exp']));
	header("location:FD_report_bw_date_expenditure.php?start=$start_date_exp&stop=$stop_date_exp");
	}
 ?>

 <div class="inv-main">
  <div class="panel panel-success">

   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Generate <span class="panel-subTitle"> ( Due Report ) </span>

     <button id="close_all" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-reorder fa-lg"></i> Reset&nbsp;</button>

     <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>

     </h3>
   </div>

   <div class="panel-body" style="min-height: 400px;">

   <!------- SOURCE  ------>
   <div class="row padding_top30">
 <!--   <div><h4 align="center" class="color_google" style="margin-bottom:-20px;">Source </h4><hr /></div> -->

    <!------------ ROW 3 SOURCE - REFERRALS ---------------->
    <div class="row">
    <form  action="FD_report_balance_sheet_each.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_other">
    <div class="form-group">
    <div class="form-control-group">
    <label for="referred_by" class="col-lg-3 control-label"></label>
    <div class="col-lg-6">
    <input type="text" class="form-control height_lg" name="referred_by" id="referred_by" placeholder="Search & Select Source Person"/>
    <input type="hidden" name="ref_id" id="hidden_referred_by"/>
    <input type="hidden" name="src_id" id="hidden_source_id"/>
    <input type="hidden" name="type" value="22">
    </div>

    <button name="name_go" class="btn btn-primary font_18" type="submit">GO</button>
    </div>
    </div>
    </form>
    </div>


<!---------- ROW 6 - Source Type -------->
<div class="row padding_top50">
   <div class="col-lg-offset-4 col-lg-4">
    <form  action="FD_report_dues_ui.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_summary">
    <div class="form-group">
    <div class="form-control-group">
    <button type="submit" class="btn btn-primary btn-block" style="font-size:16px;">Dues Summary</button>
    </div>
    </div>
    </form>
    </div>
</div>
<div class="row">
     <div class="col-lg-offset-4 col-lg-4">
    <form  action="FD_report_balance_sheet_all.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_all">
    <div class="form-group">
    <div class="form-control-group">
    <input type="hidden" name="type" value="11">
    <button type="submit" class="btn btn-primary btn-block" style="font-size:16px;">All Dues</button>
    </div>
    </div>
    </form>
    </div>

     </div>

 </div>


<div class="clear"></div>
</div>
<?php include("footer.php"); ?>
<?php include("script_bootstrap.php"); ?>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script>
$(document).ready(function(){
$('#form_other').submit(function(){
    window.open('', 'FD_report_balance_sheet_each.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'FD_report_balance_sheet_each.php';
    });

$('#form_all').submit(function(){
    window.open('', 'FD_report_balance_sheet_all.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'FD_report_balance_sheet_all.php';
    });


$('#close_all').click(function(e) {
       myWindow1 = window.open('', 'FD_report_balance_sheet_each.php');
	   myWindow1.close();
	   myWindow2 = window.open('', 'FD_report_balance_sheet_all.php');
	   myWindow2.close();
        myWindow3 = window.open('', 'FD_report_dues_ui.php');
       myWindow3.close();
    });



 $("#referred_by").autocomplete({
				source: "autocomplete_reffered_by.php",
				minLength:0,
				scroll:true,
				change: function (event, ui){
				          if (ui.item == null)
						     {
							    $("#referred_by").val("");
							    $('#hidden_referred_by').val("");
								$('#hidden_source_id').val("");
							    return false;}
					     else
					         { $("#referred_by").val(ui.item.value);
							   $('#hidden_referred_by').val(ui.item.referred_id);
							   $('#hidden_source_id').val(ui.item.source_id);
							   return false;} },
				  }).focus(function() {
                $(this).autocomplete("search");
            });
 $("#staff").autocomplete({
				source: "autocomplete_staff.php",
				minLength:0,
				scroll:true,
				change: function (event, ui){
				          if (ui.item == null)
						     {
							    $("#staff").val("");
							    $('#staff_referred_by').val("");
								$('#staff_source_id').val("");
							    return false;}
					     else
					         { $("#staff").val(ui.item.value);
							   $('#staff_referred_by').val(ui.item.referred_id);
							   $('#staff_source_id').val(ui.item.source_id);
							   return false;} },
				  }).focus(function() {
                $(this).autocomplete("search");
            });

 });

$(function(){
            $('#start1, #stop1, #start2, #stop2').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down"
                },
				 format: ("DD-MM-YYYY hh:mm a"),

            });

		  $('#start3, #stop3, #start4, #stop4, #start5, #stop5, #start6, #stop6').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down"
                },
				 format: ("DD-MM-YYYY"),
				 pickTime:false,

            });

			$('#start_date_exp, #stop_date_exp').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down"
                },
				 format: ("DD-MM-YYYY hh:mm a"),
            });




		 });


</script>
</body>
</html>
<?php ob_flush();?>
