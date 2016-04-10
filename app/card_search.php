<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Search</title>
<?php require_once("css_bootstrap_header.php"); ?> 
<body>
<?php require_once("right_top_header_admin.php");?>

<div class="container">
 <div class="page-content">
  <div class="inv-main">

<div class="panel panel-success panel">
    <div class="panel-heading light_purple_color">
    <h3 class="panel-title">
    <i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    Search <span class="panel-subTitle"> ( Saved Customer ) </span>
    <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div>

<!------------------------- ROW 1---------------------------->
<div class="row">
 <form action="card_holder_create.php" role="form" method="get" target="_blank" class="form-horizontal inv-form" id="form_cid">
 <div class="form-group" style="margin-top:30px;">
   <div class="form-control-group">
   <label for="search_cid" class="col-lg-3 control-label" style="font-size:18px; padding-top:3px;"><i class="fa fa-search fa-lg fa-fw"></i> </label>
      <div class="col-lg-6">
      <input type="text" class="form-control" id="search_cid" name="search_cid" placeholder="Search by Customer No (e.g. 15559098)" style="line-height:1.8999;" required>
      <input type="hidden" id="patient_id" name="patient_id">
      </div>      
      <button name="submit_go" class="col-lg-1 btn btn-primary" type="submit" style="font-size:18px; width:55px;">Go</button>
      </div>
    </div>
 </form>      
</div>

<!------------------------- ROW 2----------------------------->
<div class="row" style="margin-bottom: 200px;">
 <form action="card_holder_create.php" role="form" method="get" target="_blank" class="form-horizontal inv-form" id="form_name">
 <div class="form-group" style="margin-top:30px;">
   <div class="form-control-group">
   <label for="search_registration" class="col-lg-3 control-label" style="font-size:18px; padding-top:3px;"><i class="fa fa-search fa-lg fa-fw"></i> </label>
      <div class="col-lg-6">
      <input type="text" class="form-control" id="search_name"  name="search_name" placeholder="Search by Customer name (e.g. Salam Sophia)" style="line-height:1.8999;" required>
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

<script type="text/javascript">
$(document).ready(function() {	

		$("#search_cid").autocomplete({    
          source:'customer_auto_id.php', 
		  minLength:0,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null) 
					  { $('#search_cid').val("");
						$('#patient_id').val("");
						return false; }
				   else
					  { $('#search_cid').val(ui.item.value);
						$('#patient_id').val(ui.item.patient_id);
					    return false; }
					}						
		}).focus(function() {
                $(this).autocomplete("search");
      });
	  
	  $("#search_name").autocomplete({    
          source:'customer_auto_name.php', 
		  minLength:0,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null) 
					  { $('#search_name').val("");			
						$('#patient').val("");
						return false; }
				   else
					  { $('#search_name').val(ui.item.value);					  
						$('#patient').val(ui.item.patient_id);
					    return false; } 
					}						
		}).focus(function() {
                $(this).autocomplete("search");
      });
	
	$('#form_cid, #form_name').submit(function() {	
    window.open('', 'card_holder_create.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'card_holder_create.php';
    });
})
</script>
  </body>
</html>
<?php ob_flush();?>