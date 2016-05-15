<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Reason</title>
<?php require_once("css_bootstrap_header.php"); ?>
<body>
<?php require_once("right_top_header_popup.php");?>

<div class="container">
 <div class="page-content">
 <!------------- loading.. ---------->
  <div id="divWait" style="display: none;" class="row text-center">
  <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
  <div class="inv-main" id="div_hide">

<?php

if(isset($_GET['receipt_no']) && $_GET['receipt_no'] !="")
{
 $receipt_no = $_GET['receipt_no'];
 $patient_id = $_GET['patient_id'];
 ?>

<div class="panel panel-success">
    <div class="panel-heading light_purple_color">
    <h3 class="panel-title">
    <i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    Reason <span class="panel-subTitle"> ( Edit / Swap Patient Info ) </span>
    <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    
    <!----- ERROR DIV -->
    <div class="row error pull-right" style="display:none; margin-right:34%; color:red; font-size:13px;">
      <img width="21" height="21" alt="Warning!" src="images/warning.gif">
      <span id="submit-error" class="span-error"></span><br clear="all">
    
    </h3>
    </div>

<!------- ROW 1 reg ------>
<div class="row" style="padding-bottom:250px;">
 <form action="patient_info_admin.php"  role="form" method="get" class="form-horizontal inv-form" id="form_reason">
 <div class="form-group" style="margin-top:30px;">
  <div class="form-control-group">
  <label for="reason" class="col-lg-3 control-label"></label>
  <div class="col-lg-6">
  <textarea class="form-control" id="reason" placeholder="Customer ID : <?php echo $patient_id; ?>  ( 1. Reason for Edit / Swap Customer,  2. What to Edit )" name="reason"></textarea>
  <input type="hidden" name="receipt_no" value="<?php echo $receipt_no; ?>">
  <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
  </div>
  </div>
  </div>
     <div class="form-group">
    <div class="col-lg-offset-4 col-lg-4">
    <button type="submit" class="btn btn-primary btn-block" style="font-size:16px;" id="go_eid1" name="go_eid1">Submit</button>
    </div>
    </div>
    
 </form>      
</div>
          
 <div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap.php");?>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
$("#go_eid1").click(function(event) {
        if( !confirm('Are you sure to submit ?')) 
            event.preventDefault();
      $('form').submit(function () {
        if ($(this).valid()) {
        $('#div_hide').hide();
        $('#divWait').show();
      }
      });
  });
  
  $("#form_reason").validate({
  //debug: true, 
  ignore: "",
  errorContainer: ".err",
  errorLabelContainer: '.span-error',
  onkeyup: true,
  onblur: true,
  invalidHandler: function(event, validator) {
        errorContainer: ".error"
        errorLabelContainer: '#submit-error'  
          
        var errors = validator.numberOfInvalids();
        if (errors) 
          { var message = errors == 1
            ? 'You missed 1 field. Highlighted - '
            : 'You missed ' + errors + ' fields. Highlighted - ';
            $("div.error").show().delay(3000).fadeOut("medium");
            $("div.error span").html(message);
            $("div.err").hide();
            $("div.err span").hide();
            $("#page_date").hide();
            return false;
           } 
        else { $("div.error").hide(); $("div.error span").hide(); return true;}
      },
  
rules: {
    reason: { required: true,
            minlength: 10,
            maxlength: 100 },
    },
    
messages: {
    reason: { required: 'Can not be blank',
          minlength: 'Min.10 Character',
          maxlength: 'Max.100 Character' },
    },

errorPlacement: function(error, element) {
                 error.appendTo('.err');
             },

  highlight: function(element) {
        $(element).parents('div.form-control-group').removeClass('has-success');
        $(element).parents('div.form-control-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).parents('div.form-control-group').removeClass('has-error');
        $(element).parents('div.form-control-group').addClass('has-success');
      }
  }); 
});

</script>
</body>
</html>
<?php } ob_flush();?>