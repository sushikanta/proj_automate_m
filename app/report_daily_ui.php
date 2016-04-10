<?php include("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '2')
 {
?>
<!DOCTYPE html>
<html>
<title>FD - A/C Statement</title>
  <?php include("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php include("right_top_header_admin.php"); ?>
<div class="container">
 <div class="page-content">
 
 <?php 
 
 if(isset($_GET['submit_1day_collective']))
    {	  
	$date_collective = date("Y-m-d", strtotime($_GET['date_collective']));
	header("location:report_1day_collective.php?today_date=$date_collective");		
	}
	
 if(isset($_GET['submit_bwDates_collective']))
    {	  
	$start_date_bw = date("Y-m-d", strtotime($_GET['start_date_bw']));
	$stop_date_bw = date("Y-m-d", strtotime($_GET['stop_date_bw']));
	header("location:report_bw_dates_collective.php?start=$start_date_bw&stop=$stop_date_bw");		
	}
 
 if(isset($_GET['submit_exp_today']))
    {	  
	$exp_today_date = date("Y-m-d", strtotime($_GET['exp_today_date']));
	header("location:report_today_expenditure.php?today_date=$exp_today_date");		
	}
 
 if(isset($_GET['submit_exp_bw_date']))
    {	  
	$start_date_exp = date("Y-m-d", strtotime($_GET['start_date_exp']));
	$stop_date_exp = date("Y-m-d", strtotime($_GET['stop_date_exp']));
	header("location:report_bw_date_expenditure.php?start=$start_date_exp&stop=$stop_date_exp");		
	}
	
 
 ?>
 
 <div class="inv-main">        
  <div class="panel panel-success">
  
   <div class="panel-heading" style="color:#0D9707;">
     <h3 class="panel-title"><i class="fa fa-square fa-spin fa-fw fa-lg"></i> Expenditure & Account Statement
     <span class="text-right pull-right" style="font-size:14px !important; color: #A400DF;"><i class="fa fa-calendar"></i> <?php echo date("jS F Y (l), h:i A", time());?></span>
     </h3>
   </div>                     
                               
<div class="row form-group">     
<label class="control-label" style="width:100%; text-align:center;"><h4 style=" text-decoration:underline; color: #F36;">Front Desk Account Statement with Expenditure</h4></label>
</div>
     
      <div class="row form-group">   
        <label for="all_expenditure" class="col-lg-5 control-label text-right"> ALL :</label>
        <a href="report_collective_all.php"><button type="submit" class="col-lg-2 btn btn-primary">Generate</button></a>
     </div>
     
    <div class="row form-group">
    <form>   
        <label for="date_collective" class="col-lg-5 control-label text-right"> One day :</label>
        <div class="col-lg-2"><input type="text" class="form-control" name="date_collective" id="date_collective" value="<?php echo date("d-M-Y", time());?>" readonly/></div>
        <button type="submit" class="col-lg-1 btn btn-primary" name="submit_1day_collective" >Generate</button>
        </form>
    </div>
    
    
     <div class="row form-group">  
      <form>       
        <label for="submit_bwDates_collective" class="col-lg-5 control-label text-right"> Between :</label>
        <div class="col-lg-2"><input type="text" class="form-control" name="start_date_bw" id="start_date_bw" value="<?php echo date("d-M-Y", strtotime('-6 days'));?>" readonly/></div>
        <div class="col-lg-2"><input type="text" class="form-control" name="stop_date_bw" id="stop_date_bw" value="<?php echo date("d-M-Y");?>" readonly/></div> 
		<button type="submit" class="col-lg-1 btn btn-primary" name="submit_bwDates_collective">Generate</button>
   </form>
   </div>   
 
 
 <div class="row form-group">     
    <label class="control-label" style="width:100%; text-align:center; margin-top:15px;"><h4 style=" text-decoration:underline; color:#F36;"> Front Desk Expenditure</h4></label>
  </div>
     
     <div class="row form-group">   
        <label for="expenditure" class="col-lg-5 control-label text-right"> Expenditure :</label>
        <a href="expenditure.php"><button type="submit" class="col-lg-2 btn btn-primary">Add&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;Delete</button></a>     
      </div>
       
        
      <div class="row form-group">   
        <label for="all_expenditure" class="col-lg-5 control-label text-right"> ALL :</label>
        <a href="report_all_expenditure.php"><button type="submit" class="col-lg-2 btn btn-primary">Generate</button></a>
     </div>
     
     <div class="row form-group"> 
      <form> 
      <div class="form-control-group"> 
        <label for="exp_today_date" class="col-lg-5 control-label text-right">
		 One day :</label>
        <div class="col-lg-2"><input type="text" class="form-control" name="exp_today_date" id="exp_today_date" 
        value="<?php echo date("d-M-Y", time());?>" readonly/>
        </div>
        <button type="submit" class="col-lg-1 btn btn-primary" name="submit_exp_today">Generate</button>
       </form>
       </div>
      </div>
        
    <form>
     <div class="row form-group">         
        <div class="form-control-group">
        <label for="submit_exp_bw_date" class="col-lg-5 control-label text-right"> Between :</label>
        <div class="col-lg-2"><input type="text" class="form-control" name="start_date_exp" id="start_date_exp" value="<?php echo date("d-M-Y", strtotime('-6 days'));?>" readonly/></div>
        <div class="col-lg-2"><input type="text" class="form-control" name="stop_date_exp" id="stop_date_exp" value="<?php echo date("d-M-Y");?>" readonly/></div> 
		<button type="submit" class="col-lg-1 btn btn-primary" id="" name="submit_exp_bw_date">Generate</button>
       </div>
   </form>
</div>	
        
</div>
<div class="clear"></div>
</div>

      
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ob_flush();?>
<script>

$("#exp_today_date, #start_date_exp, #stop_date_exp, #date_collective, #start_date_bw, #stop_date_bw" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
changeMonth: true,
changeYear: true,
yearRange: "-1:+0", // Setting yearRange of 120 years ago
dateFormat: "dd-M-yy",
});

</script>

 
</body>
</html>
<?php } ?>