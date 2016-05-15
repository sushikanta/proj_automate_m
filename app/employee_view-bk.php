<?php require_once("check_login_hr.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Employee view</title>
<?php require_once("css_bootstrap_datatable_header.php");?>

<body id="myBody">
<?php require_once("right_top_header_hr.php");?>
<div class="container">
 <div class="page-content">
  <div class="inv-main">
  
<?php
if(isset($_GET['ei_id']) && $_GET['ei_id'] !="")
	{
 		$ei_id = $_GET['ei_id'];
 
 $result1 = mysqli_query($con, "SELECT e.EI_name, e.EI_dob, e.EI_email, e.EI_phone, e.EI_emergency, e.EI_address, e.EI_pin, c.ECA_ei_id, c.ECA_address,  c.ECA_pin, s.state_name AS perm_state, d.district_name AS perm_district, s1.state_name AS cur_state, d1.district_name AS cur_district, m.marital_name, g.gender_name, t.ET_emp_no, t.ET_dept_id, t.ET_desig_id, t.ET_report_to, t.ET_join_date, t.ET_salary, t.ET_ctc, t.ET_status, n.designation_name AS position, n1.designation_name AS report_to, department_tbl.department_name FROM emp_info e LEFT JOIN emp_cur_address c ON e.EI_id = c.ECA_ei_id LEFT JOIN state_tbl s ON s.state_id = e.EI_state LEFT JOIN district_tbl d ON d.district_id = e.EI_district LEFT JOIN state_tbl s1 ON s1.state_id = c.ECA_state LEFT JOIN district_tbl d1 ON d1.district_id = c.ECA_district LEFT JOIN marital_tbl m ON m.marital_id = e.EI_marital LEFT JOIN gender_tbl g ON g.gender_id = e.EI_gender LEFT JOIN emp_tbl t ON t.ET_ei_id = e.EI_id LEFT JOIN designation_tbl n ON n.designation_id = t.ET_desig_id LEFT JOIN designation_tbl n1 ON n1.designation_id = t.ET_report_to LEFT JOIN department_tbl ON department_tbl.department_id = t.ET_dept_id WHERE e.EI_id = '$ei_id'");
 if(mysqli_num_rows($result1) !=0){
  while($row1 = mysqli_fetch_array($result1))
  {	  
  	  $EI_name = $row1['EI_name'];
	  $EI_dob = date("d-M-Y", strtotime($row1['EI_dob']));
	  $gender_name = $row1['gender_name'];
	  $marital_name = $row1['marital_name'];  	  
	  $EI_email = $row1['EI_email'];
	  
	  $EI_phone = $row1['EI_phone'];
	  $EI_emergency = $row1['EI_emergency'];
  	  $EI_address = $row1['EI_address'];
	  
	  $perm_state = $row1['perm_state'];
	  $perm_district = $row1['perm_district'];
  	  $EI_pin = $row1['EI_pin'];
	  
	  $ET_emp_no = $row1['ET_emp_no'];
	  $ET_join_date = date("d-M-Y", strtotime($row1['ET_join_date']));
	  $ET_salary = $row1['ET_salary'];
	  $ET_ctc = $row1['ET_ctc'];
	  $ET_status = $row1['ET_status'];
	  $position = $row1['position'];
	  $report_to = $row1['report_to'];
	  $department_name = $row1['department_name'];
	 
	  $ECA_ei_id = $row1['ECA_ei_id'];
	  if( $ECA_ei_id !=""){
  	  $ECA_address = $row1['ECA_address'];
	  $cur_state = $row1['cur_state'];
	  $cur_district = $row1['cur_district']; 
	  $ECA_pin = $row1['ECA_pin'];}
	  }
	  
 ?>  
  <!--PANEL 1 - PERSONAL -->
  <div class="panel panel-success"> 			
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Employee <span class="panel-subTitle"> ( Personal Info ) </span>
   	 <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
   </div>	 
 <div class="panel-body">                              
<table cellpadding="0" cellspacing="0" border="0" class="table-striped" style="width:90%; margin-left:5%;">
  <thead align="left">
  </thead>
  <tbody>
  <tr> 
     <td><label>Name : </label> <?php echo $EI_name;?></td>
     <td><label>Gender : </label> <?php echo $gender_name;?></td>
     <td><label>Marital : </label> <?php echo $marital_name;?></td>
  </tr>  
  <tr>      
     <td><label>Email : </label> <?php echo $EI_email;?></td>
     <td><label>Phone : </label> <?php echo $EI_phone;?></td>
     <td><label>Emergency : </label> <?php echo $EI_emergency;?></td>
  </tr>
  
  <tr> 
    <td colspan="3"><label>Address : </label> <?php echo $EI_address;?>, <?php echo $perm_district;?> <?php echo $perm_state;?> -  <?php echo $EI_pin;?></td>
    
  </tr>
  
  <?php 
  if( $ECA_ei_id !=""){
	  ?>
        <tr>
        <td colspan="3"><label>Cur.Address : </label> <?php echo $ECA_address;?>, <?php echo $cur_district;?> <?php echo $cur_state;?> -  <?php echo $ECA_pin;?></td>
        </tr>
   <?php
   } 
  ?>
	
    <tr>      
     <td><label>Emp No # : </label> <?php echo $ET_emp_no;?></td>
     <td><label>Position : </label> <?php echo $position;?></td>
     <td><label>Department : </label> <?php echo $department_name;?></td>
  </tr>
  <tr>      
     <td><label>Salary : </label> <?php echo $ET_salary;?></td>
     <td><label>CTC : </label> <?php echo $ET_ctc;?></td>
     <td><label>Joined date : </label> <?php echo $ET_join_date;?></td>
  </tr>
 <tr>      
     <td><label>Report To : </label> <?php echo $report_to;?></td>
     <td><label>Status : </label> <?php if($ET_status =='1'){echo 'Active';}if($ET_status =='2'){echo 'Relieved';}?></td>
  </tr>
</tbody>
</table>
</div>
<div class="row">
    <div class="col-lg-offset-4 col-lg-4">
     <a href="employee_edit.php?ei_id=<?php echo $ei_id;?>"><button type="submit" class="btn btn-primary btn-block" style="font-size:16px;" name="edit">Edit</button></a>
    </div>
    </div>
        </div>
<div class="clear"></div>
 <?php
} }
?>


<!--PANEL 1 - FAMILY -->
  <div class="panel panel-success"> 			
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Employee <span class="panel-subTitle"> ( Family Info ) </span>
     </h3>
   </div>	

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display" id="family_tbl">
   <thead align="left">
      <tr>
      <th> # </th>
      <th> Relation</th>
      <th> Name</th>
      <th> Occupation</th> 
      <th> Date of Birth</th>
      </tr>
   </thead>     
  <tbody>
<?php
$result2 = mysqli_query($con, "SELECT f.EF_id, f.EF_name, f.EF_ei_id, f.EF_occupation, f.EF_dob, r.RT_name FROM emp_family f LEFT JOIN relation_type r ON r.RT_id = f.EF_type WHERE f.EF_ei_id = '$ei_id'");
$sl_2=1;
while ($row2 = mysqli_fetch_array($result2))
{   
 	$EF_id = $row2['EF_id'];
	//$EF_type = $row2['EF_type'];
	$RT_name = $row2['RT_name'];
	$EF_name = $row2['EF_name'];
	$EF_occupation = $row2['EF_occupation'];
	$EF_dob1 = $row2['EF_dob'];
	if($EF_dob1 !='0000-00-00'){ $EF_dob = date("d-M-Y", strtotime($row2['EF_dob']));}		
	?>
          <tr id="<?php echo $EF_id; ?>">
            <td><?php echo $sl_2; ?></td>
            <td><?php echo $RT_name; ?></td>
            <td><?php echo $EF_name; ?></td>  
            <td><?php echo $EF_occupation; ?></td>
            <td><?php if($EF_dob1 !='0000-00-00'){echo $EF_dob;}else{echo "";} ?></td>
          </tr>
       <?php
 $sl_2++;
}
?>
	</tbody>   
 </table>


<!------  form  family ---------->
<form id="formFamily" method="post" action="#" title="Add New"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_messageF" style="display:none" title="Processing">Please wait while processing....</div>
     
<div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="sl_no" class="form-control" value="<?php echo $sl_2;?>" readonly rel="0">
  <input type="hidden" name="emp_info" value="<?php echo $ei_id;?>">
  </div>
  </div></div>
  <br/>

 <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="relation">Relation :</label>       
  <div class="col-lg-7 padding_gap">
  <select name="relation" class="form-control" autofocus rel="1">
 		<option value="">Select Status</option>
	<?php $result3 = mysqli_query($con, "SELECT RT_id, RT_name FROM relation_type");
          while($row3 = mysqli_fetch_array($result3)) {?>
          <option value="<?php echo $row3['RT_id'];?>"><?php echo $row3['RT_name']; ?></option>          
<?php } ?>
	</select>
   </div></div></div>
  <br/>
    
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="name">Name :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="name" id="name" class="form-control capital" placeholder="Name" maxlength="50" rel="2"/>
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="occupation">Occupation :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control capital" name="occupation" placeholder="Occupation" maxlength="50" rel="3" />
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="fdob">DOB :</label>
   <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control" name="fdob" id="fdob" placeholder="Date of birth" readonly rel="4" />
     </div></div></div>
  <br/>
  <br/>             
</form>
<button id="btnDeleteRowF">Delete</button> <button id="btnAddNewRowF">Add</button>
</div>
</div>
  
<!--------PANEL 1 - Qualification -------->
  <div class="panel panel-success"> 			
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Employee <span class="panel-subTitle"> ( Qualification Info ) </span>
     </h3>
   </div>	

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display" id="qualf_tbl">
   <thead align="left">
      <tr>
      <th> # </th>
      <th> Course</th>
      <th> Faculty</th>
      <th> Institute</th>
      <th> Board/Univ</th> 
      <th> Mark</th>
      <th> Total</th>
      <th> Grade(%)</th>
      <th> Result</th>
      <th> Dur(Y)</th>
      <th> Dur(M)</th>
      <th> Pass Year</th>
      </tr>
   </thead>     
  <tbody>
<?php
$resultQ = mysqli_query($con, "SELECT EQ_id, EQ_ei_id, EQ_course, EQ_faculty, EQ_institute, EQ_univ, EQ_mark, EQ_total, EQ_grad, EQ_result, EQ_pass_date, EQ_duration_year, EQ_duration_month FROM emp_qualification WHERE EQ_ei_id = '$ei_id'");
$sl_Q=1;
while ($rowQ = mysqli_fetch_array($resultQ))
{   
 	$EQ_id = $rowQ['EQ_id'];
	$EQ_course = $rowQ['EQ_course'];
	$EQ_faculty = $rowQ['EQ_faculty'];
	$EQ_institute = $rowQ['EQ_institute'];
	$EQ_univ = $rowQ['EQ_univ'];
	$EQ_mark = $rowQ['EQ_mark'];
	$EQ_total = $rowQ['EQ_total'];
	$EQ_grad = $rowQ['EQ_grad'];
	$EQ_result = $rowQ['EQ_result'];
	
	$EQ_duration_year = $rowQ['EQ_duration_year'];
	$EQ_duration_month = $rowQ['EQ_duration_month'];
	$_EQ_pass_date = $rowQ['EQ_pass_date'];
	if($_EQ_pass_date !='0000-00-00'){ $EQ_pass_date = date("d-M-Y", strtotime($_EQ_pass_date));}else{$EQ_pass_date ="";}
	?>
          <tr id="<?php echo $EQ_id; ?>">
            <td><?php echo $sl_Q; ?></td>
            <td><?php echo $EQ_course; ?></td>
            <td><?php echo $EQ_faculty; ?></td>
            <td><?php echo $EQ_institute; ?></td>  
            <td><?php echo $EQ_univ; ?></td>
            <td><?php echo $EQ_mark; ?></td>
            <td><?php echo $EQ_total; ?></td>
            <td><?php echo $EQ_grad; ?></td>  
            <td><?php echo $EQ_result; ?></td>
            <td><?php echo $EQ_duration_year; ?></td>
            <td><?php echo $EQ_duration_month; ?></td>
            <td><?php echo $EQ_pass_date; ?></td> 
          </tr>
       <?php
 $sl_Q++;
}
?>
	</tbody>   
 </table>


<!---- form QUALIFICATION ----------->
<form id="formQualf" method="post" action="#" title="Add New"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_messageQ" style="display:none" title="Processing">Please wait while processing....</div>
     
<div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="sl_no" class="form-control" value="<?php echo $sl_Q;?>" readonly rel="0">
  <input type="hidden" name="emp_info" value="<?php echo $ei_id;?>">
  </div>
  </div></div>
  <br/>

 <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="course">Course :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="course" class="form-control capital" placeholder="Course Name" autofocus rel="1" maxlength="100">
   </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="faculty">Faculty :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="faculty" class="form-control capital" placeholder="Faculty / streams" rel="2" maxlength="50">
   </div></div></div>
  <br/>
    
  <div class="form-group padding_gap"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="institute">Institute :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="institute" class="form-control capital" placeholder="Institute" rel="3"  maxlength="50"/>
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="occupation">Board/Univ :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control capital" name="university" placeholder="Board/Univ" maxlength="50" rel="4" />
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="mark_obt">Mark Obtained :</label>
   <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control" name="mark_obt" placeholder="Mark Obitained" maxlength="5" rel="5" />
     </div></div></div>
  <br/>
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="total_mark">Total Mark :</label>
   <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control" name="total_mark" placeholder="Total Mark"  maxlength="5" rel="6" />
     </div></div></div>
  <br/>
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="grade">Grad/Percentage :</label>
   <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control" name="grade" placeholder="Grad/Percentage" maxlength="10" rel="7" />
     </div></div></div>
  <br/>
   <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="result">Result :</label>
   <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control" name="result" placeholder="Grade/Result" rel="8" />
     </div></div></div>
  <br/>
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="duration_y">Duration (Years) :</label>
   <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control" name="duration_y" placeholder="Course Duration in Year" maxlength="2" rel="9" />
     </div></div></div>
  <br/>
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="duration_m">Duration (Months) :</label>
   <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control" name="duration_m" placeholder="Course Duration in Month" maxlength="2" rel="10" />
     </div></div></div>
  <br/>
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="passing_date">Passing Date :</label>
   <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control" name="passing_date" id="passing_date" placeholder="Course Pass date" readonly rel="11" />
  </div></div></div>
  <br/>
 <div class="text-right"> 
  <button id="btnAddNewRowCancelQ">Cancel</button>
  <button id="btnAddNewRowOkQ">Okay</button>
  </div>
   <br/>
</form>
<button id="btnDeleteRowQ">Delete</button>
<button id="btnAddNewRowQ">Add</button> 
<!--<div class="add_delete_toolbar"/> -->
</div>
</div>   

  <!-------------PANEL 4 - prev_experience ----------------->
  <div class="panel panel-success"> 			
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Employee <span class="panel-subTitle"> ( Experience Info ) </span>
     </h3>
   </div>	

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display" id="exp_tbl">
   <thead align="left">
      <tr>
      <th> # </th>
      <th> Organisation</th>
      <th> Address</th>
      <th> Position</th>
      <th> Department</th> 
      <th> Join Date</th>
      <th> Exit Date</th>
      </tr>
   </thead>     
  <tbody>
<?php
$resultE = mysqli_query($con, "SELECT PE_id, PE_org, PE_address, PE_dept, PE_position, PE_joined_date, PE_exit_date FROM emp_prev_experience WHERE PE_ei_id = '$ei_id'");
$sl_E=1;
while ($rowE = mysqli_fetch_array($resultE))
{   
 	$PE_id = $rowE['PE_id'];
	$PE_org = $rowE['PE_org'];
	$PE_address = $rowE['PE_address'];
	$PE_dept = $rowE['PE_dept'];
	$PE_position = $rowE['PE_position'];
	
	$PE_joined_date = date("d-M-Y", strtotime($rowE['PE_joined_date']));
	$PE_exit_date = date("d-M-Y", strtotime($rowE['PE_exit_date']));
	?>
          <tr id="<?php echo $PE_id; ?>">
            <td><?php echo $sl_E; ?></td>
            <td><?php echo $PE_org; ?></td>
            <td><?php echo $PE_address; ?></td> 
            <td><?php echo $PE_position; ?></td>
            <td><?php echo $PE_dept; ?></td> 
            <td><?php echo $PE_joined_date; ?></td>
            <td><?php echo $PE_exit_date; ?></td>
          </tr>
       <?php
 $sl_E++;
}
?>
	</tbody>   
 </table>


<!---- form QUALIFICATION ----------->
<form id="formExp" method="post" action="#" title="Add New"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_messageE" style="display:none" title="Processing">Please wait while processing....</div>
     
<div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="sl_no" class="form-control" value="<?php echo $sl_E;?>" readonly rel="0" required>
  <input type="hidden" name="emp_info" value="<?php echo $ei_id;?>">
  </div>
  </div></div>
  <br/>

 <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="prev_org">Organisation :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="prev_org" class="form-control capital" placeholder="Prev. Comapnay Name" autofocus rel="1" maxlength="100" required>
   </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="address">Address :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="address" class="form-control capital" placeholder="Address" rel="2" maxlength="200" required>
   </div></div></div>
  <br/>
    
  <div class="form-group padding_gap"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="position">Position :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="position" class="form-control capital" placeholder="Job Position" rel="3"  maxlength="20" required>
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="department">Department :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control capital" name="department" placeholder="Department name" rel="4"  maxlength="20" required>
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="join_date">Joined Date :</label>
   <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control" name="join_date" id="join_date" placeholder="Joined date " rel="5" readonly required>
     </div></div></div>
  <br/>
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="exit_date">Relieved Date :</label>
   <div class="col-lg-7 padding_gap">
  <input type="text" class="form-control" name="exit_date" id="exit_date" placeholder="Exit Date" rel="6" readonly required>
     </div></div></div>
  <br/>
  <br/>
 <div class="text-right"> 
  <button id="btnAddNewRowCancelE">Cancel</button>
  <button id="btnAddNewRowOkE">Okay</button>
  </div>
   <br/>
</form>
<button id="btnDeleteRowE">Delete</button>
<button id="btnAddNewRowE">Add</button> 
<!--<div class="add_delete_toolbar"/> -->
</div>
</div>


 <!-------------PANEL 5 - Letter sent  ----------------->
  <div class="panel panel-success"> 			
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Employee <span class="panel-subTitle"> ( Letter Sent Info ) </span>
     </h3>
   </div>	

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display" id="letter_tbl">
   <thead align="left">
      <tr>
      <th> # </th>
      <th> Letter</th>
      <th> Remark</th>
      <th> Sent Date</th>
      </tr>
   </thead>     
  <tbody>
<?php
$resultL = mysqli_query($con, "SELECT l.EL_id, l.EL_remark, l.EL_date, t.letter_type FROM emp_letter l LEFT JOIN letter_type_tbl t ON t.letter_type_id = l.EL_type WHERE EL_ei_id = '$ei_id'");
$sl_L=1;
while ($rowL = mysqli_fetch_array($resultL))
{   
 	$EL_id = $rowL['EL_id'];
	$letter_type = $rowL['letter_type'];
	$EL_remark = $rowL['EL_remark'];
	$EL_date = date("d-M-Y", strtotime($rowL['EL_date']));
	?>
          <tr id="<?php echo $EL_id; ?>">
            <td><?php echo $sl_L; ?></td>
            <td><?php echo $letter_type; ?></td>
            <td><?php echo $EL_remark; ?></td>
            <td><?php echo $EL_date; ?></td>
          </tr>
       <?php
 $sl_E++;
}
?>
	</tbody>   
 </table>


<!---- form letter sent ----------->
<form id="formLetter" method="post" action="#" title="Add New"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_messageL" style="display:none" title="Processing">Please wait while processing....</div>
     
<div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="sl_no" class="form-control" value="<?php echo $sl_L;?>" readonly rel="0" required>
  <input type="hidden" name="emp_info" value="<?php echo $ei_id;?>">
  </div>
  </div></div>
  <br/>

 <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="type">Letter Type :</label>       
  <div class="col-lg-7 padding_gap">
   <select name="type" class="form-control" autofocus rel="1" required>
 		<option value="">Select Status</option>
	<?php $resultT = mysqli_query($con, "SELECT letter_type_id, letter_type FROM letter_type_tbl");
          while($rowT= mysqli_fetch_array($resultT)) {?>
          <option value="<?php echo $rowT['letter_type_id'];?>"><?php echo $rowT['letter_type']; ?></option>          
<?php } ?>
	</select>
   </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="remark">Remark :</label>       
  <div class="col-lg-7 padding_gap">
  <textarea type="text" name="remark" class="form-control capital" placeholder="Remark/Reasons" rel="2" maxlength="200" required></textarea>
   </div></div></div>
  <br/>
    
  <div class="form-group padding_gap"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="position">Sent Date :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="sent_date" class="form-control capital" id="sent_date" placeholder="Date" rel="3" required readonly>
  </div></div></div>
  <br/>
  <br/>
 <div class="text-right"> 
  <button id="btnAddNewRowCancelL">Cancel</button>
  <button id="btnAddNewRowOkL">Okay</button>
  </div>
   <br/>
</form>
<button id="btnDeleteRowL">Delete</button>
<button id="btnAddNewRowL">Add</button> 
<!--<div class="add_delete_toolbar"/> -->
</div>
</div>  

 <!-------------PANEL 6 - Exit sent  ----------------->
  <div class="panel panel-success"> 			
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Employee <span class="panel-subTitle"> ( Relieved Info ) </span>
     </h3>
   </div>

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered display" id="exit_tbl">
   <thead align="left">
      <tr>
      <th> # </th>
      <th> Reason</th>
      <th> Relieve Date</th>
      </tr>
   </thead>     
  <tbody>
<?php
$resultX = mysqli_query($con, "SELECT EE_id, EE_reason, EE_date FROM emp_exit_tbl WHERE EE_ei_id = '$ei_id'");
$sl_x=1;
while ($rowX = mysqli_fetch_array($resultX))
{   
 	$EE_id = $rowX['EE_id'];
	$EE_reason = $rowX['EE_reason'];
	$EE_date = date("d-M-Y", strtotime($rowX['EE_date']));
	?>
          <tr id="<?php echo $EE_id; ?>">
            <td><?php echo $sl_x; ?></td>
            <td><?php echo $EE_reason; ?></td>
            <td><?php echo $EE_date; ?></td>
          </tr>
       <?php
 $sl_x++;
}
?>
	</tbody>   
 </table>


<!---- form QUALIFICATION ----------->
<form id="formExit" method="post" action="#" title="Add New"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_messageX" style="display:none" title="Processing">Please wait while processing....</div>
     
<div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="sl_no" class="form-control" value="<?php echo $sl_x;?>" readonly rel="0" required>
  <input type="hidden" name="emp_info" value="<?php echo $ei_id;?>">
  </div>
  </div></div>
  <br/>  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="reason">Reason :</label>       
  <div class="col-lg-7 padding_gap">
  <textarea name="reason" class="form-control capital" placeholder="Reason" rel="1" maxlength="100" required autofocus></textarea>
   </div></div></div>
  <br/>
    
  <div class="form-group padding_gap"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="exit_date">Relieve Date :</label>       
  <div class="col-lg-7 padding_gap">
  <input type="text" name="exit_date" class="form-control capital" id="relieve_date" placeholder="Date" rel="2" required readonly>
  </div></div></div>
  <br/>
  <br/>
 <div class="text-right"> 
  <button id="btnAddNewRowCancelX">Cancel</button>
  <button id="btnAddNewRowOkX">Okay</button>
  </div>
   <br/>
</form>
<button id="btnDeleteRowX">Delete</button>
<button id="btnAddNewRowX">Add</button> 
<!--<div class="add_delete_toolbar"/> -->
</div>
</div>  

</div>
<div class="clear"></div>
</div>

<?php include("footer.php"); ?> 
<?php include("script_bootstrap_datatable.php"); ?>  
<script charset="utf-8" type="text/javascript" src="js/employee_view.js"></script>
</body>
</html>
<?php ob_flush();?>