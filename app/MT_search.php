<?php require_once("check_login_mt.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Search</title>
<?php require_once("css_bootstrap_header.php");?> 
<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>
<body>
<?php require_once("right_top_header_mt.php");?>
<div class="container">
 <div class="page-content">
  <div class="inv-main">
  
  <div class="panel panel-success">
  <div class="panel-heading light_purple_color">
    <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-lg fa-fw"></i> &nbsp;&nbsp;&nbsp;
    Search  <span class="panel-subTitle"> ( Patient Registration - EDs )</span>
    <button id="close_all" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
      <i class="fa fa-times fa-lg"></i> Reset&nbsp;</button>
    <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div>
<div class="panel-body" style="min-height:300px;">
  
  <!---------- ROW 1 --------->  
  <!--<div><h4 align="center" class="blue_color" style=" margin-bottom:-15px;"> Existing Registration</h4><hr /></div>--> 
  <div class="row padding_top20">
  <div class="form-group">
    <form  action="MT_patient_investigation_view.php"class="form-inline inv-form" role="form" method="get" target="_blank" id="search_eid">
    <div class="form-control-group">    
    <label for="reg_no" class="col-lg-3 control-label text-right"> ED /  </label>
    <div class="col-lg-6">
    <input type="text" class="form-control" id="reg_no" placeholder="Search by ED (eg. 1550910) - - min.4 digits" name="reg_no">
    <input type="hidden" name="receipt_no" id="reg_no_eid">
    <input type="hidden" name="tid" value="1">
    </div>
    <button name="eid_go" class="btn btn-primary" type="submit">GO</button>
    </div>    
    </form>
    </div>
    </div>
    
    <div class="row">
   <div class="form-group">
     <form  action="MT_patient_investigation_view.php"class="form-inline inv-form" role="form" method="get" target="_blank" id="search_name">
    <div class="form-control-group">    
    <label for="patient_name" class="col-lg-3 control-label text-right"> Name  </label>
    <div class="col-lg-6">
    <input type="text" class="form-control" id="patient_name" placeholder="Search Patient name (eg. Salam Sonia) -  min.4 characters" name="patient_name">
    <input type="hidden" name="receipt_no" id="receipt_eid">
    <input type="hidden" name="tid" value="2">
    </div>
    <button name="name_go" class="btn btn-primary" type="submit">GO</button>
    </div>  
    </form>
    </div>
 
  </div>

    <!------------- DATE SEARCH ----------->
   <div class="row">
   <div class="form-group">
      <form  action="MT_patient_investigation_view.php"class="form-horizontal inv-form" role="form" method="get" target="_blank" id="search_date">      
      <div class="form-control-group">
      <label for="member" class="col-lg-3 control-label" > <i class="fa fa-calendar fa-lg fa-fw"></i> </label>
      <div class="col-lg-3">
      <input type="text" class="form-control" id="start_date" name="start" value="<?php echo date('d-m-Y');?>" readonly/>  
      </div>
      </div>
      
      <div class="form-control-group">
       <label for="member" class="control-label" ></label>
      <div class="col-lg-3">
      <input type="text" class="form-control" id="end_date" name="end" value="<?php echo date('d-m-Y');?>" readonly>      
      </div>
      
      
      <input type="hidden" name="tid" value="3">     
      <button name="date_go" class="btn btn-primary" type="submit">GO</button>
      </div>
      </form>      
      </div>      
    </div> 
  </div> 
 <div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap_datatable.php"); ?> 
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {	
	
	// Pop-up windows
	$('#form_cs, #new_pname').submit(function() {	
    window.open('', 'patient_registration_card.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'patient_registration_card.php';
    });	
	
	
	// AUTOCOMPLETE
		$("#reg_no").autocomplete({    
          source:'fd_search_auto_eid.php', 
		  minLength:4,
		  scroll: true,
		  change: function (event, ui){ 
					if (ui.item == null) 
					  { $('#reg_no').val("");
					  	$('#reg_no_eid').val("");
						return false; }
				   else
					  { $('#reg_no').val(ui.item.value);
					    $('#reg_no_eid').val(ui.item.receipt_no);
					    return false; } }
		}).focus(function() {
                $(this).autocomplete("search");
            });	  


		$("#patient_name").autocomplete({    
          source:'fd_search_auto_name.php', 
		  minLength:4,
		  scroll: true,
		  change: function (event, ui){ 
					if (ui.item == null) 
					  { $('#patient_name').val("");
					  	$('#receipt_eid').val("");
						return false; }
				   else
					  { $('#patient_name').val(ui.item.value);
					    $('#receipt_eid').val(ui.item.receipt_no);
					    return false; } }
		}).focus(function() {
                $(this).autocomplete("search");
            });	  
		
		
		$("#cs_no").autocomplete({    
          source:'fd_search_auto_cs.php', 
		  minLength:4,
		  scroll: true,
		  change: function (event, ui){ 
					if (ui.item == null) 
					  { $('#cs_no').val("");
					  	$('#patient_id').val("");
						return false; }
				   else
					  { $('#cs_no').val(ui.item.value);
					    $('#patient_id').val(ui.item.patient_id);
					    return false; } }
		}).focus(function() {
                $(this).autocomplete("search");
            });
			
		// for new registration only
		$("#new_csid").autocomplete({    
          source:'fd_search_auto_name_csid.php', 
		  minLength:4,
		  scroll: true,
		  change: function (event, ui){ 
					if (ui.item == null) 
					  { $('#new_csid').val("");
					  	$('#hcs_patient').val("");
						return false; }
				   else
					  { $('#new_csid').val(ui.item.value);
					    $('#hcs_patient').val(ui.item.patient_id);
					    return false; } }
		})
		
		$("#patient_name_new").autocomplete({    
          source:'fd_search_auto_name_new.php', 
		  minLength:4,
		  scroll: true,
		  change: function (event, ui){ 
					if (ui.item == null) 
					  { $('#patient_name_new').val("");
					  	$('#hname_patient').val("");
						return false; }
				   else
					  { $('#patient_name_new').val(ui.item.value);
					    $('#hname_patient').val(ui.item.patient_id);
					    return false; } }
		}).focus(function() {
                $(this).autocomplete("search");
            });  	  

$('#close_all').click(function(e) {
       myWindow1 = window.open('', 'patient_registration_card.php');
	   myWindow1.close();
    });

})

$(function () {
            $('#start_date, #end_date').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
					
                },
				 pickTime: false,
				 format: ("DD-MM-YYYY"),
					 			
            });
		 });
</script> 
  </body>
</html>
<?php ob_flush();?>