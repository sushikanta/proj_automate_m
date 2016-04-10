<?php require_once("check_login_admin.php"); 
resetCounter($con, 14, 'dd'); // pr_receipt_no
$cur_ed = 'ED/'.date("ynj").getCounter($con, 14);
?>
<!DOCTYPE html>
<html>
<head>
<title>Discount</title>
<?php require_once("css_bootstrap_header.php"); ?> 
<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<body>
<?php require_once("right_top_header_admin.php");?>

<div class="container">
 <div class="page-content">
  <div class="inv-main">

<div class="panel panel-success">
    <div class="panel-heading light_purple_color">
    <h3 class="panel-title">
    <i class="fa fa-windows fa-spin fa-fw fa-lg"></i>  &nbsp;&nbsp;&nbsp;
    Add / Edit Disc <span class="panel-subTitle"> ( by EiD / Patient Name ) </span>
    <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div>

<!------------------------- ROW 1----------------------------->
<div class="row">
 <form action="discount_create.php" role="form" method="get" target="_blank" class="form-horizontal inv-form" id="form_search_eid">
 <div class="form-group" style="margin-top:30px;">
   <div class="form-control-group">
   <label for="search_registration" class="col-lg-3 control-label" style="font-size:18px; padding-top:3px;"><i class="fa fa-search fa-lg fa-fw"></i> </label>
      <div class="col-lg-6">
   <input type="text" class="form-control" id="search_reg_id" placeholder="Search by EID (e.g. 15559098)" name="search_reg_id"  style="line-height:1.8999;" required>
      <input type="hidden" id="receipt_no" name="receipt_no">
      <input type="hidden" id="patient_id" name="patient_id">
      </div>      
      <button name="submit_go" class="col-lg-1 btn btn-primary" type="submit" style="font-size:18px; width:55px;">Go</button>
      </div>
    </div>
 </form>      
</div>


<!------------------------- ROW 2----------------------------->
<div class="row" style="margin-bottom: 200px;">
 <form action="discount_create.php" role="form" method="get" target="_blank" class="form-horizontal inv-form" id="form_search_name">
 <div class="form-group" style="margin-top:30px;">
   <div class="form-control-group">
   <label for="search_registration" class="col-lg-3 control-label" style="font-size:18px; padding-top:3px;"><i class="fa fa-search fa-lg fa-fw"></i> </label>
      <div class="col-lg-6">
      <input type="text" class="form-control" id="search_name" placeholder="Search by Patient name (e.g. Salam Sophia)" name="search_name"  style="line-height:1.8999;" required>
      <input type="hidden" id="receipt" name="receipt_no">
      <input type="hidden" id="patient" name="patient_id">
      </div>      
      <button name="submit_go_name" class="col-lg-1 btn btn-primary" type="submit" style="font-size:18px; width:55px;">Go</button>
      </div>
    </div>
 </form>      
</div>
          
 <div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap.php"); ?> 
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {	

		$("#search_reg_id").autocomplete({    
          //source:'admin_discount_search_auto_eid.php', 
		  source:'fd_search_auto_eid.php',		  
		  minLength:0,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null) 
					  { $('#search_reg_id').val("");
					  	$('#receipt_no').val("");
						$('#patient_id').val("");
						return false; }
				   else
					  { $('#search_reg_id').val(ui.item.value);
					    $('#receipt_no').val(ui.item.receipt_no);
						$('#patient_id').val(ui.item.patient_id);
					    return false; } 
					}						
		}).focus(function() {
                $(this).autocomplete("search");
      });
	  
	  $("#search_name").autocomplete({    
          //source:'admin_discount_search_auto_name.php', 
		   source:'fd_search_auto_name.php', 
		  minLength:0,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null) 
					  { $('#search_name').val("");
					  	$('#receipt').val("");
						$('#patient').val("");
						return false; }
				   else
					  { $('#search_name').val(ui.item.value);
					    $('#receipt').val(ui.item.receipt_no);
						$('#patient').val(ui.item.patient_id);
					    return false; } 
					}						
		}).focus(function() {
                $(this).autocomplete("search");
      });
	
	$('#form_search_eid, #form_search_name, #form_search_cur').submit(function() {	
    myWindow1 = window.open('', 'discount_create.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'discount_create.php';
    });
})
</script>
  </body>
</html>
<?php ob_flush();?>