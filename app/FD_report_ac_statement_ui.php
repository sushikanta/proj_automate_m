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
<title>FD - A/C Statement</title>
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
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> FD - <span class="panel-subTitle"> Report Generate</span>
   	 <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
   </div>
   
   
   <!-------------------- Account STatement ---------------------------->
     <form action="FD_report_bw_dates_collective.php" target="_blank">
     <div class="row form-group">     
     <label class="control-label" style="width:100%; text-align:center;"><h4 style=" text-decoration:underline; color:#F00;">Account Statement </h4></label>
      </div>
    
     <div class="row form-group">     
      <label for="submit_bwDates_collective" class="col-lg-2 control-label text-right"> Select Date :</label>
      <div class="col-lg-4">
      <input type="text" class="form-control" name="start" id="start3" value="<?php echo date("d-m-Y h:i a", strtotime('-1 days'));?>" readonly/>
      </div>
      <div class="col-lg-4">
      <input type="text" class="form-control" name="stop" id="stop3" value="<?php echo date("d-m-Y h:i a");?>" readonly/>
      </div> 
		<button type="submit" class="col-lg-1 btn btn-primary" name="submit_bwDates_collective">Generate</button>
	</div>	
   </form>
      
   <!----------------------------------- Expenditure ------------------------------------------------>  
   <div class="row form-group">     
          <label class="control-label" style="width:100%; text-align:center;"><h4 style=" text-decoration:underline; color:#F00;">Expenditure </h4></label>
      </div>
      
      <form action="FD_report_bw_date_expenditure.php" target="_blank">
     <div class="row form-group">         
        <label for="submit_exp_bw_date" class="col-lg-2 control-label text-right"> Select Date :</label>
        <div class="col-lg-4">
        <input type="text" class="form-control" name="start" id="start_date_exp" value="<?php echo date("d-m-Y h:i a", strtotime('-1 days'))?>" readonly/></div>
        <div class="col-lg-4">
        <input type="text" class="form-control" name="stop" id="stop_date_exp" value="<?php echo date("d-m-Y h:i a");?>" readonly/>
        </div> 
		<button type="submit" class="col-lg-1 btn btn-primary">Generate</button>
       </div>
      
   </form>
     
     <div class="row form-group">        
     <div class="col-lg-offset-4 col-lg-4">
     <button class="btn btn-primary btn-block" style="font-size:16px;" id="patient_submit" onclick="window.open('FD_expenditure.php');">Daily Expenditure : Add | Edit | Delete</button>
    </div>
    </div>
        
      
   <!-------------------- FIRST ROW ---------------------------->     
    <form action="payment_source_name_all_ui.php" target="_blank">
    <div class="row form-group">     
    <label class="control-label" style="width:100%; text-align:center;"><h4 style=" text-decoration:underline; color:#F00;">Source Report </h4></label>
    </div>
    
    <div class="row form-group">      
    <label class="col-lg-2 control-label text-right"> All Sources :</label>
    <div class="col-lg-4">
    <input class="form-control" type="text" class="form-control" placeholder="All Sources without Staff and Walkin" readonly/>        
    </div>
    <div class="col-lg-2">
    <input type="text" class="form-control" name="start" id="start1" value="<?php echo date("d-m-Y", strtotime('-1 days'));?>" readonly/></div>
    <div class="col-lg-2">
    <input type="text" class="form-control" name="stop" id="stop1" value="<?php echo date("d-m-Y");?>" readonly/></div>
    <button type="submit" class="col-lg-1 btn btn-primary">Generate </button>
    </div>
    </form>

    <!-------------------- Second Row ---------------------------->    
    <form action="payment_each_source_name_bw.php" target="_blank">
    <div class="row form-group">      
    <label for="submit_rf" class="col-lg-2 control-label text-right"> Source Name :</label>
    <div class="col-lg-4">
    <select class="form-control" name="ref" id="ref" required>
    <option value="" class="option_select">Select Source Except Staff or Walkin</option>
    <?php $result_name = mysqli_query($con, "SELECT referred_tbl.referred_id, referred_tbl.referred_name, source_btl.source_name FROM referred_tbl LEFT JOIN source_btl ON source_btl.source_id = referred_tbl.source_id ORDER BY referred_tbl.referred_name ASC");
    while($row1 = mysqli_fetch_array($result_name)) { ?>
    <option value="<?php echo $row1['referred_id']; ?>" class="option_select"> 
    <?php echo $row1['referred_name']; ?> (<?php echo $row1['source_name']; ?>)
    </option>
    <?php }?>
    </select>
    
    </div>
    <div class="col-lg-2"><input type="text" class="form-control" name="start" id="start2" value="<?php echo date("d-m-Y", strtotime('-1 days'));?>" readonly/></div>
    <div class="col-lg-2"><input type="text" class="form-control" name="stop" id="stop2" value="<?php echo date("d-m-Y");?>" readonly/></div> 
    
    <button class="col-lg-1 btn btn-primary"> Generate </button>
    
    </div>
	</form>
    
    <!-------------------- Dues Report ---------------------------->
     
     <div class="row form-group">        
     <div class="col-lg-offset-4 col-lg-4">
     <button class="btn btn-primary btn-block" style="font-size:16px;" onclick="window.open('FD_report_dues_ui.php');">Generate - All Dues Report</button>
    </div>
    </div>
    
<div class="clear"></div>
</div>      
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script>
$(function () {
            $('#start3, #stop3').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down"
                },
				 format: ("DD-MM-YYYY hh:mm a"),
					 			
            });
			
		  $('#start1, #stop1, #start2, #stop2').datetimepicker({
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
<?php } ob_flush();?>