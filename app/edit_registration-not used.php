<?php include("function.php");?>
<?php include("header.php"); ?>
	<div class="container">
		<?php include("side_bar.php");?>	
		<div class="page-content">
		
        <?php
        if(isset($_GET['submit'])){
		  $counter_id=1;
		  $counter_value=getCounter_value($con, $counter_id);
		  $patient_id=mysqli_real_escape_string($con, $_GET['patient_id']);
		  $patient_registration_date=date('Y-m-d h:i:s', time());		  
		  $patient_name=$_GET['patient_name'];		  
		  $patient_age=$_GET['patient_age'];
		  $patient_gender_id=$_GET['patient_sex'];
		  $marital_status=$_GET['marital_status'];
		  $patient_contact=$_GET['patient_contact'];
		  $patient_address=$_GET['patient_address'];
		  $state=$_GET['state'];		
		  $district_id = $_GET['district_id'];
		  $patient_pin=$_GET['patient_pin'];
		  $source_id=$_GET['source_id'];
		  if(isset($_GET['search_dr']) && $_GET['doctor_id'] !=""){
				$referred_id=$_GET['doctor_id'];
				echo "Inside (search_dr)=".$referred_id;
			    }
		  if(isset($_GET['check_dr']) && isset($_GET['new_dr_name'])){
				$dr_counter_id=2;
				$referred_id=getCounter_value($con, $dr_counter_id);
				echo "Inside Dr1=".$referred_id;
				$new_doctor=$_GET['new_dr_name'];
				addNew_source_person($con, "doctor_profile", "doctor_id", "doctor_name", $referred_id, $new_doctor);
				updateCounter_value($con, $dr_counter_id, $referred_id+1);
				}
		  if(isset($_GET['search_staff']) && $_GET['staff_id']!=""){
				$referred_id=$_GET['staff_id'];
				echo "Inside(search_staff)=".$referred_id;
			  }
			  
		 if(isset($_GET['search_asha']) && $_GET['asha_id']!=""){
			 	$referred_id=$_GET['asha_id'];
				echo "Inside (search_asha)=".$referred_id;
			    }
		        else if(isset($_GET['check_asha']) && isset($_GET['asha_name'])){
				  $asha_counter_id=3;
				  $referred_id=getCounter_value($con, $asha_counter_id);
				  echo "Inside Asha=".$referred_id;
				  $asha_name=$_GET['asha_name'];
				  addNew_source_person($con, "asha_tbl", "asha_id", "asha_name", $referred_id, $asha_name);
				  updateCounter_value($con, $asha_counter_id, $referred_id+1);
			   }
			   
		   if(isset($_GET['search_runner']) && $_GET['runner_id']!=""){
				$referred_id=$_GET['runner_id'];
				echo "Inside search_runner=".$referred_id;
			    }
		        else if(isset($_GET['check_runner']) && isset($_GET['runner_name'])){
				  $runner_counter_id=4;
				  $referred_id=getCounter_value($con, $runner_counter_id);
				  echo "Inside Runner=".$referred_id;
				  $runner_name=$_GET['runner_name'];
				  addNew_source_person($con, "runner_tbl", "runner_id", "runner_name", $referred_id, $runner_name);
				  updateCounter_value($con, $runner_counter_id, $referred_id+1);
			   }
			 if(isset($_GET['search_centre']) && $_GET['centre_id']!=""){
				$referred_id=$_GET['centre_id'];
				echo "Inside search_runner=".$referred_id;
			    }
		        else if(isset($_GET['check_centre']) && isset($_GET['centre_name'])){
				  $centre_counter_id=5;
				  $referred_id=getCounter_value($con, $centre_counter_id);
				  echo "Inside centre=".$referred_id;
				  $centre_name=$_GET['centre_name'];
				  addNew_source_person($con, "centre_tbl", "centre_id", "centre_name", $referred_id, $centre_name);
				  updateCounter_value($con, $centre_counter_id, $referred_id+1);
			   }  
			 if($_GET['source_id']=='6'){$referred_id=6;}
			   echo "Outside=".$referred_id;
			   $test_name=$_GET['test_name'];
			   $test_price=$_GET['test_price'];
			    echo "test_name=".$test_name;
				 echo "test_price=".$test_price;
				 echo "test_price=".$test_price;
		  
		  addPatient($con, $patient_id, $patient_name, $patient_age, $patient_gender_id, $marital_status, $patient_address, $patient_registration_date, $patient_contact, $state, $district_id, $patient_pin, $source_id, $referred_id);
		  updateCounter_value($con,$counter_id, $counter_value+1);	  
			}
