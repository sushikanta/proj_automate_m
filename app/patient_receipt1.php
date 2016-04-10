<?php require_once("check_login_fd.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Receipt</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" media="all"/>
<link rel="stylesheet" type="text/css" href="style-receipt.css" media="all"/>
<link rel="stylesheet" type="text/css" href="style-print.css"  media="print"/>
<link href="font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet"/>
</head>
    <!-- Bootstrap -->
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
	<body>	
    
    <div class="container" id="print_div">
    <div style="padding-bottom:10pt; margin-top:-20px; text-align:center"><h3> R E C E I P T</h3> </div>   
       
     <table class="table">
      <thead class="esc-t-head">
      <tr><th style="font-weight:normal;">       
       <div class="header">           
        	<div class="esc-r-header-left">
              <h3 style="line-height:5pt;"><span class="pull-left text-right">Escent Diagnostics Pvt. Ltd</span>
              <span style="font-size:12pt;" class="text-right pull-right"><i class="fa fa-phone-square fa-fw"></i> +91 8731049609</span>
              </h3>
              <div class="clearfix"></div>
              <h5 class="media-heading"><span style="font-size:11pt;">Purana Rajbari, Nongmeibung, Imphal East, Manipur-795001</span>
              <span class="pull-right text-right" style="font-size:10pt;">Regd. No. MNHCR/NO/096/DC/2012</span>
              </h5>
           </div>
        </div>
       </th>
    </thead>
    </table>
   
    <div class="container watermark">
	
    <div class="esc-pateint-details">  <!-----------------START of patient details------------------->

		<div class="row">
			<div class="pull-left padding_left90">INVOICE # <span class="padding_left20"><?php echo 'ED/'.$receipt_no_tbl; ?></span></div>
			<div class="pull-right padding_right50">DATE <span class="padding_left20"><?php echo date("d/m/Y,h:i a", strtotime($pr_date)); ?></span></div>
        	<div class="clearfix"></div>
        </div>        
		        
      <div class="row" style="margin-bottom:30px;">  <!-------------- header body --------------->
         
         <div class="padding_top40" style="float:left; width:65%;">
		  <div class="pull-left text-right padding_right10" style="border-right:dotted 1px; padding-left:130px;">
          <span> REFERRED <br /> BY<br/><br/><br/><br/><br/> </span>
          </div>
          <div class="pull-left padding_left10">
		  <?php if($dr_letter =='NO') {echo "Self";} else{ $dr_name = showDoctor_name($con, $dr_letter); echo "Dr. ". $dr_name;} ?>
          </div>
          <div class="clearfix"></div>
        </div>
        
           <div class="padding_top40" style="float:right; width:35%;">
			 <div class="pull-left text-right padding_left10 padding_right10" style="border-right:dotted 1px;">
             <span> BILL <br /> TO <br/><br/><br/><br/><br/></span>
             </div>
             <div class="pull-left padding_left10">
              Profile # <?php echo $patient_id; ?><br />
			  <?php echo $patient_name; ?><br />
              <?php $age =show_age_long($con, $patient_age_y, $patient_age_m, $patient_age_d); 
			  echo $gender_name.' / '.$age;  echo ' ('.$marital_name.')'; ?><br /> 
              
              <?php echo $patient_address; ?> <br />
              <?php echo $district; ?>, <?php echo $state; ?> <?php if($pin != ""){echo " - ".$pin;} ?><br />
              <?php if($patient_phone != ""){echo ' <i class="fa fa-phone-square fa-fw"></i>  +91 '.$patient_phone;} ?><br /> 
                      
             </div>
        	<div class="clearfix"></div>
        </div>        
        </div> <!----- END HEADER body --------------->
	</div>   <!--end patient details -->

<div class="row">
		<div class="solid_border1right right padding_left40" style="color:#6289C4;">           
             <div class="esc-r-header-left">
              
              <span class="text-left" style="width:55%;">Description</span>
              <span class="text-right pull-right padding_right40" style="width:15%;"> Amount</span>
         	
              <div class="clearfix"></div>
              </div>            
            </div>
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
      
    <div style="border-bottom: dotted 1px #333333; line-height:1.75;">      
     <div class="esc-r-header-left">
      <span class="pull-left text-right padding_left40">
      <?php echo $sl_no; ?>. <?php echo $test_name; ?></span>
      <span class="text-right pull-right padding_right40" style="border-left: dotted 1px; width:15%;"> <?php echo $test_price; ?></span>
      
      <div class="clearfix"></div>
      </div>            
    </div>   
     <?php
 $sl_no++;
}
?>
 
