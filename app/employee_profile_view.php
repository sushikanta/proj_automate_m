<?php require_once("check_login_hr.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Employee Profile</title>
<?php require_once("css_bootstrap_header.php");?>
<?php require_once("print-borderless-ac.php");?>

<body id="myBody">
<?php require_once("right_top_header_popup.php");?>
<div class="container">
 <div class="page-content">
  <div class="inv-main">
  
<?php
if(isset($_GET['ei_id']) && $_GET['ei_id'] !="")
 { $ei_id = $_GET['ei_id'];
 
 $result1 = mysqli_query($con, "SELECT e.EI_name, e.EI_dob, e.EI_email, e.EI_phone, e.EI_emergency, e.EI_address, e.EI_pin, c.ECA_ei_id, c.ECA_address,  c.ECA_pin, s.state_name AS perm_state, d.district_name AS perm_district, s1.state_name AS cur_state, d1.district_name AS cur_district, m.marital_name, g.gender_name, t.ET_id, t.ET_ei_id, t.ET_emp_no, t.ET_join_date, t.ET_salary, t.ET_ctc, t.ET_status, n.designation_name AS position, n1.designation_name AS report_to, department_tbl.department_name FROM emp_info e LEFT JOIN emp_cur_address c ON e.EI_id = c.ECA_ei_id LEFT JOIN state_tbl s ON s.state_id = e.EI_state LEFT JOIN district_tbl d ON d.district_id = e.EI_district LEFT JOIN state_tbl s1 ON s1.state_id = c.ECA_state LEFT JOIN district_tbl d1 ON d1.district_id = c.ECA_district LEFT JOIN marital_tbl m ON m.marital_id = e.EI_marital LEFT JOIN gender_tbl g ON g.gender_id = e.EI_gender LEFT JOIN emp_tbl t ON t.ET_ei_id = e.EI_id LEFT JOIN designation_tbl n ON n.designation_id = t.ET_desig_id LEFT JOIN designation_tbl n1 ON n1.designation_id = t.ET_report_to LEFT JOIN department_tbl ON department_tbl.department_id = t.ET_dept_id WHERE e.EI_id = '$ei_id'");
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
	 
	  $ECA_ei_id = $row1['ECA_ei_id'];
	  if( $ECA_ei_id !=""){
  	  $ECA_address = $row1['ECA_address'];
	  $cur_state = $row1['cur_state'];
	  $cur_district = $row1['cur_district']; 
	  $ECA_pin = $row1['ECA_pin'];}
	  
	$ET_emp_no = $row1['ET_emp_no'];
	$position = $row1['position'];
	$report_to = $row1['report_to'];
	$department_name = $row1['department_name'];
	
	$ET_salary = $row1['ET_salary'];
	$ET_ctc = $row1['ET_ctc'];
	$ET_status = $row1['ET_status'];
	$join_date = date("d/m/Y", strtotime($row1['ET_join_date']));
   }
 ?>  
  <!--PANEL 1 - PERSONAL -->
  <div class="panel panel-success"> 			
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Employee <span class="panel-subTitle"> ( Profile ) </span>
     <button onclick="printDiv('printableArea')" class="no-print btn btn-mini btn-primary pull-right" style="margin-left:10px; margin-top:-5px;">
  <i class="fa fa-print fa-lg"></i> Print&nbsp;</button> 
   	 <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     
     </h3>
   </div>	 

<div class="panel-body" id="printableArea">
<div class="row" style="width:96%; margin-left:2%;">                            
<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
  <div class="text-center th_bg_color blue_color"> <label> Official Info</label></div>
  <thead align="left">
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
  
  <?php if( $ECA_ei_id !=""){ ?>
  <tr>
  <td colspan="3"><label>Cur.Address : </label> <?php echo $ECA_address;?>, <?php echo $cur_district;?> <?php echo $cur_state;?> -  <?php echo $ECA_pin;?></td>
  </tr>
  
   <?php } ?>
   
   <tr>      
     <td><label>Emp.NO# : </label> <?php echo $ET_emp_no;?></td>
     <td><label>Joined Date : </label> <?php echo $join_date;?></td>
     <td><label>Status : </label> <?php if($ET_status =='1'){echo 'Active';}if($ET_status =='2'){echo 'Relieved';}?></td>
  </tr>
  
  <tr>      
     <td><label>Position : </label> <?php echo $position;?></td>
     <td><label>Department : </label> <?php echo $department_name;?></td>
     <td><label>Report To : </label> <?php echo $report_to;?></td>
  </tr>
  
  <tr>      
     <td><label>Salary : </label> <?php echo $ET_salary;?></td>
     <td colspan="2"><label>Annual CTC : </label> <?php echo $ET_ctc;?></td>
    
  </tr>
</tbody>
</thead>
</table>
</div>
<?php } ?>


