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

<div class="panel panel-success">
    <div class="panel-heading light_purple_color">
    <h3 class="panel-title">
    <i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
    Admin <span class="panel-subTitle"> ( Search ) </span>
    <span class="text-right pull-right" style="font-size:14px !important;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
    </h3>
    </div>

<!----------- ROW 1 reg ------>
  <div class="row">
  <form action="patient_registration_status_admin.php" role="form" method="get" target="_blank" class="form-horizontal inv-form" id="form_reg_eid">
  <div class="form-group" style="margin-top:30px;">
  <div class="form-control-group">
  <label for="reg_eid" class="col-lg-2 control-label"></label>
  <div class="col-lg-7">
  <input type="text" class="form-control" id="reg_eid" name="reg_eid" placeholder="Existing Registration - Search ED ( Edit / Cancel e.g. 15713 ) --- Min 4 Digits" style="line-height:1.8999;" required>
  <input type="hidden" id="reid_receipt" name="receipt_no">
  </div>
  <button name="go_reid" class="btn btn-primary" type="submit" style="font-size:18px; width:55px;">Go</button>
  </div>
  </div>
  </form>
  </div>

<!-------------ROW 2 REG ------------>
<div class="row">
 <form action="patient_registration_status_admin.php" role="form" method="get" target="_blank" class="form-horizontal inv-form" id="form_reg_name">
 <div class="form-group">
   <div class="form-control-group">
   <label for="reg_name" class="col-lg-2 control-label"></label>
      <div class="col-lg-7">
      <input type="text" class="form-control" id="reg_name" placeholder="Existing Registration - Search Patient Name ( Edit / Cancel e.g. Salam Sophia)  --- Min 3 Character" name="reg_name"  style="line-height:1.8999;" required>
      <input type="hidden" id="rname_receipt" name="receipt_no">
      </div>
      <button name="go_neid" class="btn btn-primary" type="submit" style="font-size:18px; width:55px;">Go</button>
      </div>
    </div>
 </form>
</div>

<!----------- ROW 1 DISC ------>
<div class="row">
 <form action="discount_create.php" role="form" method="get" target="_blank" class="form-horizontal inv-form" id="form_disc_eid">
 <div class="form-group" style="margin-top:30px;">
   <div class="form-control-group">
   <label for="disc_eid" class="col-lg-2 control-label"></label>
      <div class="col-lg-7">
   <input type="text" class="form-control" id="disc_eid" name="disc_eid" placeholder="Discount - Search ED ( Add / Edit e.g. 15559098 ) --- Min 4 Digits" style="line-height:1.8999;" required>
      <input type="hidden" id="deid_receipt" name="receipt_no">
      <input type="hidden" id="deid_patient" name="patient_id">
      </div>
      <button name="go_deid" class="btn btn-primary" type="submit" style="font-size:18px; width:55px;">Go</button>
      </div>
    </div>
 </form>
</div>


<!-------------ROW 2 DISC ------------>
<div class="row">
 <form action="discount_create.php" role="form" method="get" target="_blank" class="form-horizontal inv-form" id="form_disc_name">
 <div class="form-group">
   <div class="form-control-group">
   <label for="disc_name" class="col-lg-2 control-label"></label>
      <div class="col-lg-7">
      <input type="text" class="form-control" id="disc_name" name="disc_name" placeholder="Discount - Search Patient Name ( Add / Edit e.g. Salam Sophia )  --- Min 3 Character" style="line-height:1.8999;" required>
      <input type="hidden" id="dname_receipt" name="receipt_no">
      <input type="hidden" id="dname_patient" name="patient_id">
      </div>
      <button name="go_dname" class="btn btn-primary" type="submit" style="font-size:18px; width:55px;">Go</button>
      </div>
    </div>
 </form>
</div>


<!----------------  ROW 1 card -------------------->
<div class="row">
 <form action="card_holder_create.php" role="form" method="get" target="_blank" class="form-horizontal inv-form" id="form_cid">
 <div class="form-group" style="margin-top:30px;">
   <div class="form-control-group">
   <label for="search_cid" class="col-lg-2 control-label"></label>
      <div class="col-lg-7">
      <input type="text" class="form-control" id="search_cid" name="search_cid" placeholder="Card Holder - Search Customer No (e.g. 1558) --- Min 4 Digits" style="line-height:1.8999;" required>
      <input type="hidden" id="ceid_patient" name="patient_id">
      </div>
      <button name="go_ceid" class=" btn btn-primary" type="submit" style="font-size:18px; width:55px;">Go</button>
      </div>
    </div>
 </form>
