<?php require_once("check_login_hr.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Change Password </title>
<?php require_once("css_bootstrap_header.php");?>
</head>
<body>
<?php require_once("right_top_header_hr.php"); ?>

<?php
if(isset($_POST['submit_pass'])){
	$user_id = $_SESSION['user_id'];
	$password = md5($_POST['confirm_pass']);

	mysqli_autocommit($con, false);
	$flag = true;

	mysqli_query($con, "UPDATE user_table SET user_password = '".$password."' WHERE user_id='$user_id'");
	  if(mysqli_affected_rows($con) < '0') { $flag = false; echo mysqli_error($con);}

	  if($flag){ mysqli_commit($con); header("LOCATION: change_password_hr.php?smsg=7"); } else { mysqli_rollback($con); echo " "; http_response_code(404); }
}

?>

<div class="container">
 <div class="page-content">

<!------------------- start loading..-------------------------------->
  <div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
   <div class="inv-main" id="div_hide">

	<div class="panel panel-success">
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
   	 Change <span class="panel-subTitle"> ( Your Password ) </span>
     <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>

   <!----- ERROR VALIDATION ------>
    <div class="row error pull-right" style="display:none; margin-right:34%; color:red; font-size:13px;">
      <img width="21" height="21" alt="Warning!" src="images/warning.gif">
      <span id="submit-error" class="span-error"></span><br clear="all">
      </div>
    </h3>
    </div>

  <form class="form-horizontal inv-form" role="form" method="post" action="#" id="form_pass">
  <div class="panel-body">

   <!----------------------------- ERROR/SUCCESS MSG------------------------------------>
 <?php if(isset($_GET['errmsg']) && $_GET['errmsg'] !== ''){
			?>
    <div class="alert alert-danger alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><i class="fa fa-times-circle fa fa-lg fa-fw"></i> </strong> <?php echo error_message($con, $_GET['errmsg']); ?>
    </div>
 <?php }?>

 <?php if(isset($_GET['smsg']) && $_GET['smsg'] != ''){ ?>
    <div class="alert alert-success alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><i class="fa fa-check-circle fa-lg fa-fw"></i> </strong> <?php echo success_message($con, $_GET['smsg']); ?>
    </div>
 <?php }?>

     <div class="form-group">
      <div class="form-control-group" id="div_cur">
     <label for="cur_pass" class="col-lg-4 text-right control-label">Current Password</label>
      <div class="col-lg-4">
      <input type="password" class="form-control" id="cur_pass" name="cur_pass" placeholder="Current Password" autofocus>
      </div>
      </div>
      <span id="status"></span>
      </div>

    <div class="form-group">
      <div class="form-control-group">
      <label for="new_pass" class="col-lg-4 text-right control-label">New Password</label>
      <div class="col-lg-4">
      <input type="password" class="form-control" id="new_pass" name="new_pass" placeholder="New Password">
      </div>
      </div>
     </div>

      <div class="form-group">
      <div class="form-control-group">
      <label for="confirm_pass" class="col-lg-4 text-right control-label">Confirm Password</label>
      <div class="col-lg-4">
     <input type="password" class="form-control" id="confirm_pass" name="confirm_pass" placeholder="Retype New Password">
      </div>
      </div>
      </div>

      <div class="form-group">
      <div class="col-lg-offset-4 col-lg-4">
      <button type="submit" class="btn btn-primary btn-block" style="font-size:16px;" id="submit_pass" name="submit_pass">Submit</button>
      </div>
      </div>
      </div>
   </div>
</form>
</div>
<div class="clear"></div>
</div>
<?php require_once("footer.php"); ?>
<?php require_once("script_bootstrap.php"); ?>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    $("#submit_pass").attr('disabled', true);

	$("#cur_pass").change(function() {
	var cur_pass = $("#cur_pass").val();
	if(cur_pass.length >= 2)
	{

	    $("#status").html('<img src="images/axaj-loading.gif" alt="...checking" align="absmiddle">&nbsp;');

		$.ajax({
		type: "POST",
		url: "change_password_verify.php",
		data: "cur_pass="+ cur_pass,
		success: function(msg){

	   $("#status").ajaxComplete(function(event, request, settings){
		if(msg == 'OK')
		{
			$("#submit_pass").attr('disabled', false);
			$("#div_cur").removeClass('has-error');
			$("#div_cur").addClass('has-success');

			$(this).html('&nbsp;<img src="images/tick.png" alt="OK" align="absmiddle">');
			return false;
		}
		else
		{
			$("#div_cur").removeClass('has-success'); // if necessary
			$("#div_cur").addClass("has-error");
			$("#submit_pass").attr('disabled', true);
			$(this).html(msg);
			return false;
		 }
		});
		}
		});
	 }
});


	$("#submit_pass").click(function(event) {
        if( !confirm('Are you sure to submit ?'))
            event.preventDefault();

			$('form').submit(function () {
  			if ($(this).valid()) {
			  $('#div_hide').hide();
			  $('#divWait').show();
			}
		  });
	 });

	$("#form_pass").validate({
	ignore: "",
	errorContainer: ".err",
	errorLabelContainer: '.span-error',
	onkeyup: true,
	onblur: true,
	invalidHandler: function(event, validator) {
				//errorClass: "control-group error"
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

					  return false;

					  $("div.errors").hide();
					  $("div.errors span").hide();  }
				else { $("div.error").hide(); $("div.error span").hide(); return true;}
			},

rules: {
		new_pass: { required: true,
						minlength: 5,
						maxlength: 50 },
		confirm_pass: { required: true,
						minlength: 5,
						maxlength: 50,
						equalTo: "#new_pass" },
		cur_pass: { required: true,}
		},

messages: {
		new_pass: { required: '',
				    minlength: 'Min.5 Character',
				    maxlength: 'Max.50 Character' },
		confirm_pass: { required: '',
				        minlength: 'Min.5 Character',
				        maxlength: 'Max.50 Character',
				        equalTo: "Not match with New" },
		cur_pass: { required: '', },
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
<?php ob_flush() ?>
