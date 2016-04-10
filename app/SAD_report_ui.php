<?php require_once("check_login_super.php"); ?>
<!DOCTYPE html>
<html>
<title>Report <?php echo date("d/m/Y"); ?></title>
 <?php include("css_bootstrap_header.php");?> 
  <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
<?php require_once("right_top_header_sad.php");?>
<div class="container">
 <div class="page-content"> 
 <?php
	
 if(isset($_GET['go2']))
    {	  
	$start2 = date("Y-m-d", strtotime($_GET['start']));
	$stop2 = date("Y-m-d", strtotime($_GET['stop']));
	
	if($_GET['source'] == '1' && $_GET['select_dr'] =='0')
	  {
	  header("location:SAD_report_bw_allDr.php?start=$start2&stop=$stop2");
	  }
	 
	 if($_GET['source'] == '1' && $_GET['select_dr'] !='0')
	  {
	  $dr_id = $_GET['select_dr'];
	  header("location:SAD_report_bw_dates_detail.php?start=$start2&stop=$stop2&src=1&ref=$dr_id");
	  }
	  
	 if($_GET['source'] == '2' && $_GET['select_others'] =='0')
	  {
	  header("location:SAD_report_bw_allOthers.php?start=$start2&stop=$stop2");
	  }
	 
	if($_GET['source'] == '2' && $_GET['select_others'] !='0')
	  {
	  $ref = $_GET['select_others'];
	  header("location:SAD_report_bw_dates_othersDetail.php?start=$start2&stop=$stop2&src=1&ref=$ref");
	  }
	}
 ?>
 
 <div class="inv-main">        
  <div class="panel panel-success" style="min-height:500px;">
      <div class="panel-heading light_purple_color">
      <h3 class="panel-title">
      <i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
      Report <span class="panel-subTitle"> ( EDs - No Discount, No Dues ) </span>
      <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
      </h3>
      </div>                 
                               
  <div class="panel-body">   
     
  <!---------- ROW 1  ---------> 
  <div class="row" style="padding-top:30px;">
    <form  action="SAD_report_bw_dates_all.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_1">
    <div class="form-group">
    <div class="form-control-group">
    <label for="reg_no" class="col-lg-2 control-label"></label>
    <div class="col-lg-3">
    <input type="text" class="form-control" name="start" id="start1" value="<?php echo date("d-m-Y", strtotime('-14 days'));?>" readonly/>
    </div>
    <div class="col-lg-3">
    <input type="text" class="form-control" name="stop" id="stop1" value="<?php echo date("d-m-Y");?>" readonly/>
    </div>
    <button name="go1" class="btn btn-primary" type="submit">GO</button>
    </div>
    </div>
    </form>      
  </div>
  
  
  <!---------- ROW 2  ---------> 
  <div class="row" style="padding-top:30px;">
    <form  action="#"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="form_2">
    
    
    <div class="form-group">
    <div class="form-control-group">
    <label for="source" class="col-lg-2 control-label"></label>
     <div class="col-lg-3">
        <select class="form-control" id="source" name="source" required>
          <option value=''>Select Source</option>
          <option value='1'> Doctor</option>
          <option value='2'> Others ( Other than Staff )</option>
        </select>
     </div> 
     </div>
  
  <div class="form-control-group">
  <div class="col-lg-3" id="div_dr">
  <select class="form-control" id="select_dr" name="select_dr">
    <option value="" class="option_select">Select Doctor</option>
    <option value='0' class="option_select">ALL Doctors</option>
   <?php 
	$result_dr = mysqli_query($con, "SELECT dr_id, dr_name FROM dr_info ORDER BY dr_name ASC");
    while($dr = mysqli_fetch_array($result_dr)) {
	?>
      <option value="<?php echo $dr['dr_id']; ?>" class="option_select"><?php echo $dr['dr_name']; ?></option>          
    <?php
	  }
	?>
</select> 
  </div> 
  </div>
  
<div class="form-control-group">
  <div class="col-lg-3" id="div_others">
  <input style="display:none;" type="hidden" id="hidden_input"></input>
  <select class="form-control" id="select_others" name="select_others">
   <option value="" class="option_select">Select Name</option>
   <option value='0' class="option_select">ALL</option>
   <!--<?php 
	$result_others = mysqli_query($con, "SELECT referred_id, referred_name FROM referred_tbl");
    while($other = mysqli_fetch_array($result_others)) {
	?>
      <option value='<?php echo $other['referred_id'];?>'><?php echo $other['referred_name'];?></option>          
    <?php
	  }
	?>-->
</select> 
  </div>
  </div>
  </div>
  
  <div class="form-group">    
    <div class="form-control-group">
    <label for="reg_no" class="col-lg-2 control-label"></label>
    <div class="col-lg-3">
    <input type="text" class="form-control" name="start" id="start2" value="<?php echo date("d-m-Y", strtotime('-14 days'));?>" readonly/>
    </div>
    </div>
    
    <div class="form-control-group">
    <div class="col-lg-3">
    <input type="text" class="form-control" name="stop" id="stop2" value="<?php echo date("d-m-Y");?>" readonly/>
    </div>
    </div>

    
    <button name="go2" class="btn btn-primary" type="submit">GO</button>
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
$(function () {
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
		 });


$(document).ready(function(){
/*----- Select Options in Add New ----------*/
 if ($('#source option:eq(0)').prop('selected'))
      { /*$('#div_dr, #div_staff, #div_others').prop('disabled', true); */
	  	$('#div_dr, #div_staff, #div_others').hide();	
	  }
 if ($('#source option:eq(1)').prop('selected'))
      { /*$('#div_dr, #div_staff, #div_others').prop('disabled', true); */
	  	$('#div_staff, #div_others').hide();	
		$('#div_dr').show();	
	  }
 /* else{ $('#level_wise, #user_role').prop('disabled', false); }*/
  
  //On change function 	   
$('#source').change(function() {	

 if ($('#source option:eq(0)').prop('selected'))
      { 
	  	$('#div_dr, #div_staff, #div_others').hide();	
	  }
 else if ($('#source option:eq(1)').prop('selected')) //doctor
      { 
	  	$('#div_dr').show();
		$('#div_staff, #div_others').hide();
		document.getElementById("select_dr").required = true;	
		document.getElementById("select_others").required = false;	
			
	  }
 else
      { /*$('#div_dr, #div_staff, #div_others').prop('disabled', true); */
	  	$('#div_others').show();
		$('#div_dr, #div_staff').hide();
		document.getElementById("select_dr").required = false;	
		document.getElementById("select_others").required = true;
	  }
})
  
  // POP UP
  
  $('#form_1').submit(function(){	
     window.open('', 'SAD_report_bw_dates_all.php', "width=1000,height=550,resizeable,scrollbars");
    this.target = 'SAD_report_bw_dates_all.php';
    });
  
  
})
</script>
</body>
</html>
<?php ob_flush();?>