<?php
$resultF = mysqli_query($con, "SELECT f.EF_id, f.EF_name, f.EF_ei_id, f.EF_occupation, f.EF_dob, r.RT_name FROM emp_family f LEFT JOIN relation_type r ON r.RT_id = f.EF_type WHERE f.EF_ei_id = '$ei_id'");
if(mysqli_num_rows($resultF) !=0) { 
?>
<div class="row" style="width:96%; margin-left:2%; margin-top:25px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table-striped" style="width:100%;">
  <div class="text-center th_bg_color blue_color"> <label> Family Info</label></div>
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
$sl_2=1;
while ($row2 = mysqli_fetch_array($resultF))
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
 </div>
 <?php } ?>


<?php
$resultQ = mysqli_query($con, "SELECT EQ_id, EQ_ei_id, EQ_course, EQ_faculty, EQ_institute, EQ_univ, EQ_mark, EQ_total, EQ_grad, EQ_result, EQ_pass_date, EQ_duration_year, EQ_duration_month FROM emp_qualification WHERE EQ_ei_id = '$ei_id'");
if(mysqli_num_rows($resultQ) !=0) { 
?>
<div class="row" style="width:96%; margin-left:2%; margin-top:25px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table-striped" style="width:100%;">
  <div class="text-center th_bg_color blue_color"> <label> Qualification Info</label></div>
   <thead align="left">
      <tr>
      <th style="width:2%;"> # </th>
      <th style="width:10%;"> Course</th>
      <th style="width:10%;"> Faculty</th>
      <th style="width:15%;"> Institute</th>
      <th style="width:10%;"> Board/Univ</th> 
      <th style="width:5%;"> Mark</th>
      <th style="width:5%;"> Total</th>
      <th style="width:5%;"> Grade(%)</th>
      <th style="width:5%;"> Result</th>
      <th style="width:5%;"> Dur(Y)</th>
      <th style="width:5%;"> Dur(M)</th>
      <th style="width:5%;"> Pass Year</th>
      </tr>
   </thead>     
  <tbody>
<?php
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
</div>
 <?php } ?>

<?php
$resultE = mysqli_query($con, "SELECT PE_id, PE_org, PE_address, PE_dept, PE_position, PE_joined_date, PE_exit_date FROM emp_prev_experience WHERE PE_ei_id = '$ei_id'");
if(mysqli_num_rows($resultE) !=0) { 
?>
<div class="row" style="width:96%; margin-left:2%; margin-top:25px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table-striped" style="width:100%;">
   <div class="text-center th_bg_color blue_color"> <label> Experience Info</label></div>
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
</div>
 <?php } ?>


<?php
$resultL = mysqli_query($con, "SELECT l.EL_id, l.EL_remark, l.EL_date, t.letter_type FROM emp_letter l LEFT JOIN letter_type_tbl t ON t.letter_type_id = l.EL_type WHERE EL_ei_id = '$ei_id'");
if(mysqli_num_rows($resultL) !=0) { 
?>
<div class="row" style="width:96%; margin-left:2%; margin-top:25px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table-striped" style="width:100%;">
<div class="text-center th_bg_color blue_color"> <label> Letter Info</label></div>
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
 $sl_L++;
}
?>
	</tbody>   
 </table>
</div>
 <?php } ?>


<?php
$resultX = mysqli_query($con, "SELECT EE_id, EE_reason, EE_date FROM emp_exit_tbl WHERE EE_ei_id = '$ei_id'");
if(mysqli_num_rows($resultX) !=0) { 
?>
<div class="row" style="width:96%; margin-left:2%; margin-top:25px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table-striped" style="width:100%;">
<div class="text-center th_bg_color blue_color"> <label> Relieved Info</label></div>
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
</div>
 <?php } ?>


</div>
</div>
<div class="clear"></div>
</div>
<?php include("footer.php"); ?> 
<?php include("script_bootstrap.php"); ?>
<?php require_once("script_print_bw_div.php");?>
</body>
</html>
<?php } ob_flush();?>