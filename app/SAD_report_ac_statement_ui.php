<?php require_once("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '1')
 {
?>
<!DOCTYPE html>
<html>
<title>FD - A/C Statement</title>
 <?php include("css_bootstrap_header.php");?> 
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
<?php require_once("right_top_header_sad.php");?>
<div class="container">
 <div class="page-content">
 
 <?php 
 
if(isset($_GET['submit1']))
    {	  
	$start1 = date("Y-m-d H:i", strtotime($_GET['start1']));
	$stop1 = date("Y-m-d H:i", strtotime($_GET['stop1']));
	header("location:SAD_report_bw_dates_collective.php?start=$start1&stop=$stop1");		
	}


 if(isset($_GET['submit_bwDates_collective']))
    {	  
	$start_date_bw = date("Y-m-d H:i", strtotime($_GET['start_date_bw']));
	$stop_date_bw = date("Y-m-d H:i", strtotime($_GET['stop_date_bw']));
	header("location:SAD_report_bw_dates_collective.php?start=$start_date_bw&stop=$stop_date_bw");		
	}
	
 if(isset($_GET['submit_exp_bw_date']))
    {	  
	$start_date_exp = date("Y-m-d h:i a", strtotime($_GET['start_date_exp']));
	$stop_date_exp = date("Y-m-d h:i a", strtotime($_GET['stop_date_exp']));
	header("location:FD_report_bw_date_expenditure.php?start=$start_date_exp&stop=$stop_date_exp");		
	}
 ?>
 
 <div class="inv-main">        
  <div class="panel panel-success">
  
   <div class="panel-heading" style="color:#0D9707;">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> Front Desk - Account Statement
     <span class="text-right pull-right" style="font-size:14px !important; color: #A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
   </div>                     
                               
<!--<div class="row form-group">     
<label class="control-label" style="width:100%; text-align:center;"><h4 style=" text-decoration:underline; color: #F36;">Front Desk Account Statement with Expenditure</h4></label>
</div>-->
     <div class="panel-body" >
     <div class="row form-group">     
          <label class="control-label" style="width:100%; text-align:center;"><h4 style=" text-decoration:underline; color:#F00;">Account Statement </h4></label>
      </div>
        
   <div class="row form-group">  
      <form>       
        <label for="submit1" class="col-lg-4 control-label text-right"> Select Date :</label>
        <div class="col-lg-2"><input type="text" class="form-control" name="start1" id="start1" value="<?php echo date("d-m-Y", strtotime('-1 days'));?>" readonly/></div>
        <div class="col-lg-2"><input type="text" class="form-control" name="stop1" id="stop1" value="<?php echo date("d-m-Y");?>" readonly/></div> 
		<button type="submit" class="col-lg-1 btn btn-primary" name="submit1">Generate</button>
   </form>
   </div>   
    
    
     <div class="row form-group">  
      <form>       
        <label for="submit_bwDates_collective" class="col-lg-4 control-label text-right"> Select DateTime :</label>
        <div class="col-lg-2"><input type="text" class="form-control" name="start_date_bw" id="start_date_bw" value="<?php echo date("d-m-Y h:i a", strtotime('-1 days'));?>" readonly/></div>
        <div class="col-lg-2"><input type="text" class="form-control" name="stop_date_bw" id="stop_date_bw" value="<?php echo date("d-m-Y h:i a");?>" readonly/></div> 
		<button type="submit" class="col-lg-1 btn btn-primary" name="submit_bwDates_collective">Generate</button>
   </form>
   </div>   

    
     
   <!----------------------------------- Expenditure ------------------------------------------------>  
     <div class="row form-group" style="margin-top:70px;">     
          <label class="control-label" style="width:100%; text-align:center;"><h4 style=" text-decoration:underline; color:#F00;">Expenditure </h4></label>
      </div>
     
     <div class="row form-group">   
        <label for="expenditure" class="col-lg-4 control-label text-right"> Daily Expenditure :</label>
        <a href="FD_expenditure.php"><button type="submit" class="col-lg-5 btn btn-primary" style="font-weight:bold; font-size:15px;"><span style="padding:0px 60px 0px 0px;">Add</span>|<span style="padding:0px 60px 0px 60px;">Edit</span>|<span style="padding:0px 0px 0px 60px;">Delete</button></a>     
      </div>
     
     
     <form>
     <div class="row form-group">         
        <div class="form-control-group">
        <label for="submit_exp_bw_date" class="col-lg-4 control-label text-right"> Select Date :</label>
        <div class="col-lg-2">
        <input type="text" class="form-control" name="start_date_exp" id="start_date_exp" value="<?php echo date("d-m-Y h:i a", strtotime('-1 days'))?>" readonly/></div>
        <div class="col-lg-2">
        <input type="text" class="form-control" name="stop_date_exp" id="stop_date_exp" value="<?php echo date("d-m-Y h:i a");?>" readonly/></div> 
		<button type="submit" class="col-lg-1 btn btn-primary" id="" name="submit_exp_bw_date">Generate</button>
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

$(function () {
            $('#start_date_bw, #stop_date_bw').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down"
                },
				 format: ("DD-MM-YYYY hh:mm a"),
					 			
            });
			
			
			$('#start1, #stop1').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down"
                },
				 format: ("DD-MM-YYYY"),
				 pickTime:false,
					 			
            });
			
		  /* $('#date_collective').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down"
                },
				 format: ("DD-MM-YYYY"),
				 pickTime:false,
					 			
            });*/
			
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
<?php } ob_flush();?>