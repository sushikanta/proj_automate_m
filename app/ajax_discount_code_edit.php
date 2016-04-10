<?php include("function.php");?>
<?php include("header.php");?>
  <div class="container">
	<?php include("side_bar.php");?>

    <?php
	if(isset($_GET['submit'])){
	$patient_disc_id=getCounter_value($con, 15);
	$patient_id=$_GET['patient_id'];
	$disc_code=$_GET['discount_code'];
	$disc_code_id=getCounter_value($con, 12);

	if(isset($_GET['disc_per']) && $_GET['disc_per'] !=""){
		$disc_value=$_GET['disc_per'];
		$disc_value_id=getCounter_value($con, 13);
		$disc_type_id=1;
		addDiscount_value($con, $disc_value_id, $disc_value, $disc_code_id, $disc_type_id);
		addDiscount_code($con, $disc_code_id, $disc_code);
		updateCounter_value($con, 13, $disc_value_id+1);
		}
	if(isset($_GET['disc_amt']) && $_GET['disc_amt'] !=""){
		$disc_value=$_GET['disc_amt'];
		$disc_value_id=getCounter_value($con, 14);
		$disc_type_id=2;
		addDiscount_value($con, $disc_value_id, $disc_value, $disc_code_id, $disc_type_id);
		addDiscount_code($con, $disc_code_id, $disc_code);
		updateCounter_value($con, 14, $disc_value_id+1);
		}
	$disc_remark=$_GET['disc_remark'];
	addPatient_disc($con, $patient_disc_id, $disc_code_id, $disc_value_id, $disc_remark, $patient_id, $disc_type_id);
	updateCounter_value($con, 12, $disc_code_id+1);
	updateCounter_value($con, 15, $patient_disc_id+1);
	}
?>



<div class="page-content">
<div class="inv-main">
<form class="form-horizontal inv-form" role="form" method="get" action="discount_code_create.php">

    <div class="panel panel-info">

       <div class="panel-heading">Edit discount value (Admin)</div>
       <?php
	   if(isset($_GET['disc_id']) && $_GET['disc_id'] != ""){
		  $disc_id=$_GET['disc_id'];
		  $result=mysqli_query($con, "SELECT patient_disc_id, patient_id, disc_code, disc_value, patient_disc_tbl.disc_type_id, disc_remark FROM patient_disc_tbl, disc_code_tbl, disc_value_tbl WHERE patient_disc_tbl.patient_disc_id = '$disc_id' AND patient_disc_tbl.disc_code_id = disc_code_tbl.disc_code_id AND patient_disc_tbl.disc_value_id=disc_value_tbl.disc_value_id");
		while($row=mysqli_fetch_array($result))
	    {

		?>
         <div class="form-group">
          <label for="patient_id" class="col-lg-4 control-label">Patient ID</label>
            <div class="col-lg-3">
              <input type="text" class="form-control" id="patient_id" value="<?php echo $row['patient_id'];?>" name="patient_id" required="required"><span id="patient_idInfo" ></span>
            </div>
        </div>

        <div class="form-group">
         <label for="discount_code" class="col-lg-4 control-label">Discount Code</label>
          <div class="col-lg-3">
            <input type="text" class="form-control" id="inputID" value="<?php echo $row['disc_code'];?>" name="discount_code" readonly>
          </div>
        </div>
        <div class="form-group">
           <label for="radio_disc" class="col-lg-4 control-label">Type</label>
             <div class="col-lg-3">
                <label class="radio-inline">
                  <input  type="radio" name="radio_disc" id="radio_per" value="1" <?php if($row['disc_type_id'] == 1){?> checked <?php }?>> in Per (%)
                </label>
                <label class="radio-inline">
                  <input type="radio" name="radio_disc" id="radio_amt" value="2" <?php if($row['disc_type_id'] == 2){?> checked <?php }?>> in Amount
                </label>
              </div>
         </div>

        <div class="form-group">
          <label for="disc_value" class="col-lg-4 control-label">Value</label>
            <div class="col-lg-3" id="div_per">
              <input type="text" class="form-control" name="disc_per"
			  <?php if($row['disc_type_id'] == 1){?> value="<?php echo $row['disc_value'];?>" <?php }else{?> value=""<?php }?>>
            </div>
             <div class="col-lg-3" id="div_amount">
              <input type="text" class="form-control" name="disc_amt"
			  <?php if($row['disc_type_id'] == 2){?> value="<?php echo $row['disc_value'];?>" <?php }else{?> value=""<?php }?>>
            </div>
        </div>

  <div class="form-group">
    <label for="disc_remark" class="col-lg-4 control-label">Remark</label>
      <div class="col-lg-3">
        <textarea class="form-control" placeholder="Remark for discount" name="disc_remark" required="required"><?php echo $row['disc_remark']; ?></textarea>
      </div>
  </div>
  </div>
  <?php
		}
	   }
	   ?>
   <div class="form-group">
       <div class="col-lg-offset-5 col-lg-7">
          <button type="submit" class="btn btn-primary" name="submit">Create</button>
       </div>
   </form>
</div>
	 <div class="clear"></div>
	</div>
<?php include("footer.php"); ?>
<script>
$(document).ready(function() {

        if ($('input[name=radio_disc][value=1]').prop("checked")) {
            $('#div_per').show();
			$('#div_amount').hide();
		}
        else if ($('input[name=radio_disc][value=2]').prop("checked")) {
				 $('#div_per').hide();
			     $('#div_amount').show();
		}

	  $("#radio_per, #radio_amt").click(function () {
        if ($('input[name=radio_disc][value=1]').prop("checked")) {
            $('#div_per').show();
			$('#div_amount').hide();
		}
        else if ($('input[name=radio_disc][value=2]').prop("checked")) {
				 $('#div_per').hide();
			     $('#div_amount').show();
		}
    });

	});

</script>

  </body>
</html>