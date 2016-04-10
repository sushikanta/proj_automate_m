<?php require_once("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '3')
 {
?>
<!DOCTYPE html>
<html>
<title>FD - Expenditure</title>
  <?php include("css_bootstrap_header.php");?> 
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
<?php require_once("right_top_header.php");?>
<div class="container">
 <div class="page-content">
 
 <?php
 
 if(isset($_GET['submit_exp_today']))
    {	  
	$exp_today_date = date("Y-m-d", strtotime($_GET['exp_today_date']));
	header("location:FD_report_1day_expenditure.php?today_date=$exp_today_date");		
	}
 
 if(isset($_GET['submit_exp_bw_date']))
    {	  
	$start_date_exp = date("Y-m-d h:i a", strtotime($_GET['start_date_exp']));
	$stop_date_exp = date("Y-m-d h:i a", strtotime($_GET['stop_date_exp']));
	header("location:FD_report_bw_date_expenditure.php?start=$start_date_exp&stop=$stop_date_exp");		
	}

/*if(isset($_GET['submit_cut']))
    {	  
	$start_date_exp = date("Y-m-d H:i", strtotime($_GET['start_date_exp']));
	$stop_date_exp = date("Y-m-d H:i", strtotime($_GET['stop_date_exp']));
	header("location:AD_cut.php?start=$start_date_exp&stop=$stop_date_exp");		
	}
	*/
 
 ?>
 
 <div class="inv-main">        
  <div class="panel panel-success">
  
   <div class="panel-heading" style="color:#0D9707;">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> Front Desk - Expenditure
     <span class="text-right pull-right" style="font-size:14px !important; color: #A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
   </div>                     
                               

 <!--<div class="row form-group">     
    <label class="control-label" style="width:100%; text-align:center; margin-top:15px;"><h4 style=" text-decoration:underline; color:#F36;"> Front Desk Expenditure</h4></label>
  </div>-->
 
  <div class="panel-body" style="margin:50px; 0px;">
     
     <div class="row form-group"> 
      <form> 
      <div class="form-control-group"> 
        <label for="exp_today_date" class="col-lg-6 control-label text-right"> One day Expenditure :</label>
    <div class="col-lg-2"><input type="text" class="form-control" name="exp_today_date" id="exp_today_date" value="<?php echo date("d-m-Y");?>" readonly/>
        </div>
        <button type="submit" class="col-lg-1 btn btn-primary" name="submit_exp_today">Generate</button>
       </form>
       </div>
      </div>
        
    <form>
     <div class="row form-group">         
        <div class="form-control-group">
        <label for="submit_exp_bw_date" class="col-lg-4 control-label text-right"> Between :</label>
        <div class="col-lg-2">
        <input type="text" class="form-control" name="start_date_exp" id="start_date_exp" value="<?php echo date("d-m-Y h:i a", strtotime('-1 days'))?>" readonly/></div>
        <div class="col-lg-2">
        <input type="text" class="form-control" name="stop_date_exp" id="stop_date_exp" value="<?php echo date("d-m-Y h:i a");?>" readonly/></div> 
		<button type="submit" class="col-lg-1 btn btn-primary" id="" name="submit_exp_bw_date">Generate</button>
       </div>
   </form>
</div>	
     
     
   <div class="row form-group">   
        <label for="expenditure" class="col-lg-4 control-label text-right"> Daily Expenditure :</label>
        <a href="FD_expenditure.php"><button type="submit" class="col-lg-5 btn btn-primary">Add&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;Delete</button></a>     
      </div>
       
        
      <div class="row form-group">   
        <label for="all_expenditure" class="col-lg-4 control-label text-right"> ALL Expenditures :</label>
        <a href="FD_report_all_expenditure.php"><button type="submit" class="col-lg-5 btn btn-primary">Generate</button></a>
     </div>
     
        
 <!--<form>
     <div class="row form-group">         
        <div class="form-control-group">
        <label for="submit_exp_bw_date" class="col-lg-4 control-label text-right"> Between FOR cut :</label>
        <div class="col-lg-2">
        <input type="text" class="form-control" name="start_date_exp" id="start_date_exp" value="<?php echo date("d-m-Y h:i a", strtotime('-1 days'))?>" readonly/></div>
        <div class="col-lg-2">
        <input type="text" class="form-control" name="stop_date_exp" id="stop_date_exp" value="<?php echo date("d-m-Y h:i a");?>" readonly/></div> 
		<button type="submit" class="col-lg-1 btn btn-primary" id="" name="submit_cut">Generate</button>
       </div>
</div>	
  </form>-->


</div>
<div class="clear"></div>
</div>

      
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?>
<script src="js/bootstrap-datetimepicker.min.js"></script>

<script>

 $(function () {
            $('#start_date_exp, #stop_date_exp').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down"
                },
				 format: ("DD-MM-YYYY hh:mm a"),
            });
			
			 $('#exp_today_date').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down"
                },
				 format: ("DD-MM-YYYY"),
				 pickTime: false,
            });
			
			
		 });
</script>

 
</body>
</html>
<?php } ob_flush();?>