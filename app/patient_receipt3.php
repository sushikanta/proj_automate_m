<?php require_once("check_login_fd.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Receipt</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all"/>
<link rel="stylesheet" type="text/css" href="style-receipt.css" media="all"/>
<link rel="stylesheet" type="text/css" href="style-print.css"  media="print"/>
<link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet"/>
</head>
<body>
<div class="container">
 <div class="page-content">

<?php
if(isset($_GET['receipt_no']) && $_GET['receipt_no'] !='')
 {  
  $receipt_no_tbl = $_GET['receipt_no'];
  $result_patient = mysqli_query($con, "SELECT r.pr_date, r.pr_dr_prescription,r.pr_source_id,r.pr_date,r.pr_referred_id, p.PI_id, p.PI_name, p.PI_phone, g.gender_name, p.PI_age_y, p.PI_age_m, p.PI_age_d, p.PI_address, p.PI_pin, s.state_name, d.district_name, m.marital_name FROM patient_registration r LEFT JOIN patient_info p ON p.PI_id = r.pr_patient_id LEFT JOIN state_tbl s ON s.state_id = p.PI_state_id LEFT JOIN district_tbl d ON d.district_id = p.PI_district_id LEFT JOIN marital_tbl m ON m.marital_id = p.PI_marital_id LEFT JOIN gender_tbl g ON g.gender_id = p.PI_gender WHERE r.pr_receipt_no = '$receipt_no_tbl'");
  
  $result_test = mysqli_query($con, "SELECT t.PT_test_name, t.PT_test_price, y.PP_total, y.PP_tax, y.PP_disc,  y.PP_net, y.PP_paid, y.PP_bal FROM patient_test t LEFT JOIN  patient_payment y ON y.PP_receipt_no=t.PT_receipt_no WHERE t.PT_receipt_no = '$receipt_no_tbl' AND t.PT_status_id !='3'");

  while($row1 = mysqli_fetch_array($result_patient))
                {
                   	$patient_id = $row1['PI_id'];
					$patient_name = $row1['PI_name'];					
					$patient_phone = $row1['PI_phone'];
					$patient_age_y = $row1['PI_age_y'];
					$patient_age_m = $row1['PI_age_m'];
					$patient_age_d = $row1['PI_age_d'];
					$patient_address = $row1['PI_address'];					
					$pin = $row1['PI_pin'];
					
					$pr_date = $row1['pr_date'];
					$dr_letter = $row1['pr_dr_prescription'];
					$source_id = $row1['pr_source_id'];
					$referred_id = $row1['pr_referred_id'];
					
					$state = $row1['state_name'];
					$district = $row1['district_name'];
					$marital_name = $row1['marital_name'];
					$gender_name = $row1['gender_name'];				
				}
			?>
 <div class="inv-main">    
    <div class="container">
    <div style="text-align:center"><h3 style="margin:0;"> R E C E I P T</h3> </div>   
       
     <table class="table table-bordered" style="margin: 0px;">
      <thead style="border-right: solid 1px; padding-left:5%;">
        <tr>
        <th style="font-weight:normal;">
              <span class="pull-left"><h4 style="margin:0px;">Escent Diagnostics Pvt. Ltd</h4></span><br/>              
              <span class="pull-left" style="font-size:11pt;">Regd. No. MNHCR/NO/096/DC/2012</span>
              <span class="text-right pull-right"><i class="fa fa-phone-square fa-fw"></i> +91 8731049609</span><br/>
              <span class="pull-left" style="font-size:11pt;">Purana Rajbari, Nongmeibung, Imphal East, Manipur-795001</span>            
              <span class="text-right pull-right"><i class="fa fa-fax fa-fw"></i> +91 8731049609</span>             
       </th>
   
      <tr>
        <th style="font-weight:normal;">
        <span class="pull-left">Reference # &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo 'ED/'.$receipt_no_tbl; ?></span>   
        <span class="pull-right">Date  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo date("d/m/Y,h:i a", strtotime($pr_date)); ?></span> <br /> <br />   
        
        <div class="pull-left padding_right10" style="border-right:dotted 1px;  padding-left:12%;"><span> REFERRED <br /> BY<br/><br/><br/></span></div>
    	<span class="pull-left" style="padding-left:5%;  padding-right:20%;">
    	<?php if($dr_letter =='NO') {echo "Self";} else{ $dr_name = showDoctor_name($con, $dr_letter); echo "Dr. ". $dr_name;} ?>
    	</span>   
        
        <div class="pull-left padding_right10" style="border-right:dotted 1px; padding-left:2%;">        
        <span> BILL <br /> TO <br/><br/><br/></span>
        </div>
        <span class="pull-left" style="padding-left:5%;">
        <?php echo $patient_name; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ( Profile # <?php echo $patient_id; ?> )<br />
        <?php $age =show_age_long($con, $patient_age_y, $patient_age_m, $patient_age_d); echo $gender_name.' / '.$age;  echo ' ('.$marital_name.')'; ?><br />
        <?php echo $patient_address; ?>, 
        <?php echo $district; ?>, <?php echo $state; ?> <?php if($pin != ""){echo " - ".$pin;} ?><br />
        <?php if($patient_phone != ""){echo ' <i class="fa fa-phone-square fa-fw"></i>  +91 '.$patient_phone;} ?>
        </span>
       </th>
    </thead>
    <tbody></tbody>
    </table>

	
    <!-------------test -->
    <table class=" table table-bordered table-condensed" style="margin: 10px 0px;">
      <thead>
      <tr>
         <th><span class="pull-left">Description</span></th>
          <th><span class="pull-right">Amount</span></th>
       </tr>
       </thead>
       <tbody>    
<?php
$sl_no=1;
$_disc_value=showDiscount_value($con, $receipt_no_tbl);
$tax_value=showTax_value($con, $receipt_no_tbl);

while ($rowt = mysqli_fetch_array($result_test))
{   
 	$test_name = $rowt['PT_test_name'];
	$test_price = $rowt['PT_test_price'];
    
	$total = $rowt['PP_total'];	
	$tax_option =  $rowt['PP_tax'];
	$disc_option =  $rowt['PP_disc'];
	$bal =  $rowt['PP_bal'];	
	$paid =  $rowt['PP_paid'];	
	$net = $rowt['PP_net'];
	?>
     
      <tr>
      <td><span><?php echo $sl_no; ?>. &nbsp; &nbsp; 
      <?php echo $test_name; ?></span>
      </td>
      <td><span class="pull-right"> <?php echo $test_price; ?></div></td>
     
      </tr>
      <?php
 $sl_no++;
}
?>
     
      <tr>
		 <td>
        
			 <div class="pull-left padding_right10" style="border-right:dotted 1px;">
             <span style="font-style:italic;"><br /><br/><br/><br/> &nbsp; <?php echo $_SESSION['name'].' '.$_SESSION['surname']; ?></span><br/>
             <span >( Authorised Signature )</span>
             </div>
             
             <br /><br />
             <i class="fa fa-life-saver fa-fw"></i> Escent Diagnostics Pvt. Ltd<br />
             <span style="font-size:8pt; font-style:italic; line-height:1.2;">             
             <i class="fa fa-angle-double-right fa-fw"></i> Participant of External Quality Assurance Program by Bio-Rad EQAS, USA<br />
             <i class="fa fa-angle-double-right fa-fw"></i> USG, ECG, Biochemistry, Microbiology, Serology, X-Ray, Clinical Pathology <br />
             <i class="fa fa-angle-double-right fa-fw"></i> Histopathology & other Examinations <br />
             </span></span>
           </td>          
      
      <!------------ Sub total / TAX / DISC ---------> 
      <td>
        
           <div class="pull-left text-right" style="width:60%;">             
             <span style="font-weight:bold;"> Sub-Total 
             <span class="padding_left20"> <i class="fa fa-rupee fa-fw"></i></span> </span>
             <br/>             
             <span>Tax <?php echo '('.$tax_value.'%)'; ?> 
             <span class="padding_left20"> <i class="fa fa-rupee fa-fw"></i></span> </span>
             <br/>
             
             <span>Discount <?php if($disc_option ==1){ echo '('.$_disc_value.')';} ?> 
             <span class="padding_left20"> <i class="fa fa-rupee fa-fw"></i></span> </span>
             <br/>
             <div class="border_bottom_solid1"></div>             
            <span style="font-weight:bold;"> Total 
             <span class="padding_left20"> <i class="fa fa-rupee fa-fw"></i></span> </span>
             <br/>
             <span> Paid 
             <span class="padding_left20"> <i class="fa fa-rupee fa-fw"></i></span> </span>
            <br/>
             <div class="border_bottom_solid1"></div>
             <span style="font-weight:bold;"> Bal / Due 
             <span class="padding_left20"> <i class="fa fa-rupee fa-fw"></i></span> </span>
           </div>
             
             <!---------- VALUES ------->
             <div class="pull-right text-right" style="width:40%;">             
              <span style="font-weight:bold;"><?php echo number_format($total, 2, '.', ','); ?></span>
              <br />
               <span ><?php $tax_calc = ($total * $tax_value)/100; $total_after_tax = $total + $tax_calc;  
			   echo number_format($tax_calc, 2, '.', ','); ?>
               </span>
               <br />               
               <span>
			   <?php if($disc_option ==1)  // discount = Yes	
				   		$disc_in_amt = showDiscount_in_amt($con, $receipt_no_tbl, $total_after_tax);						
					 if($disc_option==2) // discount = NO
					  	{$disc_in_amt = "0.00";}
				$total_after_disc = $total_after_tax - $disc_in_amt;
				  		   
			    echo number_format($disc_in_amt, 2, '.', ','); ?></span>
               <br />
               <div class="border_bottom_solid1"></div>               
               <span style="font-weight:bold;"><?php echo number_format($total_after_disc, 2, '.', ','); ?></span>
               <br />               
               <span><?php echo number_format($paid, 2, '.', ','); ?></span>
                <br />
               <div class="border_bottom_solid1"></div>              
               <span style="font-weight:bold;"><?php echo number_format($bal, 2, '.', ','); ?></span>
             </div>
             </div>
             </td>
         </tbody>
         </table>
        
<!-- --------------- LAB COPY ------------------->
<label style="margin-top:50px; width:100%; border-top: 2px dotted #000000; font-weight:bold; font-style:italic; font-size:16px;"><br/>Escent Copy</label>
<table class="table table-bordered" style=" margin-bottom: 5px;">
<thead>
<tr>
<th style="font-weight:normal;">
    <span class="pull-left">Registration No : <strong><?php echo 'ED/'.$receipt_no_tbl; ?></strong></span><br/>
    <span class="pull-right"><?php if($patient_phone != ""){echo ' <i class="fa fa-phone-square fa-fw"></i>  +91 '.$patient_phone;} ?></span>
    
    <span class="pull-left">Name : <?php echo $patient_name; ?></span>
    <span class="pull-right">Dated : <?php echo date("d/m/Y, h:i a", strtotime($pr_date)); ?></span><br/>
    
    <span class="pull-left">
    Address : <?php echo $patient_address; ?>, <?php echo $district; ?>, <?php echo $state; ?> <?php if($pin != ""){echo " - ".$pin;} ?>
    </span>  
    <span class="pull-right"> <i class="fa fa-male"></i><i class="fa fa-female"></i> : 
	<?php echo $gender_name.' / '.$age; echo ' ('.$marital_name.')'; ?>
    </span><br/>  
    
    <span class="pull-left">Ref. By : <?php if($dr_letter =='NO') {echo "Self";} else{ echo "Dr. ". $dr_name;} ?></span> <br/>     
    <span class="pull-left" >* Patient History : <?php  echo showHistory_patient($con, $patient_id); ?></span>    
    <span class="pull-right">* Lab Note : <?php echo showLab_note($con, $receipt_no_tbl);?></span>

    </th>
    </thead>
    </table>
  
  <!-- Table -->
  <table class="table table-striped table-bordered" style=" margin-bottom:10px;">
  	<thead>
		<tr>
		<th style="width:10%;">Sl. No.</th>
		<th>Investigation (Short form)</th>
		</tr>
	</thead>
	<tbody>   
	
<?php 
mysqli_data_seek($result_test, 0);
$sl=1;
while ($row2 = mysqli_fetch_array($result_test))
{   
 	$_test_name = $row2['PT_test_name'];
	$_test_price = $row2['PT_test_price'];
	?>
     <tr>
      <td> <?php echo $sl; ?>. </td>
      <td> <?php echo $_test_name; ?> </td>
    </tr>
    <tr>
      <td colspan="2"> Finding (<?php echo $sl; ?>) : </td>    
    </tr>    
       <?php
 $sl++;
}
?>
</tbody>
</table> 
</td>
<div class="text-center blank">
 <button type="button" class="btn btn-primary btn-large" id="print_btn" style="font-size:16px; width:20%;" onClick="window.print();return false"><i class="fa fa-print"></i> PRINT</button>         
   <button type="button" class="btn btn-primary btn-large" onclick="window.close()" style="font-size:16px;width:20%;"><i class="fa fa-times"></i> CLOSE </button>
   <a style="color:#FFF;" href="patient_registration.php">
    <button type="button" class="btn btn-primary btn-large" style="font-size:16px;width:20%;"> BACK <i class="fa fa-angle-double-right"></i> </button>
    </a>
 </div>           
	
 <div class="clearfix"></div>
 </div>   
    
<?php require_once("script_bootstrap.php"); ?> 
</body>
</html>
<?php } ob_flush();?>