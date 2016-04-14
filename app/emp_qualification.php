<?php require_once("check_login_hr.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>Qualification</title>
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
 
 $result1 = mysqli_query($con, "SELECT e.EI_name, e.EI_dob, e.EI_email, e.EI_phone, e.EI_emergency, e.EI_address, e.EI_pin, c.ECA_ei_id, c.ECA_address,  c.ECA_pin, s.state_name AS perm_state, d.district_name AS perm_district, s1.state_name AS cur_state, d1.district_name AS cur_district, m.marital_name, g.gender_name FROM emp_info e LEFT JOIN emp_cur_address c ON e.EI_id = c.ECA_ei_id LEFT JOIN state_tbl s ON s.state_id = e.EI_state LEFT JOIN district_tbl d ON d.district_id = e.EI_district LEFT JOIN state_tbl s1 ON s1.state_id = c.ECA_state LEFT JOIN district_tbl d1 ON d1.district_id = c.ECA_district LEFT JOIN marital_tbl m ON m.marital_id = e.EI_marital LEFT JOIN gender_tbl g ON g.gender_id = e.EI_gender WHERE e.EI_id = '$ei_id'");
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
                                  
<table cellpadding="0" cellspacing="0" border="0" class="table-striped center" style="width:90%; margin-left:5%;">
  <thead align="left">
  </thead>
  <tbody?
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
    <td colspan="3"><label>Permanent Address : </label> <?php echo $EI_address;?>, <?php echo $perm_district;?> <?php echo $perm_state;?> -  <?php echo $EI_pin;?></td>
    
  </tr>
  
  <?php 
  if( $ECA_ei_id !=""){
	  ?>
        <tr>
        <td colspan="3"><label>Present Address : </label> <?php echo $ECA_address;?>, <?php echo $cur_district;?> <?php echo $cur_state;?> -  <?php echo $ECA_pin;?></td>
        </tr>
   <?php
   } 
  ?>

</tbody>
</table>
</div>
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
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped display" id="family_tbl">
   <thead align="left">
      <tr>
      <th> Sl. no. </th>
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
	if($EF_dob1 !='0000-00-00'){ $EF_dob = date("d-M-Y", strtotime($row2['EF_dob1']));}		
	?>
          <tr id="<?php echo $EF_id; ?>">
            <td> <?php echo $sl_2; ?> </td>
            <td> <?php echo $RT_name; ?> </td>
            <td> <?php echo $EF_name; ?> </td>  
            <td><?php echo $EF_occupation; ?> </td>
            <td><?php if($EF_dob1 !='0000-00-00'){echo $EF_dob;}else{echo "";} ?> </td>
          </tr>
       <?php
 $sl_2++;
}
?>
	</tbody>   
 </table>


<!-------------------form for new record------------------------------>
<form id="formFamily" method="post" action="#" title="Add New"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
     
<div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>       
  <div class="col-lg-7">
  <input style="padding:3px;" type="text" name="sl_no" class="form-control" value="<?php echo $sl_2;?>" readonly rel="0">
  <input type="hidden" name="emp_info" value="<?php echo $ei_id;?>">
  </div>
  </div></div>
  <br/>

 <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="relation">Relation :</label>       
  <div class="col-lg-7"><select style="padding:3px;" id="relation" name="relation" class="form-control" required rel="1">
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
  <div class="col-lg-7"><input style="padding:3px;" type="text" name="name" id="name" class="form-control" placeholder="Name" autofocus maxlength="50" required rel="2"/>
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="password">Occupation :</label>       
  <div class="col-lg-7 padding_gap">
  <input style="padding:3px;" type="text" class="form-control" name="occupation" id="occupation" placeholder="Occupation" maxlength="50" required rel="3" />
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="role">DOB :</label>
   <div class="col-lg-7 padding_gap">
  <input style="padding:3px;" type="text" class="form-control" name="dob" id="dob" placeholder="Date of birth" required rel="4" />
     </div></div></div>
  <br/>
  <br/>             
