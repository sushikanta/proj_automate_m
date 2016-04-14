<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html>
<html>
<title>Trace</title>
 <?php include("css_bootstrap_header.php");?>
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
<?php require_once("right_top_header.php");?>
<div class="container">
 <div class="page-content">

 <div class="inv-main">
  <div class="panel panel-success">

   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Trace <span class="panel-subTitle"> ( Activities ) </span>

     <button id="close_all" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-reorder fa-lg"></i> Reset&nbsp;</button>

     <!-- <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span> -->

     </h3>
   </div>


  <!-- ROW 1 -->
  <div class="row">
   <div><h4 align="center" class="blue_color" style="margin-bottom:-15px;"> Existing Registration</h4><hr /></div>

    <form  action="trace_result_reg.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_reg">
    <div class="form-group">
    <div class="form-control-group">
    <label for="reg_no" class="col-lg-2 control-label"></label>
    <div class="col-lg-7">
    <input type="text" class="form-control" id="receipt" placeholder="Search by Registration number (eg. 1550910) - - - - - - min.4 digits" name="receipt">
    </div>
    <input type="hidden" id="receipt_no" name="receipt_no" />
    <button name="trace_reg" class="btn btn-primary" type="submit">GO</button>
    </div>
    </div>
    </form>
  </div>

  <!-- ROW 2 -->
  <div class="row">
   <div><h4 align="center" class="blue_color" style="margin-bottom:-15px;"> Custom Date</h4><hr /></div>

    <form  action="trace_result_date.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_date">
    <div class="form-group">
    <div class="form-control-group">
    <label for="reg_no" class="col-lg-2 control-label"></label>
    <div class="col-lg-3">
    <input type="text" class="form-control" name="start" id="start1" value="<?php echo date("d-m-Y h:i a", strtotime('-1 days'));?>" readonly/>
    </div>
    <div class="col-lg-4">
    <input type="text" class="form-control" name="stop" id="stop1" value="<?php echo date("d-m-Y h:i a");?>" readonly/>
    </div>
    <button name="trace_date" class="btn btn-primary" type="submit">GO</button>
    </div>
    </div>
    </form>
  </div>

   <!-- ROW 3 - LOGIN USERS -->
   <div class="row">
   <div><h4 align="center" class="blue_color" style="margin-bottom:-15px;"> LoginID (Username)</h4><hr /></div>
    <form  action="trace_result_user.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_user">
    <div class="form-group">
    <div class="form-control-group">
    <label for="username" class="col-lg-2 control-label"></label>
    <div class="col-lg-3">
     <input type="text" class="form-control" name="username" id="username" placeholder="Search Username & Select" required/>
    <input type="hidden" name="user_id" id="user_id"/>
    </div>
    <div class="col-lg-2">
    <input type="text" class="form-control" name="start" id="start2" value="<?php echo date("d-m-Y");?>" readonly/>
    </div>

    <div class="col-lg-2">
    <input type="text" class="form-control" name="stop" id="stop2" value="<?php echo date("d-m-Y");?>" readonly/>
    </div>
    <button name="trace_user" class="btn btn-primary" type="submit">GO</button>
    </div>
    </div>
    </form>
    </div>

 </div>


<div class="clear"></div>
</div>
<?php include("footer.php"); ?>
<?php include("script_bootstrap.php"); ?>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script>
$(document).ready(function(){
$('#form_reg').submit(function(){
     window.open('', 'trace_result_reg.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'trace_result_reg.php';
    });
$('#form_date').submit(function(){
    window.open('', 'trace_result_date.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'trace_result_date.php';
    });
$('#form_user').submit(function(){
    window.open('', 'trace_result_user.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'trace_result_user.php';
    });

$('#close_all').click(function(e) {
     myWindow1 = window.open('', 'trace_result_reg.php');
	   myWindow1.close();
	   myWindow2 = window.open('', 'trace_result_date.php');
	   myWindow2.close();
	   myWindow3 = window.open('', 'trace_result_user.php');
	   myWindow3.close();
    });

 $("#receipt").autocomplete({
				source: "fd_search_auto_eid.php",
				minLength:4,
				scroll:true,
				change: function (event, ui){
				          if (ui.item == null)
						     {
							    $("#receipt").val("");
                    ("#receipt_no").val("");
							    return false;}
					     else
					         { $("#receipt").val(ui.item.value);
                    $("#receipt_no").val(ui.item.receipt_no);
							   return false;} },
				  });

 $("#username").autocomplete({
				source: "autocomplete_username.php",
				minLength:3,
				scroll:true,
				change: function (event, ui){
				          if (ui.item == null)
						     {
							    $("#username").val("");
							    $('#user_id').val("");
							    return false;}
					     else
					         { $("#username").val(ui.item.value);
							   $('#user_id').val(ui.item.user_id);

							   return false;} },
				  })

 });

$(function(){
            $('#start1, #stop1').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down"
                },
				 format: ("DD-MM-YYYY hh:mm a"),

            });

		  $('#start2, #stop2').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down"
                },
				 format: ("DD-MM-YYYY"),
				 pickTime:false,

            });
		 });


</script>
</body>
</html>
<?php ob_flush();?>
