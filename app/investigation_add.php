<?php include("function.php");?>
<?php include("header.php");?>
	<div class="container">
		<?php include("side_bar.php");?>	
		<div class="page-content">
		
    <?php 
	if(isset($_GET['submit'])){
	
	if(isset($_GET['hidden_category']) && $_GET['hidden_category'] !=""){
	    $test_category_id = $_GET['hidden_category'];
	     }
		else{
		$test_category_id = getCounter_value($con, 5);	
		$test_category = $_GET['test_category'];
		addTest_category($con, $test_category_id, $test_category);		
		updateCounter_value($con, 5, $test_category_id+1);
	        }	
			
	if(isset($_GET['hidden_version']) && $_GET['hidden_version'] !=""){
	    $version_id = $_GET['hidden_version'];
	     }
		else{
		$version_id = getCounter_value($con, 9);	
		$price_version = $_GET['price_version'];
		addPrice_version($con, $version_id, $price_version);	
		updateCounter_value($con, 9, $version_id+1);
	        }  
			
		$test_name = $_GET['test_name'];
		$test_price = $_GET['test_price'];
		foreach($test_name as $key => $test_name){
			  $test_id = getCounter_value($con, 10);
			  $price_id = getCounter_value($con, 11);				
			  addTest($con, $test_id, $test_name, $test_category_id);				
			  addPrice($con, $price_id, $test_price[$key], $test_id, $version_id);
			  updateCounter_value($con, 10, $test_id+1);
			  updateCounter_value($con, 11, $price_id+1);
			 
			}
		
		}
        
	?>       
        
        
        
<div class="inv-main">
<form class="form-horizontal inv-form" role="form" method="get">
    <div class="panel panel-info">
          <div class="panel-heading">Add Investigation Details (Admin Section)</div>
          <div class="form-group">
            <label for="test_category" class="col-lg-2 control-label">Invest. Category</label>
                <div class="col-lg-5">
                  <input type="text" class="form-control" id="test_category" name="test_category" placeholder="Search or enter investigation category" > 
                  <input type="hidden" class="form-control" id="hidden_category" name="hidden_category">
                </div>
                <label for="test_category" class="col-lg-2 control-label">Price Version</label>
               <div class="col-lg-2">
                <input type="text" class="form-control" id="price_version" placeholder="S/E version" name="price_version">
                <input type="hidden" class="form-control" id="hidden_version" name="hidden_version">
              </div>
          </div>        
          
          
          <div class="form-group line_bottom">
             <label id="reference" name="reference" class="col-lg-1 control-label">SL #</label>
             <label id="reference" name="reference" class="col-lg-1"></label>
             <label id="reference" name="reference" class="col-lg-7">Investigation Name</label>
             <label id="reference" name="reference" class="col-lg-3"></label>
             <label id="reference" name="reference" class="col-lg-2">Price (Rs.)</label>
          </div>	
              
          <div class="form-group  clonedInput" id="entry1">
          <label id="sl_no1" name="sl_no" class="col-lg-1 control-label sl_no">1.</label>
          <label id="reference" name="reference" class="col-lg-1"></label>           
            
          <div class="col-lg-7">
             <input type="text" class="form-control" id="test_name" placeholder="Enter Investigation name" name="test_name[]">              
          </div>
          <div class="col-lg-2">
             <input type="text" class="form-control test_price" id="test_price" placeholder="Rs." name="test_price[]">
          </div>
          </div>  
    <div id="addDelButtons">
        <input type="button" id="btnAdd" class="btn btn-mini btn-primary addIcon">&nbsp;
        <input type="button" id="btnDel" class="btn btn-mini btn-danger deleteIcon">
    </div>
                          
         
        </div>
    
        <div class="form-group">
          <div class="col-lg-offset-5 col-lg-7">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-danger" name="reset">Reset</button>
          </div>
          
        </div>
       </div>
    </form>
</div>
	 <div class="clear"></div>
	</div>
<?php include("footer.php"); ?>   
   <script src="js/add_investigationDetails.js"></script>
  </body>
</html>