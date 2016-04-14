<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Users </title>
<?php require_once("css_bootstrap_datatable_header.php");?> 
</head>
<body>
<?php require_once("right_top_header_admin.php");?>
<div class="container">
 <div class="page-content">
   <div class="inv-main">
        
	<div class="panel panel-success">
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
   	 Password <span class="panel-subTitle"> ( Change ) </span> 
  	<span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div>
  
  <div class="panel-body">   
  	
    <form class="form-horizontal inv-form" role="form" method="get" action="#" id="form_pass">
    <div class="form-group"> 
      <div class="form-control-group">
      <label for="new_pass" class="col-lg-4 text-right control-label">New Password</label>
      <div class="col-lg-4">
      <input type="text" class="form-control" id="new_pass" name="new_pass" placeholder="New Password">
      </div>
      </div>
     </div>
      
      <div class="form-group"> 
      <div class="form-control-group">
      <label for="confirm_pass" class="col-lg-4 text-right control-label">Confirm Password</label>
      <div class="col-lg-4">
     <input type="text" class="form-control" id="confirm_pass" name="confirm_pass" placeholder="Retype New Password">
      </div> 
      </div>
      </div>
      
     <div class="form-group"> 
      <div class="form-control-group">
     <label for="new_pass" class="col-lg-4 text-right control-label">Current Password</label>
      <div class=" form-inline col-lg-4">
      <input type="password" class="form-control" id="cur_pass" name="cur_pass" placeholder="Current Password">
      </div> 
      </div>          
      </div>
      
      <div class="form-group">
    <div class="col-lg-offset-4 col-lg-4">
    <button type="submit" class="btn btn-primary btn-block" style="font-size:16px;" id="submit_pass" name="submit_pass">Submit</button>
    </div>
    </div>
</form>
      
</div>
<div class="clear"></div>   
</div>

<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?>  
<script charset="utf-8" type="text/javascript">
   $(document).ready(function() {		
 
 
});
</script>
  </body>
</html>
<?php ?>