</div>

<!----------------  ROW 2 card  -------------->
<div class="row">
 <form action="card_holder_create.php" role="form" method="get" target="_blank" class="form-horizontal inv-form" id="form_card_name">
 <div class="form-group">
   <div class="form-control-group">
   <label for="card_name" class="col-lg-2 control-label"></label>
      <div class="col-lg-7">
      <input type="text" class="form-control" id="card_name"  name="card_name" placeholder="Card Holder - Search Customer name (e.g. Salam Sophia) --- Min 3 Character" style="line-height:1.8999;" required>
      <input type="hidden" id="cname_patient" name="patient_id">
      </div>
      <button name="go_cname" class=" btn btn-primary" type="submit" style="font-size:18px; width:55px;">Go</button>
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

		$("#reg_eid").autocomplete({
		  source:'fd_search_auto_eid.php',
		  minLength:4,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null)
					  { $('#reg_eid').val("");
					  	$('#reid_receipt').val("");
						return false; }
				   else
					  { $('#reg_eid').val(ui.item.value);
					    $('#reid_receipt').val(ui.item.receipt_no);
					    return false; }
					}
		}).focus(function() {
                $(this).autocomplete("search");
      });

	  $("#reg_name").autocomplete({
		   source:'fd_search_auto_patient_name.php',
		  minLength:3,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null)
					  { $('#reg_name').val("");
					  	$('#rname_receipt').val("");

						return false; }
				   else
					  { $('#reg_name').val(ui.item.value);
					    $('#rname_receipt').val(ui.item.receipt_no);
					    return false; }
					}
		}).focus(function() {
                $(this).autocomplete("search");
      });



	//------- DISCOUNT

	$("#disc_eid").autocomplete({
		  source:'fd_search_auto_eid.php',
		  minLength:4,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null)
					  { $('#disc_eid').val("");
					  	$('#deid_receipt').val("");
						$('#deid_patient').val("");
						return false; }
				   else
					  { $('#disc_eid').val(ui.item.value);
					    $('#deid_receipt').val(ui.item.receipt_no);
						$('#deid_patient').val(ui.item.patient_id);
					    return false; }
					}
		}).focus(function() {
                $(this).autocomplete("search");
      });

	  $("#disc_name").autocomplete({
          //source:'admin_discount_search_auto_name.php',
		   source:'fd_search_auto_name.php',
		  minLength:3,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null)
					  { $('#disc_name').val("");
					  	$('#dname_receipt').val("");
						$('#dname_patient').val("");
						return false; }
				   else
					  { $('#disc_name').val(ui.item.value);
					    $('#dname_receipt').val(ui.item.receipt_no);
						$('#dname_patient').val(ui.item.patient_id);
					    return false; }
					}
		}).focus(function() {
                $(this).autocomplete("search");
      });

	//------------ CARD

	$("#search_cid").autocomplete({
          source:'customer_auto_id.php',
		  minLength:4,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null)
					  { $('#search_cid').val("");
						$('#ceid_patient').val("");
						return false; }
				   else
					  { $('#search_cid').val(ui.item.value);
						$('#ceid_patient').val(ui.item.patient_id);
					    return false; }
					}
		}).focus(function() {
                $(this).autocomplete("search");
      });

	  $("#card_name").autocomplete({
          source:'customer_auto_name.php',
		  minLength:3,
		  scroll:true,
		  change: function (event, ui){
					if (ui.item == null)
					  { $('#card_name').val("");
						$('#cname_patient').val("");
						return false; }
				   else
					  { $('#card_name').val(ui.item.value);
						$('#cname_patient').val(ui.item.patient_id);
					    return false; }
					}
		}).focus(function() {
                $(this).autocomplete("search");
      });

	$('#form_disc_eid, #form_disc_name').submit(function() {
    window.open('', 'discount_create.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'discount_create.php';
    });

	$('#form_cid, #form_card_name').submit(function() {
    window.open('', 'card_holder_create.php', "width=1300,height=550,resizeable,scrollbars");
    this.target = 'card_holder_create.php';
    });

})
</script>
  </body>
</html>
<?php ob_flush();?>