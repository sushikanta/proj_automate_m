<?php require_once("check_login_mt.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Create Template</title>
<?php require_once("css_bootstrap_datatable_header.php"); ?> 
<body>
<?php require_once("right_top_header_popup.php");?>

<?php 
	if(isset($_GET['submit'])){
		
		resetCounter($con, 31, 'yy');   //  TPN_id
		$template_name =  mysqli_real_escape_string($con, $_GET['template_name']);
		$test_id = $_GET['tid'];		
		$row_no = mysqli_real_escape_string($con, $_GET['row_no']);
		$column_no = mysqli_real_escape_string($con, $_GET['column_no']);		
		$TPN_id = date("y").getCounter($con, 31);
		
		mysqli_autocommit($con, false);
		$flag = true;
		
	    mysqli_query($con, "INSERT INTO template_name(TPN_id, TPN_name, TPN_test_id, TPN_total_row, TPN_total_column, TPN_status) VALUES ('$TPN_id', '".$template_name."', '$test_id', '$row_no', '$column_no', '33')");
		
		if(mysqli_affected_rows($con) <= 0) { $flag = false; $err = "Error: " . mysqli_error($con). "."; }
	    else updateCounter($con, 31);
		
		if($flag){
			mysqli_commit($con);
			header("location: MT_template_add.php?tpn_id=$TPN_id"); } 
		else {
			mysqli_rollback($con);	
			header("location: MT_template_name_add.php?tid=$test_id&msg=$err"); } 
	   }
   ?>

<?php if(isset($_GET['tid']) && $_GET['tid'] !=''){ 
		$tid = $_GET['tid'];
	?>
<div class="container">
 <div class="page-content">
 
 	<!------------------- start loading..--------------------------------->
  <div id="divWait" style="display: none;" class="row text-center">
   <img src="images/loading-1.gif" alt="Please wait...." style="background-repeat:no-repeat; background-position:right center; margin-top:80px;" />
  </div>
  <div class="inv-main" id="div_main">

    <div class="panel panel-success">
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
   	 Create <span class="panel-subTitle"> ( Report Template ) </span>
     <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span> 
    
   <!----- ERROR VALIDATION ------>
    <div class="row error err pull-right" style="display:none; margin-right:34%; color:red; font-size:13px;">
      <img width="21" height="21" alt="Warning!" src="images/warning.gif">
      <span id="submit-error" class="span-error"></span><br clear="all">
    </div>             
    </h3>
    </div>
  
 <div class="panel-body">
 
 <!------ ERROR/SUCCESS MSG --------> 
 <?php if(isset($_GET['msg']) && $_GET['msg'] !== ''){
			?>
    <div class="alert alert-danger alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><i class="fa fa-times-circle fa fa-lg fa-fw"></i> </strong> <?php echo  $_GET['msg']; ?>
    </div>
 <?php }?>
 	
 <form class="form-horizontal inv-form" role="form" method="get" action="#" id="form_add">

  <!--------  TEmplate Name ------>
  <div class="row" style="margin-top:30px;">
  <div class="form-control-group">
  <label for="template_name" class="col-lg-3 control-label text-right" style="font-size:18px; padding-top:3px;">Template </label>
  <div class="col-lg-6">
  <input type="text" class="form-control" id="template_name" placeholder="Template Name" name="template_name" maxlength="100" style=" line-height:1.8999;"
  value="<?php echo showTest_name($con, $tid); ?>">
  </div>
  </div>
  </div>

	<!-------- Test Name ------>
    <div class="row" style="margin-top:30px;"> 
    <div class="form-control-group">
    <label for="test_name" class="col-lg-3 control-label" style="font-size:18px; padding-top:3px;">Investigation</label>
    <div class="col-lg-6">
    <input type="text" class="form-control" id="test_name" placeholder="Investigation Name" name="test_name" style=" line-height:1.8999;"
    value="<?php echo showTest_name($con, $tid); ?>" readonly>
    <input type="hidden" name="tid" value="<?php echo $tid; ?>">
    </div>
    </div>    
    </div>
 
 		<!-------- ROW ------>
        <div class="row" style="margin-top:30px;">
        <div class="form-control-group">   
        <label for="row_no" class="col-lg-3 control-label text-right" style="font-size:18px; padding-top:3px;">
        <i class="fa fa-table fa-lg fa-fw"></i> Row
        </label>
        <div class="col-lg-2">
        <input type="text" class="form-control" name="row_no" placeholder="No.of Rows" maxlength="3" required>
        </div>
        </div>
   
    <div class="form-control-group">
    <label for="column_no" class="col-lg-2 control-label text-right" style="font-size:18px; padding-top:3px;">
    <i class="fa fa-table fa-lg fa-fw"></i> Column
    </label>
    <div class="col-lg-2">
    <select class="form-control" name="column_no" id="column_no">
        <option value="" class="option_select">Select</option>
        <option value="2" class="option_select">2</option>
        <option value="3" class="option_select">3</option>
        <option value="4" class="option_select">4</option>
    </select>
    </div>
    <button name="submit" class="btn btn-primary" type="submit" id="submit">Go</button>
    </div>
    </div>
</form> 
</div> 
          
 <div class="clear"></div>
</div>

<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?> 
<script type="text/javascript">

$("#submit").click(function(event) {
        if( !confirm('Are you sure to submit ?')) 
            event.preventDefault();
		
		$('form').submit(function () {
  			if ($(this).valid()) {
			  $('#div_main').hide();
			  $('#divWait').show();
			}
		  });
	});			
			
$("#form_add").validate({
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
					  ? 'You missed 1 field - '
					  : 'You missed ' + errors + ' fields - ';
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
	  test_name: { required: true},
	  template_name: { required: true,
					  minlength: 3,
					  maxlength: 100 },	
	  row_no: { required: true,
					  digits: true,
					  minlength: 1,
					  maxlength: 3 },	
	 column_no: { required: true },
	},

messages: {
		  test_name: { required: ""},
		  template_name: { required:""},
		  row_no: { required:""},
		  column_no: { required:""},
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
</script> 
  </body>
</html>
<?php ob_flush(); }?>