?>
<div class="inv-main">
<form class="form-horizontal inv-form" role="form" method="get" action="patient_registration.php" id="patient_registration">
    <div class="panel panel-info">
          <div class="panel-heading">Patient Information</div>							  
         
          <div class="form-group">
          <label for="inputID" class="col-lg-2 control-label">Patient ID</label>
            <div class="col-lg-3">
              <input type="text" class="form-control" id="inputID" value="<?php $counter_id=1; echo "ED/".date( "dmy", strtotime(date("Y-m-d")))."/".getCounter_value($con, $counter_id);?>" name="patient_id" readonly> 
            </div>
            
            <label for="inputRdate" class="col-lg-1 control-label">Date</label>
            <div class="col-lg-3">
              <input type="text" class="form-control" id="inputID" value="<?php echo date( "d-m-Y", strtotime(date("Y-m-d")));?>" readonly>
            </div>
            <label for="inputRdate" class="col-lg-1 control-label">Time</label>
            <div class="col-lg-2">
              <input type="text" class="form-control" id="inputID" value="<?php $timezone = "Asia/Calcutta"; if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone); echo date('h:i  A');?>" readonly>
            </div>
          </div>
          
          <div class="form-group">
          <label for="inputName" class="col-lg-2 control-label">Name</label>
            <div class="col-lg-3">
              <input type="text" class="form-control" id="inputName" placeholder="Patient name" name="patient_name">
            </div>
          
                <label for="inputSex" class="col-lg-1 control-label">Sex</label>
                <div class="col-lg-3">					      
                      <label class="radio-inline">
                        <input  type="radio" name="patient_sex" id="optionsRadios1" value="1"> Male
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="patient_sex" id="optionsRadios2" value="2"> Female
                      </label>
                </div>	
                    <label for="inputAge" class="col-lg-1 control-label">Age</label>
                <div class="col-lg-2">
                  <input type="text" class="form-control" id="inputContact" placeholder="Patient age" name="patient_age">
                </div>
            </div>
          
          <div class="form-group">
          <label for="inputMstaus" class="col-lg-2 control-label">Marital Status</label>
                <div class="col-lg-3">
                  <select class="form-control" name="marital_status">
                      <option value="no">Select</option>
                      <?php 
                $result=mysqli_query($con, "SELECT `marital_id`, `marital_name` FROM `marital_tbl`");
                while($row=mysqli_fetch_array($result))
                {
                    $name=$row['marital_name'];
                    $id=$row['marital_id'];						
                ?>
                  <option value="<?php echo $id;?>"><?php echo $name;?></option>						 
                 <?php
                }
                ?>
                </select>
                </div>			
          <label for="inputAdress" class="col-lg-1 control-label">Address</label>
            <div class="col-lg-3">
              <input type="text" class="form-control" id="inputAdress" placeholder="Address" name="patient_address">
            </div>
          
          
          
            
            <label for="inputContact" class="col-lg-1 control-label">Phone</label>
                <div class="col-lg-2">
                  <input type="text" class="form-control" id="inputContact" placeholder="Phone no." name="patient_contact">
                </div>     
            
          </div>
                          
          <div class="form-group">  <!--START of state selection from list and new state--> 
            <label for="inputAdress" class="col-lg-2 control-label">State</label>
            <div class="col-lg-3" id="div_state">
            <input type="text" class="form-control" id="inputAdress" placeholder="Search State" name="state">
            <input type="hidden" class="form-control" id="hidden_state" name="hidden_state">
            </div>	
                                
                                     
            <label for="inputAdress" class="col-lg-1 control-label" id="label_state_district">District</label>
            <div class="col-lg-3" id="div_district">
              <input type="text" class="form-control" id="district" placeholder="Search district" name="district">
            </div>     
             <label for="inputAdress" class="col-lg-1 control-label" id="label_state_pin">Pin</label>
            <div class="col-lg-2" id="state_pin">
              <input type="text" class="form-control" id="inputAdress" placeholder="Search Pin Code" name="patient_pin">
            </div>                        
          </div>				 

            <div class="form-group">            
                <label for="inputReffered" class="col-lg-2 control-label">Source</label>
                <div class="col-lg-3">
                  <select class="form-control" id="test_source" name="source_id">
                      <option value="0">Select </option>
                      <?php 
                $result=mysqli_query($con, "SELECT `source_id`, `source_name` FROM `test_source`");
                while($row=mysqli_fetch_array($result))
                {
                    $source_name=$row['source_name'];
                    $source_id=$row['source_id'];						
                ?>
                  <option value="<?php echo $source_id;?>"><?php echo $source_name;?></option>						 						 
                 <?php
                
                }
                ?>
                  </select>
                </div>                
               
               <label for="inputReffered" class="col-lg-1 control-label" id="label_list">Search</label>
                <div class="col-lg-3" id="dr_list">
                 <input type="text" class="form-control" name="search_dr" placeholder="From Dr. list" id="search_dr">
                 <input type="hidden" class="form-control" name="doctor_id" id="doctor_id">
                </div>
                <div class="col-lg-2" id="staff_list">
                 <input type="text" class="form-control" name="search_staff" placeholder="From Staff list" id="search_staff">
                 <input type="hidden" class="form-control" name="staff_id" id="staff_id">
                </div>
                <div class="col-lg-2" id="asha_list">
                 <input type="text" class="form-control" name="search_asha" placeholder="From Asha list" id="search_asha">
                 <input type="hidden" class="form-control" name="asha_id" id="asha_id">
                </div>
                <div class="col-lg-2" id="runner_list">
                 <input type="text" class="form-control" name="search_runner" placeholder="From Runner list" id="search_runner">
                 <input type="hidden" class="form-control" name="runner_id" id="runner_id">
                </div>
                <div class="col-lg-2" id="centre_list">
                 <input type="text" class="form-control" name="search_centre" placeholder="From Centre list" id="search_centre">
                 <input type="hidden" class="form-control" name="centre_id" id="centre_id">
                </div>  	
                
                <!--************************* new box for new Dr, Asha, Runner, Centre******************************************** -->               
                <label for="inputReffered" class="col-lg-2 control-label" id="label_new">Name</label>
                
                <div class="col-lg-2" id="new_dr">
                 <input type="text" class="form-control" name="new_dr_name" placeholder="New Doctor" id="new_dr_name">
                </div>
                <div class="col-lg-2" id="dr_checkbox">
                 <label class="checkbox-inline"><input type="checkbox" id="check_dr" name="check_dr" > Not in list</label>
                 </div>
                 
                <div class="col-lg-2" id="new_asha">
                 <input type="text" class="form-control" name="asha_name" placeholder="New ASHA" id="asha_name">
                </div>	
                <div class="checkbox-inline" id="asha_checkbox">
                 <label class="checkbox-inline"><input type="checkbox" id="check_asha" name="check_asha"> Not in list </label>
                 </div>
                
                <div class="col-lg-2" id="new_runner">
                 <input type="text" class="form-control" name="runner_name" placeholder="New Runner" id="runner_name">
                </div>
                <div class="checkbox-inline" id="runner_checkbox">
                 <label class="checkbox-inline"><input type="checkbox" id="check_runner" name="check_runner"> Not in list</label>
                 </div>
                
                <div class="col-lg-2" id="new_centre">
                 <input type="text" class="form-control" name="centre_name" placeholder="New Centre" id="centre_name">
                </div>
                <div class="checkbox-inline" id="centre_checkbox">
                 <label class="checkbox-inline"><input type="checkbox" id="check_centre" name="check_centre"> Not in list</label>
                 </div>		
 <!--************************* END new box for new Dr, Asha, Runner, Centre******************************************** --> 
            </div>		   
    </div>
    
    <div class="panel panel-info">
       <div class="panel-heading">Investigation Details</div>       
       <div class="form-group row_line">
       <label id="reference" name="reference" class="col-lg-1">#</label>
       <label id="reference" name="reference" class="col-lg-1"></label>
       <label id="reference" name="reference" class="col-lg-3">Investigation</label>
       <label id="reference" name="reference" class="col-lg-1"></label>
       <label id="reference" name="reference" class="col-lg-2">Price</label>
       </div>
         <div class="form-group clonedInput" id="entry1">
         <label id="sl_no" name="sl_no" class="col-lg-1 sl_no">1.</label>
           <label for="inputReffered" class="col-lg-1 control-label label_test_name"></label>
                <div class="col-lg-3">
                  <input type="text" class="form-control test_name" id="test_name" placeholder="Enter Test Name" name="test_name">
                </div>
                
                <label for="inputReffered" class="col-lg-1 control-label label_test_price"></label>
                <div class="col-lg-2" id="price_div">
                  <input type="text" class="form-control test_price test_price" id="test_price" placeholder="Rs." name="test_price" readonly>
                </div>
                <div>
                <input type="button" id="" class="btn btn-mini btn-danger" value="Remove">
                </div>
           </div>
        <div id="addDelButtons">
        <input type="button" id="btnAdd" class="btn btn-mini btn-primary" value="Add Test">&nbsp;
        <input type="button" id="btnDel" class="btn btn-mini btn-danger" value="Remove">
    </div>	   
    </div>
    <div class="panel panel-info">
         <div class="panel-heading">Payment Details</div>
          <div class="form-group">
             <label for="Total_amount" class="col-lg-2 control-label ">Total Amount :</label>
              <div class="col-lg-2">
            <input type="text" class="form-control" id="total_amt" name="total_amt" placeholder="Rs." readonly>
            </div>
            <label for="Total_amount" class="col-lg-2 control-label ">Service Tax :</label>
            <div class="col-lg-2">
            <label class="radio-inline">
              <input type="radio" name="radio" id="tax_yes" value="tax_no" checked> No
            </label>
            <label class="radio-inline">
              <input type="radio" name="radio" id="tax_yes" value="tax_yes"> Yes
            </label>
           </div>    
           <label for="inputTestName" class="col-lg-2 control-label" id="label_e">Tax Amount :</label>
              <div class=" form-inline col-lg-2" id="disc_code">
                <input type="text" class="form-control" id="inputTestName" placeholder="Tax in %">
              </div>       
        </div>
        <div class="form-group">
        <label for="Discount" class="col-lg-2 control-label">Discount :</label>
           <div class="col-lg-3">
            <label class="radio-inline">
              <input type="radio" name="disc_radio" id="radio1" value="no" checked> No
            </label>
            <label class="radio-inline">
              <input type="radio" name="disc_radio" id="radio3" value="amt"> Rs
            </label>
            <label class="radio-inline">
              <input type="radio" name="disc_radio" id="radio2" value="per"> (%)
            </label>                     
           </div>
                
          <div class="form-inline" id="discount">
          <label for="inputTestName" class="col-lg-1 control-label" id="label_disc_code">Code :</label>
              <div class="col-lg-2" id="disc_code">
                <input type="text" class="form-control" id="inputTestName" placeholder="Disc Code">
              </div>
           <label for="inputTestName" class="col-lg-2 control-label" id="label_disc_value">Dis Am :</label>
              <div class="col-lg-2" id="div_disc_amt">
                <input type="text" class="form-control" id="disc_amt" placeholder="Disc in amount">
              </div>  
            <label for="inputTestName" class="col-lg-2 control-label" id="label_disc_per">Disc Per(%) :</label>
              <div class="col-lg-2" id="div_disc_per">
                <input type="text" class="form-control" id="disc_per" placeholder="Disc in %">
              </div>          
          </div>
          </div>
          <div class="form-group">
            <label for="inputTestName" class="col-lg-2 control-label">Net Amount :</label>
              <div class="col-lg-2">
                <input type="text" class="form-control" id="net_amount" placeholder="Rs." readonly>
              </div>
            <label for="inputTestName" class="col-lg-2 control-label">Paid Amount :</label>
              <div class="col-lg-2">
                <input type="text" class="form-control" id="paid_amount" placeholder="Rs.">
              </div>
            <label for="due_amount" class="col-lg-2 control-label">Due Amount :</label>
              <div class="col-lg-2">
                <input type="text" class="form-control" id="due_amount" placeholder="Rs." readonly>
              </div>
            </div>
        </div>
        <div class="form-group">
        <div class="col-lg-offset-5 col-lg-7">
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
    </form>
</div>
	 <div class="clear"></div>
	</div>
<?php include("footer.php"); ?>
   <script src="js/bootstrap.js"></script>
    <script src="js/jquery-1.10.1.min.js"></script>
	<script src="js/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
   <script src="js/patient_registration.js"></script>
  </body>
</html>