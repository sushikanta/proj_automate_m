<?php require_once("check_login_admin.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>View Detail</title>
<?php require_once("css_bootstrap_datatable_header.php"); ?> 
</head>
<body>
<?php require_once("right_top_header_popup.php");?>
<div class="container">
 <div class="page-content">

<?php
if(isset($_GET['dr_id']))
  {
	$dr_id = $_GET['dr_id'];
	$result = mysqli_query($con, "SELECT i.dr_name, i.dr_phone, i.dr_email, i.dr_dob,i.dr_name, i.dr_address, i.dr_pin, s.state_name, d.district_name, m.marital_name, g.gender_name, p.dp_specialization, p.dp_designation, p.dp_institute, c.DCA_id, c.DCA_address, c.DCA_pin, s1.state_name AS c_state, d1.district_name AS c_district FROM dr_info i LEFT JOIN marital_tbl m ON m.marital_id = i.dr_marital LEFT JOIN dr_profile p ON p.dp_dr_id = i.dr_id LEFT JOIN state_tbl s ON s.state_id = i.dr_state LEFT JOIN district_tbl d ON d.district_id = i.dr_district LEFT JOIN gender_tbl g ON g.gender_id = i.dr_gender LEFT JOIN dr_cur_address c ON c.DCA_dr_id = i.dr_id LEFT JOIN state_tbl s1 ON s1.state_id = c.DCA_state LEFT JOIN district_tbl d1 ON d1.district_id = c.DCA_district WHERE i.dr_id = '$dr_id' ORDER BY i.dr_name ASC");
	$sl_no=1;
	while ($row = mysqli_fetch_array($result))
	{
	  $dr_name = $row['dr_name'];
	  $dr_phone = $row['dr_phone'];
	  $dr_dob = $row['dr_dob'];
	  $dr_email = $row['dr_email'];	  
	  $marital = $row['marital_name'];
	  $gender = $row['gender_name'];
	  
	  $dp_specialization = $row['dp_specialization'];
	  $dp_designation = $row['dp_designation'];
	  $dp_institute =  $row['dp_institute'];
	  
	  $dr_address = $row['dr_address'];
	  $state = $row['state_name'];
	  $district = $row['district_name'];
	  $dr_pin = $row['dr_pin'];	  
	  
	  $DCA_id = $row['DCA_id'];
	}
	?>       
<div class="inv-main"> 
 
 <!-------- PANEL 1 - PERSONAL -------->
 <div class="panel panel-success"> 
     <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Doctor <span class="panel-subTitle"> ( Information ) </span>
   	 <span class="date_time pull-right light_purple_color" style="padding-right:10px;"><i class="fa fa-calendar"></i> <span id="show_date"></span></span>
     </h3>
     </div>   
  <table cellpadding="0" cellspacing="0" border="0" class="table-striped table-hover" style="width:90%; margin-left:5%;">
  <thead align="left">
  </thead>
  <tbody>
  <tr> 
     <td><label>Name : </label></td>
     <td><?php echo $dr_name;?></td>
     <td><label>Gender : </label></td>
     <td><?php echo $gender;?></td>
     <td><label>Marital : </label></td>
     <td><?php echo $marital;?></td>
  </tr>  
  <tr>      
     <td><label>Email : </label></td>
     <td><?php echo $dr_email;?></td>
     <td><label>Phone : </label></td>
     <td><?php echo $dr_phone;?></td>
     <td><label>Date of Birth : </label></td>
     <td><?php echo $dr_dob;?></td>
   </tr>
   <tr>      
     <td><label>Address : </label></td>
     <td colspan="5"><?php echo $dr_address;?><?php if($district !="") echo ', '.$district;?><?php if($state !="") echo ', '.$state;?><?php if($dr_pin !="") echo ' - '.$dr_pin;?>
     </td>
   </tr>
  
  <?php if($DCA_id !=""){ 
	$c_address = $row['DCA_address'];
	$c_pin = $row['DCA_pin'];
	$c_state = $row['c_state'];
	$c_district = $row['c_district'];
  ?>
  <tr>      
  <td><label>Current Address : </label></td>
  <td colspan="5"><?php echo $c_address;?><?php if($c_district !="") echo ', '.$c_district;?><?php if($c_state !="") echo ', '.$c_state;?><?php if($c_pin !="") echo ' - '.$c_pin;?></td>
  </tr>
  <?php } ?>
   <tr>      
     <td><label>Specialize : </label></td>
     <td><?php echo $dp_specialization;?></td>
     <td><label>Designation : </label></td>
     <td><?php echo $dp_designation;?></td>
     <td><label>Institute : </label></td>
     <td><?php echo $dp_institute;?></td>
   </tr>
  </tbody>
  </table>
  </div>

<!---------- PANEL - CLINIC ---------> 
<?php
$result1 = mysqli_query($con, "SELECT DC_clinic, DC_address, DC_phone FROM dr_clinic_tbl WHERE DC_dr_id = '$dr_id'");
if(mysqli_num_rows($result1) !=0){
?>
 <div class="panel panel-success"> 
 	 <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Clinic <span class="panel-subTitle"> ( Information ) </span>
     </h3>
     </div> 
    <table cellpadding="0" cellspacing="0" border="0" class="table-striped table-hover" style="width:90%; margin-left:5%;">
        <thead align="left">
        <tr>
          <th style="width: 15%;"> # </th>
          <th style="width: 30%;"> Clinic Name</th>          
          <th style="width: 30%;"> Address</th>
          <th style="width: 20%;"> Phone</th>
        </tr>
       </thead>     
      <tbody>
 <?php
	$sl_no1=1;
   while ($row = mysqli_fetch_array($result1))
	{
	  $DC_clinic = $row['DC_clinic'];
	  $DC_address = $row['DC_address'];
	  $DC_phone = $row['DC_phone'];
	?>
  <tr>
  <td><?php echo $sl_no1; ?></td>  
  <td><?php echo  $DC_clinic; ?></td>  
  <td><?php echo  $DC_address; ?></td> 
  <td><?php echo  $DC_phone; ?></td>
  </tr>
 <?php
  $sl_no1++;
}
?>
</tbody>
</table>             
</div>        		  
<?php } ?>

<!----------- START Family table --------------->
<?php 
  $result_family = mysqli_query($con, "SELECT f.DF_name, f.DF_dob, r.RT_name FROM dr_family_tbl f LEFT JOIN relation_type r ON r.RT_id = f.DF_relation WHERE f.DF_dr_id = '$dr_id'");
  if(mysqli_num_rows($result_family) !=0){
 ?>
  <div class="panel panel-success"> 
      <div class="panel-heading light_purple_color">
      <h3 class="panel-title"><i class="fa fa-windows fa-spin fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
      Family <span class="panel-subTitle"> ( Information ) </span>
      </h3>
      </div> 
	<table cellpadding="0" cellspacing="0" border="0" class="table-striped table-hover" style="width:90%; margin-left:5%;">
    <thead align="left">
      <tr>
      <th style="width: 15%;"> # </th>
      <th style="width: 30%;"> Name</th>
      <th style="width: 30%;"> Relation</th>
      <th style="width: 20%;"> Date of Birth</th>
      </tr>
   </thead>     
<tbody>
<?php
$sl_no2=1;
while ($fam = mysqli_fetch_array($result_family))
{
?>
 <tr>
    <td><?php echo $sl_no2; ?> </td>  
    <td><?php echo $fam['DF_name']; ?> </td>  
    <td><?php echo $fam['RT_name']; ?> </td> 
	<td><?php echo date("d-M-Y", strtotime($fam['DF_dob'])); ?> </td>
  </tr>
 <?php
  $sl_no2++;
}
?>
</tbody>
</table>                      
</div>
<?php } ?>


</div>
<div class="clear"></div>
</div>
<?php require_once("footer.php"); ?> 
<?php require_once("script_bootstrap.php"); ?> 
</body>
</html>

<?php } ob_flush();?>