</form>
<button id="btnDeleteRow">Delete</button> <button id="btnAddNewRow">Add</button> 
<!--<div class="add_delete_toolbar"/> -->
</div>
</div>   
  
  
  <!--PANEL 1 - Qualification -->
  <div class="panel panel-success"> 			
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Employee <span class="panel-subTitle"> ( Qualification Info ) </span>
     </h3>
   </div>	

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped display" id="qualf_tbl">
   <thead align="left">
      <tr>
      <th> Sl. no. </th>
      <th> Relation</th>
      <th> Name</th>
      <th> Occupation</th> 
      <th> Date of Birth</th>        
      </tr>
   </thead>     
  <tbody>
<?php
$result2 = mysqli_query($con, "SELECT EF_id, EF_ei_id, EF_type, EF_name, EF_occupation, EF_dob FROM emp_family WHERE EF_ei_id = '$ei_id'");
$sl_2=1;
while ($row2 = mysqli_fetch_array($result2))
{   
 	$EF_id = $row2['EF_id'];
	$EF_type = $row2['EF_type'];
	$EF_name = $row2['EF_name'];
	$EF_occupation = $row2['EF_occupation'];
	$EF_dob = date("d-M-Y", strtotime($row2['EF_dob']));	
	?>
          <tr id="<?php echo $EF_id; ?>">
            <td> <?php echo $sl_2; ?> </td>
            <td> <?php echo $EF_type; ?> </td>
            <td> <?php echo $EF_name; ?> </td>  
            <td><?php echo $EF_occupation; ?> </td>
            <td><?php echo $EF_dob; ?> </td>
          </tr>
       <?php
 $sl_2++;
}
?>
	</tbody>   
 </table>


<!-------------------form for new record------------------------------>
<form id="formQualf" method="post" action="#" title="Add New"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
     
<div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>       
  <div class="col-lg-7"><input style="padding:3px;" type="text" name="sl_no" class="form-control" value="<?php echo $sl_2;?>" readonly rel="0"></div>
  </div></div>
  <br/>

 <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="relation">Relation :</label>       
  <div class="col-lg-7"><select style="padding:3px;" id="relation" name="relation" class="form-control" required rel="1">
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
  <div class="col-lg-7"><input style="padding:3px;" type="text" name="name" id="name" class="form-control" placeholder="Name" autofocus maxlength="50" required rel="2"/>
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="password">Occupation :</label>       
  <div class="col-lg-7 padding_gap">
  <input style="padding:3px;" type="text" class="form-control" name="occupation" id="occupation" placeholder="Occupation" maxlength="50" required rel="3" />
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="role">DOB :</label>
   <div class="col-lg-7 padding_gap">
  <input style="padding:3px;" type="text" class="form-control" name="dob" id="dob" placeholder="Date of birth" required rel="4" />
     </div></div></div>
  <br/>
  <br/>             
</form>
<button id="btnDeleteRow">Delete</button> <button id="btnAddNewRow">Add</button> 
<!--<div class="add_delete_toolbar"/> -->
</div>
</div>   
  

<!--PANEL 1 - Experience -->
  <div class="panel panel-success"> 			
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Employee <span class="panel-subTitle"> ( Experience Info ) </span>
     </h3>
   </div>	

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped display" id="family_tbl">
   <thead align="left">
      <tr>
      <th> Sl. no. </th>
      <th> Relation</th>
      <th> Name</th>
      <th> Occupation</th> 
      <th> Date of Birth</th>        
      </tr>
   </thead>     
  <tbody>
<?php
$result2 = mysqli_query($con, "SELECT EF_id, EF_ei_id, EF_type, EF_name, EF_occupation, EF_dob FROM emp_family WHERE EF_ei_id = '$ei_id'");
$sl_2=1;
while ($row2 = mysqli_fetch_array($result2))
{   
 	$EF_id = $row2['EF_id'];
	$EF_type = $row2['EF_type'];
	$EF_name = $row2['EF_name'];
	$EF_occupation = $row2['EF_occupation'];
	$EF_dob = date("d-M-Y", strtotime($row2['EF_dob']));	
	?>
          <tr id="<?php echo $EF_id; ?>">
            <td> <?php echo $sl_2; ?> </td>
            <td> <?php echo $EF_type; ?> </td>
            <td> <?php echo $EF_name; ?> </td>  
            <td><?php echo $EF_occupation; ?> </td>
            <td><?php echo $EF_dob; ?> </td>
          </tr>
       <?php
 $sl_2++;
}
?>
	</tbody>   
 </table>


