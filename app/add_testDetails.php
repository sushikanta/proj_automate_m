<?php include("function.php");?>
<?php include("header.php");?>
	<div class="container">
		<?php include("side_bar.php");?>
		<div class="page-content">

    <?php
	if(isset($_GET['submit']) && $_GET['submit'] != ""){

	if(isset($_GET['hidden_category']) && $_GET['hidden_category'] !=""){
	    $state_id=$_GET['hidden_category'];
		}
		else{
		$category_value = getCounter_value($con, 5);
		$test_category = $_GET['test_category'];
		addTwo($con, "test_category", "test_category_id", "test_category_name", $category_id, $test_category);
		updateCounter_value($con, 5, $category_value+1);
		}



        }
	?>




<div class="inv-main">
<form class="form-horizontal inv-form" role="form" method="get">
    <div class="panel panel-info">
          <div class="panel-heading">Add Investigation Details (Admin Section)</div>

          <div class="form-group">
            <label for="test_category" class="col-lg-4 control-label">Investigation Category</label>
                <div class="col-lg-5">
                  <input type="text" class="form-control" id="test_category" name="test_category" placeholder="Search or Enter Investigation Category" >
                  <input type="hidden" class="form-control" id="hidden_category" name="hidden_category">
                </div>
          </div>
          <div class="form-group">
            <label for="test_name" class="col-lg-4 control-label">Investigation Name</label>
                <div class="col-lg-5">
                  <input type="text" class="form-control" id="test_name" placeholder="Enter Investigation name" name="test_name">
                  <input type="hidden" class="form-control" id="hidden_test_name" placeholder="Enter Investigation name" name="hidden_test_name">
                </div>
          </div>

           <div class="form-group">
            <label for="price_version" class="col-lg-4 control-label">Price Version</label>
              <div class="col-lg-5">
                <input type="text" class="form-control" id="price_version" placeholder="Search or Enter price version" name="price_version">
                <input type="hidden" class="form-control" id="hidden_version" name="hidden_version">
              </div>
           </div>

          <div class="form-group">
            <label for="test_price" class="col-lg-4 control-label">Investigation Price</label>
                <div class="col-lg-5">
                  <input type="text" class="form-control" id="test_price" placeholder="Enter investigation price" name="test_price">
                </div>
          </div>


        </div>

        <div class="form-group">
          <div class="col-lg-offset-5 col-lg-7">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <button type="reset" class="btn btn-danger" name="reset">Reset</button>
          </div>

        </div>
       </div>
    </form>
</div>
	 <div class="clear"></div>
	</div>
<?php include("footer.php"); ?>
   <script src="js/add_testDetails.js"></script>
  </body>
</html>