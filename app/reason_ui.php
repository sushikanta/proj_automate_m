<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Reason</title>
<?php require_once("css_bootstrap_header.php"); ?> 
<body>
<?php require_once("right_top_header_admin.php");?>

<div class="container">
 <div class="page-content">
  <div class="inv-main">

<div class="panel panel-success">
    <div class="panel-heading light_purple_color">
    <h3 class="panel-title">
    <i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    Reason <span class="panel-subTitle"> ( Edit / Cancel ) </span>
    <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div>

<!----------- ROW 1 reg ------->
<div class="row" style="padding-bottom:300px;">
 <form action="patient_registration_status_admin.php" role="form" method="get" class="form-horizontal inv-form" id="form_reg_eid">
 <div class="form-group" style="margin-top:30px;">
   <div class="form-control-group">
   <label for="reg_eid" class="col-lg-3 control-label"></label>
      <div class="col-lg-6">
   <select class="form-control" id="reg_eid" name="reg_eid" style="line-height:1.8999;" required>
   <option value="" class="option_select">Select A Reason</option>
   <?php $resultT = mysqli_query($con, "SELECT status_id, status_name FROM status_tbl WHERE status_column = 'A_remark' AND status_id !='30'");
          while($rowT= mysqli_fetch_array($resultT)) {?>
          <option value="<?php echo $rowT['status_id'];?>" class="option_select"><?php echo $rowT['status_name']; ?></option>          
	<?php } ?>
   </select>
      <input type="hidden" id="reid_receipt" name="receipt_no">
      <input type="hidden" id="reid_patient" name="patient_id">
      </div>      
      <button name="go_reid" class="btn btn-primary" type="submit">Go</button>
      </div>
    </div>
 </form>      
</div>
          
 <div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap.php");?>
</body>
</html>
<?php ob_flush();?>