<!-------------------form for new record------------------------------>
<form id="formFamily" method="post" action="#" title="Add New"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
     
<div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>       
  <div class="col-lg-7"><input style="padding:3px;" type="text" name="sl_no" class="form-control" value="<?php echo $sl_2;?>" readonly rel="0"></div>
  </div></div>
  <br/>

 <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="relation">Relation :</label>       
  <div class="col-lg-7"><select style="padding:3px;" id="relation" name="relation" class="form-control" required rel="1">
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
  <div class="col-lg-7"><input style="padding:3px;" type="text" name="name" id="name" class="form-control" placeholder="Name" autofocus maxlength="50" required rel="2"/>
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="password">Occupation :</label>       
  <div class="col-lg-7 padding_gap">
  <input style="padding:3px;" type="text" class="form-control" name="occupation" id="occupation" placeholder="Occupation" maxlength="50" required rel="3" />
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="role">DOB :</label>
   <div class="col-lg-7 padding_gap">
  <input style="padding:3px;" type="text" class="form-control" name="dob" id="dob" placeholder="Date of birth" required rel="4" />
     </div></div></div>
  <br/>
  <br/>             
</form>
<button id="btnDeleteRow">Delete</button> <button id="btnAddNewRow">Add</button> 
<!--<div class="add_delete_toolbar"/> -->
</div>
</div>   
  
<!--PANEL 1 - Letter -->
  <div class="panel panel-success"> 			
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Employee <span class="panel-subTitle"> ( Letter Sent ) </span>
     </h3>
   </div>	

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped display" id="family_tbl">
   <thead align="left">
      <tr>
      <th> Sl. no. </th>
      <th> Relation</th>
      <th> Name</th>
      <th> Occupation</th> 
      <th> Date of Birth</th>        
      </tr>
   </thead>     
  <tbody>
<?php
$result2 = mysqli_query($con, "SELECT EF_id, EF_ei_id, EF_type, EF_name, EF_occupation, EF_dob FROM emp_family WHERE EF_ei_id = '$ei_id'");
$sl_2=1;
while ($row2 = mysqli_fetch_array($result2))
{   
 	$EF_id = $row2['EF_id'];
	$EF_type = $row2['EF_type'];
	$EF_name = $row2['EF_name'];
	$EF_occupation = $row2['EF_occupation'];
	$EF_dob = date("d-M-Y", strtotime($row2['EF_dob']));	
	?>
          <tr id="<?php echo $EF_id; ?>">
            <td> <?php echo $sl_2; ?> </td>
            <td> <?php echo $EF_type; ?> </td>
            <td> <?php echo $EF_name; ?> </td>  
            <td><?php echo $EF_occupation; ?> </td>
            <td><?php echo $EF_dob; ?> </td>
          </tr>
       <?php
 $sl_2++;
}
?>
	</tbody>   
 </table>


<!-------------------form for new record------------------------------>
<form id="formFamily" method="post" action="#" title="Add New"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
     
<div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>       
  <div class="col-lg-7"><input style="padding:3px;" type="text" name="sl_no" class="form-control" value="<?php echo $sl_2;?>" readonly rel="0"></div>
  </div></div>
  <br/>

 <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="relation">Relation :</label>       
  <div class="col-lg-7"><select style="padding:3px;" id="relation" name="relation" class="form-control" required rel="1">
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
  <div class="col-lg-7"><input style="padding:3px;" type="text" name="name" id="name" class="form-control" placeholder="Name" autofocus maxlength="50" required rel="2"/>
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="password">Occupation :</label>       
  <div class="col-lg-7 padding_gap">
  <input style="padding:3px;" type="text" class="form-control" name="occupation" id="occupation" placeholder="Occupation" maxlength="50" required rel="3" />
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="role">DOB :</label>
   <div class="col-lg-7 padding_gap">
  <input style="padding:3px;" type="text" class="form-control" name="dob" id="dob" placeholder="Date of birth" required rel="4" />
     </div></div></div>
  <br/>
  <br/>             
