<?php include("function.php");?>
<?php include("header.php");?>
	<div class="container">
		<?php include("side_bar.php");?>	
		<div class="page-content">
		<div class="inv-main">
		<form class="form-horizontal inv-form" role="form" id="doctor_profile_form" name="doctor_profile_form" method="get" action="doctor_reg.php">
			<div class="panel panel-info">
				  <!-- Default panel contents -->
				  <div class="panel-heading">Doctor Information</div>
				  <!--div class="panel-body">
				    <p>...</p>
				  </div-->
				 <div class="form-group control-group">
				    <label for="inputName" class="col-lg-2 control-label">Name</label>
				    <div class="col-lg-3">
				      <input type="text" class="form-control" id="doctor_name" name="doctor_name" placeholder="Doctor's name">
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
                <label for="inputName" class="col-lg-1 control-label">DOB</label>
				    <div class="col-lg-2">
				      <input type="text" class="form-control" id="doctor_name" name="doctor_name" placeholder="Date of Birth">
				    </div>
				  </div>
				  
					<div class="form-group control-group">
                     <label for="inputMstaus" class="col-lg-2 control-label">Marital Status</label>
					    <div class="col-lg-3">
					      <select class="form-control" id="marital_status" name="marital_status">
							  <option value="1">Unmarried</option>
							  <option value="2">Married</option>
							  <option value="3">Single</option>
							  <option value="4">Widow</option>
							  <option value="5">Widower</option>
						 </select>
					    </div>
				    <label for="inputSpecialization" class="col-lg-1 control-label">Specialtn</label>
				    <div class="col-lg-3">
				      <input type="text" class="form-control" id="doctor_specialization" name="doctor_specialization" placeholder="Specialization">
				    </div>
                   <label for="inputDesignation" class="col-lg-1 control-label">Designtn</label>
				    <div class="col-lg-2">
				      <input type="text" class="form-control" id="doctor_designation" name="doctor_designation" placeholder="Designation">
				    </div>
				  </div>
				  		  
				<div class="form-group control-group">
				    <label for="inputInstitute" class="col-lg-2 control-label">Institute</label>
				    <div class="col-lg-3">
				      <input type="text" class="form-control" id="doctor_institute"  name="doctor_institute" placeholder="Institute">
				    </div>
                    <label for="inputEmail" class="col-lg-1 control-label">Email</label>
				    <div class="col-lg-3">
				      <input type="text" class="form-control" id="doctor_email" name="doctor_email" placeholder="silheiba@example.com">
				    </div>
                    <label for="inputContact" class="col-lg-1 control-label">Phone</label>
					    <div class="col-lg-2">
					      <input type="text" class="form-control" id="doctor_mobile" name="doctor_mobile" placeholder="Contact No.">
					    </div>                    
				  </div>
				  	  	
				  <div class="form-group control-group">
					    <label for="inputAddress" class="col-lg-2 control-label">Address</label>
					    <div class="col-lg-3">
					      <input type="text" class="form-control" id="doctor_address" name="doctor_address">
					    </div>
                        <label for="inputState" class="col-lg-1 control-label">State</label>
					    <div class="col-lg-3">
					      <input type="text" class="form-control" id="doctor_state" name="doctor_state">
					    </div>
                        <label for="inputDistrict" class="col-lg-1 control-label">District</label>
					    <div class="col-lg-2">
					      <select class="form-control" name="doctor_district">
							  <option value="1">Imphal West</option>
							  <option value="2">Imphal East</option>
							  <option value="3">Thoubal</option>
							  <option value="4">Bishnupur</option>
							  <option value="5">Churachandpur</option>
							  <option value="6">Chandel</option>
							  <option value="7">Senapati</option>
							  <option value="8">Tamenglong</option>
							  <option value="9">Ukhrul</option>
						 </select>
					    </div>
                        
				  	</div>
				  	
				  	<div class="form-group">
                    <label for="inputPin" class="col-lg-2 control-label">Pin Code</label>
					    <div class="col-lg-3">
					      <input type="text" class="form-control" id="doctor_pin" name="doctor_pin">
					    </div>
					    <label for="inputSex" class="col-lg-1 control-label">Clinic</label>
                <div class="col-lg-3">					      
                      <label class="radio-inline">
                        <input  type="radio" name="patient_sex" id="optionsRadios1" value="1">Yes
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="patient_sex" id="optionsRadios2" value="2">No
                      </label>
                </div>	
		</div>	  	
			</div>
            
             <div class="panel panel-info">   <!---------------------------------- START Clinic section --------------------------------->				  				  <div class="panel-heading">Clinic Information</div>
				  	 <div class="form-group control-group">
				    <label for="inputName" class="col-lg-2 control-label">Clinic Name</label>
				    <div class="col-lg-3">
				      <input type="text" class="form-control" id="doctor_name" name="doctor_name" placeholder="Doctor's name">
				    </div>
                    <label for="inputAddress" class="col-lg-1 control-label">Address</label>
					    <div class="col-lg-3">
					      <input type="text" class="form-control" id="doctor_address" name="doctor_address">
					    </div>
                    <label for="inputContact" class="col-lg-1 control-label">Phone</label>
					    <div class="col-lg-2">
					      <input type="text" class="form-control" id="doctor_mobile" name="doctor_mobile" placeholder="Contact No.">
					    </div>  
				  </div>
				  <div class="form-group control-group">
                    <label for="inputState" class="col-lg-2 control-label">State</label>
					    <div class="col-lg-3">
					      <input type="text" class="form-control" id="doctor_state" name="doctor_state">
					    </div>
                        <label for="inputDistrict" class="col-lg-1 control-label">District</label>
					    <div class="col-lg-3">
					      <select class="form-control" name="doctor_district">
							  <option value="1">Imphal West</option>
							  <option value="2">Imphal East</option>
							  <option value="3">Thoubal</option>
							  <option value="4">Bishnupur</option>
							  <option value="5">Churachandpur</option>
							  <option value="6">Chandel</option>
							  <option value="7">Senapati</option>
							  <option value="8">Tamenglong</option>
							  <option value="9">Ukhrul</option>
						 </select>
					    </div>
                        <label for="inputPin" class="col-lg-1 control-label">PIN</label>
					    <div class="col-lg-2">
					      <input type="text" class="form-control" id="doctor_pin" name="doctor_pin">
					    </div>
				  	</div>  	
            </div>  <!------------------------------------------- END Clinic section -------------------------------------------------------->
			
            
            <div class="panel panel-info">    <!------------------------START Doctor's Family section ------------------>				  				 				<div class="panel-heading">Doctor's Family Information</div>
				  	 <div class="form-group control-group">
				    <label for="inputName" class="col-lg-2 control-label">Name</label>
				    <div class="col-lg-3">
				      <input type="text" class="form-control" id="doctor_name" name="doctor_name" placeholder="Name">
				    </div>
                    <label for="inputAddress" class="col-lg-1 control-label">Relation</label>
					    <div class="col-lg-3">
					      <input type="text" class="form-control" id="doctor_address" name="doctor_address">
					    </div>
                    <label for="inputContact" class="col-lg-1 control-label">DOB</label>
					    <div class="col-lg-2">
					      <input type="text" class="form-control" id="doctor_mobile" name="doctor_mobile" placeholder="Contact No.">
					    </div>  
				  </div>
                   <div id="addDelButtons">
        <input type="button" id="btnAdd" class="btn btn-mini btn-primary" style="background-image:url(images/add.png); width:20px; height:20px; border:none; background-color:#FFF;">&nbsp;
        <input type="button" id="btnDel" class="btn btn-mini btn-danger" style="background-image:url(images/delete.png); width:20px; height:20px; border:none; background-color:#FFF;">
    </div>	   
				 </div>  	
            </div>  <!------------------------------------------- END Doctor's Family section ---------------------------------------->
			
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="form-group">
			    <div class="col-lg-offset-5 col-lg-7">
			      <button type="submit" class="btn btn-primary" id="doctor_submit" name="doctor_submit">Submit</button>
			    </div>
			 </div>

		</form>
		</div>
		</div>
		<div class="clear"></div>
	</div>
<?php include("footer.php"); ?> 
</body>
</html>