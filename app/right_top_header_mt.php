<header id="top" class="navbar navbar-inverse navbar-fixed-top bs-navbar" role="banner">

<div class="container"> 
 <div class="navbar-header">
<!--  <button class="navbar-toggle" data-target=".bs-navbar-collapse" data-toggle="collapse" type="button">-->
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
  </button> 
  <a class="navbar-brand" href="#" style="color:#FFF;"><img src="images/logo.png" style="width:60px; height: 47px;" alt="logo"></img> MT </a> 
  </div>  
   
<nav class="nav-collapse collapse bs-navbar-collapse" role="navigation">  

<ul class="nav navbar-nav" style="color:#ffffff;">        
   
  
 <!------------------------ TEMPLATE --------------------------------> 
   <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'MT_test_list.php'){echo 'active'; } ?>">
   <a href="MT_test_list.php">Template</a>
   </li>
   
   <!------------------------ SEarch -------------------------------->      
   <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'MT_search.php'){echo 'active'; } ?>">
        	<a href="MT_search.php"><i class="fa fa-search fa-fw fa-lg"></i> </a>
    </li>
    
    
     <!------------------------ LIST -------------------------------->  
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'MT_pending_all.php' || basename($_SERVER['REQUEST_URI']) == 'patient_discount_FD.php' || basename($_SERVER['REQUEST_URI']) == 'card_holder_list_fd.php'){echo 'active'; } ?>">
 <a data-toggle="dropdown" class="dropdown-toggle" href=""> List <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'MT_pending_all.php'){echo 'active'; } ?>">
        	<a href="MT_pending_all.php?tid=1"><i class="fa fa-list fa-fw"></i> Pending (ALL)</a>
        </li>
        
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'MT_pending_all.php'){echo 'active'; } ?>">
        	<a href="MT_pending_all.php?tid=2"><i class="fa fa-list fa-fw"></i> EDs (Today)</a>
        </li>
     </ul> 
 </li> 
    
 
  
   <!------------------------ Add -------------------------------->          
        
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'MT_template_create_ui.php' || basename($_SERVER['REQUEST_URI']) == 'fd_add_source_type.php' || basename($_SERVER['REQUEST_URI']) == 'fd_add_source_name.php'){echo 'active'; } ?>">
 <a data-toggle="dropdown" class="dropdown-toggle" href="">Template <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'MT_template_create_ui.php'){echo 'active'; } ?>">
        	<a href="MT_template_create_ui.php"><i class="fa fa-frame fa-fw"></i> Create Report Template</a>
        </li>
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'fd_add_source_type.php'){echo 'active'; } ?>">
        	<a href="fd_add_source_type.php"><i class="fa fa-list-alt fa-fw"></i> Add Source type</a>
        </li>   
        
         <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'fd_add_source_name.php'){echo 'active'; } ?>">
        	<a href="fd_add_source_name.php"><i class="fa fa-list-alt fa-fw"></i> Add Source Name</a>
        </li>   
              
     </ul> 
 </li> 
       
       
  <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'patient_discount_FD.php'){echo 'active'; } ?>"><a href="patient_discount_FD.php">Discount</a></li>      
       
       
       
       
       
       
        <!------------------------ Card Holder -------------------------------->  
 <!--<li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'card_holder_registration.php' || basename($_SERVER['REQUEST_URI']) == 'card_holder_view.php'){echo 'active'; } ?>">
 <a data-toggle="dropdown" class="dropdown-toggle" href=""> Card <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'card_holder_view.php'){echo 'active'; } ?>">
        	<a href="card_holder_view.php"><i class="fa fa-list fa-fw"></i> View All Card Holder</a>
        </li>
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'card_holder_registration.php'){echo 'active'; } ?>">
        	<a href="card_holder_registration.php"><i class="fa fa-plus fa-fw"></i> Add Card Holder</a>
        </li>   
       
     </ul> 
 </li> -->
   
       
       
       
       <!-- 
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'patient_table_pending.php'){echo 'active'; } ?>">
        	<a href="patient_table_pending.php">Pending</a>
        </li>   
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'patient_table_due.php'){echo 'active'; } ?>">
        	<a href="patient_table_due.php">Due</a>
        </li>
         <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'patient_table_available.php'){echo 'active'; } ?>">
        	<a href="patient_table_available.php">Report Avail</a>
        </li>          
         <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'patient_table_delivered.php'){echo 'active'; } ?>">
        	<a href="patient_table_delivered.php">Delivered</a>
        </li>               
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'patient_table.php'){echo 'active'; } ?>">
        	<a href="patient_table.php">ALL</a>
        </li> 
 -->
          
          
          
          
    
   <!--<li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'patient_old_info_search.php' || basename($_SERVER['REQUEST_URI']) == 'patient_registration_from_search.php'){echo 'active'; } ?>"><a href="patient_old_info_search.php"> Old</a></li>-->
          

 
        
  		 <!-- <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FD_report_dues_ui.php' || basename($_SERVER['REQUEST_URI']) == 'FD_report_balance_sheet.php'  || basename($_SERVER['REQUEST_URI']) == 'FD_report_balance_sheet_all.php'){echo 'active'; } ?>"><a href="FD_report_dues_ui.php">Due</a>
        </li>    -->
        
         
 <!------------------------------------------------ Report ----------------------------------------->        
 
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FD_report_ac_statement_ui.php'){echo 'active'; } ?>"><a href="FD_report_ac_statement_ui.php">Report</a>
        </li>    
 
 <!--
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FD_report_expenditure_ui.php' || basename($_SERVER['REQUEST_URI']) == 'FD_report_ac_statement_ui.php'){echo 'active'; } ?>">
 <a data-toggle="dropdown" class="dropdown-toggle" href="">
 <i class="fa fa-info-circle fa-fw"></i> Report <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FD_report_expenditure_ui.php'){echo 'active'; } ?>">
        	<a href="FD_report_expenditure_ui.php"><i class="fa fa-money fa-fw"></i> Daily Expenditure</a>
        </li>
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FD_report_ac_statement_ui.php'){echo 'active'; } ?>">
        	<a href="FD_report_ac_statement_ui.php"><i class="fa fa-list-alt fa-fw"></i> A/C Statement</a>
        </li>   
        
         <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'AD_cut.php'){echo 'active'; } ?>">
        	<a href="AD_cut.php"><i class="fa fa-list-alt fa-fw"></i> CUT REFERRAL</a>
        </li>   
              
     </ul> 
 </li> -->
         
         