</form>
<button id="btnDeleteRow">Delete</button> <button id="btnAddNewRow">Add</button> 
<!--<div class="add_delete_toolbar"/> -->
</div>
</div>   
  
<!--PANEL 1 - Exit -->
  <div class="panel panel-success"> 			
   <div class="panel-heading light_purple_color">
     <h3 class="panel-title"><i class="fa fa-cubes fa-fw fa-lg"></i> &nbsp;&nbsp;&nbsp;
     Employee <span class="panel-subTitle"> ( Relieve Info ) </span>
     </h3>
   </div>	

<div class="row" style="width:90%; margin-left:5%; margin-top:15px;">                                  
<table cellpadding="0" cellspacing="0" border="0" class="table table-striped display" id="family_tbl">
   <thead align="left">
      <tr>
      <th> Sl. no. </th>
      <th> Relation</th>
      <th> Name</th>
      <th> Occupation</th> 
      <th> Date of Birth</th>        
      </tr>
   </thead>     
  <tbody>
<?php
$result2 = mysqli_query($con, "SELECT EF_id, EF_ei_id, EF_type, EF_name, EF_occupation, EF_dob FROM emp_family WHERE EF_ei_id = '$ei_id'");
$sl_2=1;
while ($row2 = mysqli_fetch_array($result2))
{   
 	$EF_id = $row2['EF_id'];
	$EF_type = $row2['EF_type'];
	$EF_name = $row2['EF_name'];
	$EF_occupation = $row2['EF_occupation'];
	$EF_dob = date("d-M-Y", strtotime($row2['EF_dob']));	
	?>
          <tr id="<?php echo $EF_id; ?>">
            <td> <?php echo $sl_2; ?> </td>
            <td> <?php echo $EF_type; ?> </td>
            <td> <?php echo $EF_name; ?> </td>  
            <td><?php echo $EF_occupation; ?> </td>
            <td><?php echo $EF_dob; ?> </td>
          </tr>
       <?php
 $sl_2++;
}
?>
	</tbody>   
 </table>


<!-------------------form for new record------------------------------>
<form id="formFamily" method="post" action="#" title="Add New"> 
 
<label id="lblAddError" style="display:none" class="error"></label>
 <div id="processing_message" style="display:none" title="Processing">Please wait while processing....</div>
     
<div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="sl_no">SL # :</label>       
  <div class="col-lg-7"><input style="padding:3px;" type="text" name="sl_no" class="form-control" value="<?php echo $sl_2;?>" readonly rel="0"></div>
  </div></div>
  <br/>

 <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="relation">Relation :</label>       
  <div class="col-lg-7"><select style="padding:3px;" id="relation" name="relation" class="form-control" required rel="1">
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
  <div class="col-lg-7"><input style="padding:3px;" type="text" name="name" id="name" class="form-control" placeholder="Name" autofocus maxlength="50" required rel="2"/>
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="password">Occupation :</label>       
  <div class="col-lg-7 padding_gap">
  <input style="padding:3px;" type="text" class="form-control" name="occupation" id="occupation" placeholder="Occupation" maxlength="50" required rel="3" />
  </div></div></div>
  <br/>
  
  <div class="form-group"> 
  <div class="form-control-group">
  <label class="col-lg-5 control-label text-right" for="role">DOB :</label>
   <div class="col-lg-7 padding_gap">
  <input style="padding:3px;" type="text" class="form-control" name="dob" id="dob" placeholder="Date of birth" required rel="4" />
     </div></div></div>
  <br/>
  <br/>             
</form>
<button id="btnDeleteRow">Delete</button> <button id="btnAddNewRow">Add</button> 
<!--<div class="add_delete_toolbar"/> -->
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