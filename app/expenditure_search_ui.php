<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Search</title>
<?php require_once("css_bootstrap_header.php");?> 
<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
<?php require_once("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">
  <div class="inv-main">
  
  <div class="panel panel-success">
  <div class="panel-heading light_purple_color">
    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-lg fa-fw"></i> &nbsp;&nbsp;&nbsp;
    Search  <span class="panel-subTitle"> ( Expenditure )</span>
    <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div>
<div class="panel-body>"
  
 
  <!---------- ROW 1 ---------> 
  <div class="row" style="margin-bottom:300px;">
  
   <div><h4 align="center" class="blue_color italic_font" style="margin-bottom:-20px;">Select Date <span class="panel-subTitle"> ( For edit ) </span> </h4><hr /></div>
    
   <div class="form-group pull-right width_100">
    <form  action="expenditure_result.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_search">      
      <div class="form-control-group">
      <label for="member" class="col-lg-2 control-label" > <i class="fa fa-calendar fa-lg fa-fw"></i> </label>
      <div class="col-lg-4">
      <input type="text" class="form-control" id="start_date" name="start" value="<?php echo date('d-m-Y');?>" readonly/>  
      </div>
      </div>
      
      <div class="form-control-group">
       <label for="member" class="control-label" ></label>
      <div class="col-lg-4">
      <input type="text" class="form-control" id="end_date" name="end" value="<?php echo date('d-m-Y');?>" readonly>      
      </div>   
      
      <input type="hidden" name="tid" value="3">     
      <button name="date_go" id="date_go" class="btn btn-primary" type="submit">GO</button>
      </div>
      </form>      
      </div>      
    </div>   
   </div> 
 <div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap.php"); ?> 
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#form_search').submit(function(){ 
     window.open('', 'expenditure_result.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'expenditure_result.php';
    });

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
 });
</script> 
  </body>
</html>
<?php ob_flush();?>