<div class="row">  
 
    <!------------ Pamyment history/company profile ---------> 
         
		 
         <div class="padding_top20" style="float:left; width:65%;">
			 <div class="pull-left text-right padding_left10 padding_right10" style="border-right:dotted 1px;">
             <span>  <br /><br/><br/><br/><?php echo $_SESSION['name'].' '.$_SESSION['surname']; ?><br/></span>
             </div>
             <div class="pull-left padding_left10">
             <span class="border_bottom_solid1"> Escent Diagnostic Pvt.Ltd</span><br />
             <span style="font-size:11px; line-height:1.2;"> Purana Rajbari, Nongmeibung Imphal East
             Manipur-795001<br />
             Regd. No. MNHCR/NO/096/DC/2012 <i class="fa fa-phone-square fa-fw"></i> +91 8731049609<br />
             <br />
             <span style="font-size:11px; font-style:italic; line-height:1.2;">
             <i class="fa fa-angle-double-right fa-fw"></i> Participant of External Quality Assurance Program by Bio-Rad EQAS, USA<br />
             <i class="fa fa-angle-double-right fa-fw"></i> USG, ECG, Biochemistry, Microbiology, Serology, X-Ray, Clinical Pathology <br />
             <i class="fa fa-angle-double-right fa-fw"></i> Histopathology & other Examinations <br />
             </span></span>
             </div>
        	<div class="clearfix"></div>
        </div>        
        
       <!------------ Sub total / TAX / DISC ---------> 
       <div style="float:right; width:33%;">
			 
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
              <span class="padding_right40" style="font-weight:bold;"><?php echo number_format($total, 2, '.', ','); ?></span>
              <br />
               <span class="padding_right40"><?php $tax_calc = ($total * $tax_value)/100; $total_after_tax = $total + $tax_calc;  
			   echo number_format($tax_calc, 2, '.', ','); ?>
               </span>
               <br />               
               <span class="padding_right40">
			   <?php if($disc_option ==1)  // discount = Yes	
				   		$disc_in_amt = showDiscount_in_amt($con, $receipt_no_tbl, $total_after_tax);						
					 if($disc_option==2) // discount = NO
					  	{$disc_in_amt = "0.00";}
				$total_after_disc = $total_after_tax - $disc_in_amt;
				  		   
			    echo number_format($disc_in_amt, 2, '.', ','); ?></span>
               <br />
               <div class="border_bottom_solid1"></div>               
               <span class="padding_right40" style="font-weight:bold;"><?php echo number_format($total_after_disc, 2, '.', ','); ?></span>
               <br />               
               <span class="padding_right40"><?php echo number_format($paid, 2, '.', ','); ?></span>
                <br />
               <div class="border_bottom_solid1"></div>              
               <span class="padding_right40" style="font-weight:bold;"><?php echo number_format($bal, 2, '.', ','); ?></span>
             </div>
             
        	<div class="clearfix"></div>
        </div>    
         
        </div> <!----- END HEADER body --------------->  
     </div> <!--watermark-->



 



<!-- --------------- LAB COPY ------------------->

<label style="margin-top:50px; border-top: 2px dotted #000000; font-weight:bold; font-style:italic; font-size:16px;"><br/>Escent Copy</label>
<div> 
<table class="table table-bordered" style="margin: 5px 0px 10px 0px;">
<thead class="esc-t-head">
<tr>
<th style="font-weight:normal;">
<div class="esc-pateint-details">  <!-----------------START of patient details------------------->
      <div class="esc-row">
        <div class="pull-left">Registration No : <strong><?php echo 'ED/'.$receipt_no_tbl; ?></strong></div>
        <div class="pull-right"><?php if($patient_phone != ""){echo ' <i class="fa fa-phone-square fa-fw"></i>  +91 '.$patient_phone;} ?></div>
        <div class="clearfix"></div>
      </div>

      <div class="row text">
      <div class="esc-r-name pull-left">Name : <?php echo $patient_name; ?></div>
      <div class="esc-r-age pull-right text-right"><i class="fa fa-calendar fa-fw"></i> <?php echo date("d/m/Y, h:i a", strtotime($pr_date)); ?>
      </div>
      <div class="clearfix"></div>
      </div>

    <div class="row">
    <div class="esc-r-add pull-left">
    Address : <?php echo $patient_address; ?>, <?php echo $district; ?>, <?php echo $state; ?> <?php if($pin != ""){echo " - ".$pin;} ?>
    </div>
    
    <div class="esc-r-contact2 pull-right text-right"> <i class="fa fa-male"></i><i class="fa fa-female"></i> : 
    <?php echo $gender_name.' / '.$age; echo ' ('.$marital_name.')'; ?>
    </div>
    <div class="clearfix"></div>
    </div>

    	<div class="row">
        <div class="esc-r-add pull-left">Ref. By : <?php if($dr_letter =='NO') {echo "Self";} else{ echo "Dr. ". $dr_name;} ?></div>
        <div class="clearfix"></div>
        
       <div class=" padding_top10"></div>
       
        <div class="row">
        <div class="esc-r-add pull-left" >* Patient History : <?php  echo showHistory_patient($con, $patient_id); ?></div>
        <div class="clearfix"></div>
        
        <div class="row">
        <div class="esc-r-add pull-left">* Lab Note : <?php echo showLab_note($con, $receipt_no_tbl);?></div>
        <div class="clearfix"></div>
    </div>
    </th>
    </thead>
    </table>
</div>   <!--end patient details -->

<div class="row">

  <!-- Table -->
  <table class="table table-striped table-bordered" style="margin: 5px 0px 10px 0px;">
  	<thead class="esc-t-head">
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

     </div> <!--watermark-->
     </div>

<div class="clearfix"></div>
    </div>

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