<!------------------------------------------------ FYI ----------------------------------------->                  
<li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_price_list.php' || basename($_SERVER['REQUEST_URI']) == 'FYI_doctor.php' || basename($_SERVER['REQUEST_URI']) == 'FYI_employee.php' || basename($_SERVER['REQUEST_URI']) == 'FYI_referrals.php' || basename($_SERVER['REQUEST_URI']) == 'FYI_pin.php'){echo 'active'; } ?>">
 <a data-toggle="dropdown" class="dropdown-toggle" href="">
 <!--<i class="fa fa-info-circle fa-fw"></i>-->F&nbsp;Y&nbsp;I&nbsp;<b class="caret"></b></a>
    <ul class="dropdown-menu">
	    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FD_report_dues_ui.php'){echo 'active'; } ?>">
        	<a href="FD_report_dues_ui.php"><i class="fa fa-circle-o fa-fw"></i> Dues Sheet</a>
        </li>
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_price_list.php'){echo 'active'; } ?>">
        	<a href="FYI_price_list.php"><i class="fa fa-circle-o fa-fw"></i> Investigation</a>
        </li>
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_doctor.php'){echo 'active'; } ?>">
        	<a href="FYI_doctor.php"><i class="fa fa-user-md fa-fw"></i> Doctors</a>
        </li>   
         <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_employee.php'){echo 'active'; } ?>">
        	<a href="FYI_employee.php"><i class="fa fa-users fa-fw"></i> Staff</a>
        </li>          
         <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_referrals.php'){echo 'active'; } ?>">
        	<a href="FYI_referrals.php"><i class="fa fa-circle fa-fw"></i> Referrals from other sources</a>
        </li>               
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_pin.php'){echo 'active'; } ?>">
        	<a href="FYI_pin.php"><i class="fa fa-sort-alpha-asc fa-fw"></i> PIN Code -  Manipur</a>
        </li> 
     </ul> 
 </li> 
 
 
 </ul>

<!-------------------------------------------- welcome ----------------------------------->                  
<ul class="nav navbar-nav navbar-right">
          <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'user_table_admin_setting.php'){echo 'active'; } ?>"><a data-toggle="dropdown" class="dropdown-toggle" href=""><!--<i class="fa fa-user fa-fw fa-lg"></i>-->Welcome, <?php if(isset($_SESSION['name'])){echo $_SESSION['name'];}?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
          <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'user_table_admin_setting.php'){echo 'active'; } ?>">
          <a href="user_table_admin_setting.php"><i class="fa fa-cog fa-fw"></i> Setting</a></li>
          <li><a href=""><i class="fa fa-envelope fa-fw"></i> Contact Support</a></li>
          <li class="divider"></li>
          <li><a href="logout.php"><i class="fa fa-power-off fa-fw"></i> Logout</a></li>
      </ul>   
  
 </nav>
</div>
</header>
   
 