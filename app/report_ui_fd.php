<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
<title>Report</title>
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
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Generate <span class="panel-subTitle"> ( Report ) </s style="min-height: 500px;"pan>

     <button id="close_all" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-reorder fa-lg"></i> Reset&nbsp;</button>

     <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>

     </h3>
   </div>
<div class="panel-body" style="min-height: 400px;">
   <!---------- ROW 1 - A/C STATEMENT -------->
  <div class="row">
   <!-- <div><h4 align="center" class="color_google" style="margin-bottom:-20px;">Account Statement </h4><hr /></div> -->
    <form  action="account_statement_fd.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_ac">
    <div class="form-group">
    <div class="form-control-group">
    <label for="reg_no" class="col-lg-3 control-label">Account Statement</label>
    <div class="col-lg-3">
    <input type="text" class="form-control" name="start" id="start1" value="<?php echo date("d-m-Y h:i a", strtotime('-1 days'));?>" readonly/>
    </div>
    <div class="col-lg-3">
    <input type="text" class="form-control" name="stop" id="stop1" value="<?php echo date("d-m-Y h:i a");?>" readonly/>
    </div>
    <button name="eid_go" class="btn btn-primary" type="submit">GO</button>
    </div>
    </div>
    </form>
  </div>

     <!---------- ROW 2 - EXPENDITURE -------->
  <div class="row">
  <!--  <div><h4 align="center" class="color_google" style="margin-bottom:-20px;">Expenditure </h4><hr /></div> -->
    <form action="expenditure_report_fd.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_ex">
    <div class="form-group">
    <div class="form-control-group">
    <label for="reg_no" class="col-lg-3 control-label">Expense</label>
    <div class="col-lg-3">
    <input type="text" class="form-control" name="start" id="start2" value="<?php echo date("d-m-Y h:i a", strtotime('-1 days'));?>" readonly/>
    </div>

    <div class="col-lg-3">
    <input type="text" class="form-control" name="stop" id="stop2" value="<?php echo date("d-m-Y h:i a");?>" readonly/>
    </div>
    <button name="eid_go" class="btn btn-primary" type="submit">GO</button>
    </div>
    </div>
    </form>
    </div>

   <!------- SOURCE  ------>
   <div class="row">
   <div><h4 align="center" class="blue_color" style="margin-bottom:-20px;">Collection Record</h4><hr /></div>


 <!------------ ROW 3 SOURCE - REFERRALS ---------------->
    <div class="row">
    <form  action="collection_report_source_person.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_other">
    <div class="form-group">
    <div class="form-control-group">
    <label for="referred_by" class="col-lg-2 control-label"></label>
    <div class="col-lg-3">
    <input type="text" class="form-control" name="referred_by" id="referred_by" placeholder="Search & Select Other Source Person"/>
    <input type="hidden" name="ref_id" id="hidden_referred_by"/>
    <input type="hidden" name="src_id" id="hidden_source_id"/>


    </div>
    <div class="col-lg-2">
    <input type="text" class="form-control" name="start" id="start6" value="<?php echo date("d-m-Y", strtotime('-1 days'));?>" readonly/>
    </div>

    <div class="col-lg-2">
    <input type="text" class="form-control" name="stop" id="stop6" value="<?php echo date("d-m-Y");?>" readonly/>
    </div>
    <button name="eid_go" class="btn btn-primary" type="submit">GO</button>
    </div>
    </div>
    </form>
    </div>


   <!------------ ROW 3 SOURCE ALL ---------------->
    <div class="row">
    <form  action="collection_report_source.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_walkin">
    <div class="form-group">
    <div class="form-control-group">
    <label for="source_id" class="col-lg-2 control-label"></label>
    <div class="col-lg-3">
   <select class="form-control" name="source_id" required>
    <option value="" class="option_select">Select Source - All </option>
    <?php $result_src = mysqli_query($con, "SELECT source_id, source_name FROM source_tbl ORDER BY source_name ASC");
    while($row4 = mysqli_fetch_array($result_src)) { ?>
    <option value="<?php echo $row4['source_id']; ?>" class="option_select"> <?php echo $row4['source_name']; ?> </option>
    <?php }?>
    </select>
    </div>
    <div class="col-lg-2">
    <input type="text" class="form-control" name="start" id="start4" value="<?php echo date("d-m-Y", strtotime('-1 days'));?>" readonly/>
    </div>

    <div class="col-lg-2">
    <input type="text" class="form-control" name="stop" id="stop4" value="<?php echo date("d-m-Y");?>" readonly/>
    </div>
    <button name="walkin_go" class="btn btn-primary" type="submit">GO</button>
    </div>
    </div>
    </form>

   <!------------ ROW 4 SOURCE - STAFF ---------------->
    <form  action="collection_report_source_person.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_sfaff">
    <div class="form-group">
    <div class="form-control-group">
    <label for="staff" class="col-lg-2 control-label"></label>
    <div class="col-lg-3">

     <input type="text" class="form-control" name="staff" id="staff" placeholder="Search & Select Staff (Employee)"/>
    <input type="hidden" name="ref_id" id="staff_referred_by"/>
    <input type="hidden" name="src_id" id="staff_referred_by"/>



    </div>
    <div class="col-lg-2">
    <input type="text" class="form-control" name="start" id="start5" value="<?php echo date("d-m-Y", strtotime('-1 days'));?>" readonly/>
    </div>

    <div class="col-lg-2">
    <input type="text" class="form-control" name="stop" id="stop5" value="<?php echo date("d-m-Y");?>" readonly/>
    <!--<input type="hidden" name="tid" value="1">-->
    </div>
    <button name="eid_go" class="btn btn-primary" type="submit">GO</button>
    </div>
    </div>
    </form>
    </div>



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
$('#form_ac').submit(function(){
     window.open('', 'account_statement_fd.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'account_statement_fd.php';
    });
$('#form_ex').submit(function(){
    window.open('', 'expenditure_report_fd.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'expenditure_report_fd.php';
    });
$('#form_walkin').submit(function(){
    window.open('', 'collection_report_source.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'collection_report_source.php';
    });
$('#form_sfaff, #form_other').submit(function(){
    window.open('', 'collection_report_source_person.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'collection_report_source_person.php';
    });


$('#close_all').click(function(e) {
       myWindow1 = window.open('', 'account_statement_fd.php');
	   myWindow1.close();
	   myWindow2 = window.open('', 'expenditure_report_fd.php');
	   myWindow2.close();
	   myWindow3 = window.open('', 'collection_report_source.php');
	   myWindow3.close();
	   myWindow4 = window.open('', 'collection_report_source_person.php');
	   myWindow4.close();
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
