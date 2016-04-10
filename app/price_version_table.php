<?php include("function.php");
session_start();
if(!isset($_SESSION['status'])){
	header("location: index.php"); 
	exit;	
	}
elseif(isset($_SESSION['user_dept_id']) && $_SESSION['user_dept_id'] == '2')
 {
?>
<!DOCTYPE html>
<html>
  <head>
  <title>Admin - Price Version</title>
  <?php include("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php include("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">
   <div class="inv-main">
        
<?php 
if(isset($_GET['submit'])){
	
	$current_verison_id = $_GET['current_verison_id'];
	$new_version = $_GET['new_version'];
	$remark = $_GET['remark'];
	
	
	//Backup- price, testname. version to price_dump table before updating/adding others
	mysqli_query($con, "INSERT INTO `price_dump`(`PD_test_id`, `PD_test_name`, `PD_price`, `PD_version_id`) SELECT `test_tbl`.`test_id`, `test_tbl`.`test_name`, `test_tbl`.`test_price`, `test_tbl`.`test_version_id` FROM `test_tbl`");
	
	
	$version_id = getCounter_value($con, 9); // add new version to price_version table
	mysqli_query($con, "INSERT INTO `price_version`(`PV_id`, `PV_name`, `PV_remark`, `PV_date`, `PV_status`) VALUES ('.$version_id.', '".$new_version."', '".$remark."', CURDATE(), 'Current')");
	
	// SET current version status to OLD
	mysqli_query($con, "UPDATE `price_version` SET `PV_status`='Old' WHERE `PV_id` = '$current_verison_id'");
	
	
	// SET new version to test_tbl	
	mysqli_query($con, "UPDATE `test_tbl` SET `test_version_id` = '$version_id'");	
		
	}
?>   

<form class="form-horizontal inv-form" role="form" method="get" action="#">
<div class="panel panel-success">                                           <!--------------START new price version-->
   <div class="panel-heading" style="color:#0D9707;"><h3 class="panel-title"><i class="fa fa-square fa-spin fa-fw fa-lg"></i> Add new price version
   <span class="text-right pull-right" style="font-size:14px !important; color:#A400DF;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
   
   </h3></div>     
  
  <div class="panel-body">
  
  <div class="form-group">
    <label for="current_PV" class="col-lg-4 control-label">Current Price version</label>
    <div class="col-lg-4">
    <input type="text" class="form-control" name="current_verison" value="<?php $CPV_name = currentVersion_name($con); if ($CPV_name ==""){echo "No current version set";} else{echo $CPV_name;}?>" readonly>
    <input type="hidden" class="form-control" name="current_verison_id" value="<?php $CPV_id = currentVersion_id($con); if ($CPV_id ==""){echo "";} else{echo $CPV_id;}?>">
    </div>
  </div>
  
   <div class="form-group">
    <label for="current_PV_date" class="col-lg-4 control-label">Current version Date</label>
    <div class="col-lg-4">
    <input type="text" class="form-control" name="current_version_date" value="<?php $CPV_date = currentVersion_date($con); if ($CPV_date ==""){echo "No current version date";} else {echo date("d-M-Y", strtotime($CPV_date));}?>" readonly>
    </div> 
   </div>    
  
  <div class="form-group">
     <label for="radio_disc" class="col-lg-4 control-label">New Price version</label>
       <div class="col-lg-4">					      
          <input type="text" class="form-control" name="new_version" placeholder="New Price version" required>
        </div>
   </div>	
               
      
    <div class="form-group">
    <label for="PV_remark" class="col-lg-4 control-label">Remark</label>
      <div class="col-lg-4">
        <textarea class="form-control" name="remark" placeholder="Remark - new price version - optional"></textarea>
      </div>
     </div>
     </div><!--end panel -body-->
     
  <div class="panel-footer">
  <div class="row">
       <div class="col-lg-offset-4 col-lg-4">
          <button type="submit" class="btn btn-primary btn-block submit_version" name="submit" style="font-size:16px;">Create price version</button>
       </div>  
    </div>  
  </div>     
</div>  
   
     
   </form>  
   
   
 <div class="panel panel-success">
      <div class="panel-heading" style="color:#0D9707;"><h3 class="panel-title"><i class="fa fa-square fa-spin fa-fw fa-lg"></i> Price version Information</h3></div>
      
   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover display" id="version_table">
        <thead align="left">
        <tr>
          <th> # </th>
          <th> Version Name</th>          
          <th> Version Date</th>
          <th> Version Status</th>
          <th> Remark</th>
         </tr>
       </thead>     
  <tbody>
<?php
$result_version = mysqli_query($con, "SELECT * FROM `price_version` ORDER BY PV_id DESC");
$sl_no=1;
while ($row = mysqli_fetch_array($result_version))
{
	$PV_id = $row['PV_id'];
	$PV_date = $row['PV_date'];
	
?>
 <tr id="<?php echo $row['PV_id'] ; ?>">
      <td> <?php echo $sl_no; ?> </td>  
      <td><?php echo  $row['PV_name']; ?> </td>  
      <td><?php echo  date("d-M-Y", strtotime($row['PV_date'])); ?> </td>       
      <td><?php echo  $row['PV_status']; ?> </td>       
      <td><?php echo  $row['PV_remark']; ?> </td>     
 </tr>
 <?php
	$sl_no++;
}
?>
<tbody>
</table> 
<div class="clear"></div>   
</div>           <!----------------------------------------End version table ------------------------->

<div class="clear"></div>
</div>
</div>
</div>


<?php include("footer.php"); ?> 
 <?php include("script_bootstrap_datatable.php"); ?>  
<script charset="utf-8" type="text/javascript">
   $(document).ready(function() {			
 
 $('#version_table').dataTable( {		       		

        "bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bFilter":false,
		"bInfo":false,
		"sScrollY": "100px",
		"sScrollX": "98%",
	
		"fnPreDrawCallback": function( oSettings ) {		
		  $('.dataTables_filter input').addClass('form-control input-sm');
		  $('.dataTables_filter input').attr('placeholder', 'Search');	
		  $('.dataTables_filter input').css('height', '33px');
		  //$('.dataTables_filter input').css('margin-right', '15px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  //$('.dataTables_length label').addClass('form-control input-sm');
		  //$('.dataTables_length label').css('width', '400px');
		  $('.dataTables_length select').css('height', '33px');	
		  $('.dataTables_length select').css('margin-right', '3px');	
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');
		 	 
	   }	
     });
	 
}); 
   
   </script>
  </body>
</html>
<?php }?>