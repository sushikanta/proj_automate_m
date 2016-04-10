<?php require_once("check_login_super.php"); ?>
<!DOCTYPE html>
<html>
<title>Report <?php echo date("d/m/Y"); ?></title>
 <?php include("css_bootstrap_header.php");?> 
</head>
<body>
<?php require_once("right_top_header_sad.php");?>
<div class="container">
 <div class="page-content"> 
 <div class="inv-main">        
  <div class="panel panel-success">
      <div class="panel-heading light_purple_color">
      <h3 class="panel-title">
      <i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
      Report <span class="panel-subTitle"> ( Monthly, Yearly ) </span>
      <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
      </h3>
      </div>                

     <div class="panel-body" >
     <div class="row form-group">     
          <label class="control-label width_100 blue_color text-center"><h4 style="text-decoration:underline;">Only value (All Registration)</h4></label>
      </div>
        
   <!----------------- First Row --------------->
    
 <div class="row form-group">  
 <form  action="SAD_report_bw_month_year_all.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_1">
   <label class="control-label col-lg-3"></label>
  <div class="col-lg-3">
  <select class="form-control" name="month" required>
          <option value="" class="option_select">-- Select Month --</option>
          <option value="1" class="option_select">January</option>
          <option value="2" class="option_select">February</option>
          <option value="3" class="option_select">March</option>
          <option value="4" class="option_select">April</option>
          <option value="5" class="option_select">May</option>
          <option value="6" class="option_select">June</option>
          <option value="7" class="option_select">July</option>
          <option value="8" class="option_select">August</option>
          <option value="9" class="option_select">September</option>
          <option value="10" class="option_select">October</option>
          <option value="11" class="option_select">November</option>
          <option value="12" class="option_select">December</option>
      </select>
  </div>
  
  <div class="col-lg-3">
	  <input type="text" class="form-control" name="year" id="year1" placeholder="Select a Year" required readonly>  
  </div>
  <input type="hidden" name="type" value="mm"> 
  <button class="btn btn-primary"> GO</button>
  </form>
 </div>

</div>
<div class="clear"></div>
</div>      
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?>
<script>
$(function () {			
  $( "#year1" ).removeClass('hasDatepicker').datepicker({  
		changeMonth: true,
		changeYear: true,
		yearRange: "-3:+1",
		dateFormat: "yy",
		showButtonPanel: true,
		onClose: function(dateText, inst) {
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).val($.datepicker.formatDate('yy', new Date(year, month, 1)));
        }
		}).focus(function() {
  $(".ui-datepicker-prev, .ui-datepicker-next").remove();
  $(".ui-datepicker-calendar, .ui-datepicker-month").hide();
});
			
		 });


$(document).ready(function(){

  // POP UP
  
  $('#form_1').submit(function(){	
     window.open('', 'SAD_report_bw_month_year_all.php', "width=1000,height=550,resizeable,scrollbars");
    this.target = 'SAD_report_bw_month_year_all.php';
    });
  
  
})
</script>

</body>
</html>
<?php ob_flush();?>