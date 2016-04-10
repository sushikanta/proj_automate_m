<header id="top" class="navbar navbar-inverse navbar-fixed-top bs-navbar" role="banner">
<div class="container">
<div class="navbar-header">
<!--  <button class="navbar-toggle" data-target=".bs-navbar-collapse" data-toggle="collapse" type="button">-->
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
  </button>
  <a class="navbar-brand" href="#" style="color:#FFF;"><!-- <img src="images/logo.png" style="width:60px; height: 47px;" alt="logo"></img>--> Front Desk </a>
  </div>

<nav class="nav-collapse collapse bs-navbar-collapse" role="navigation">

<ul class="nav navbar-nav" style="color:#ffffff;">


 <!------------------------ New -------------------------------->
   <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'patient_registration.php'){echo 'active'; } ?>">
   <a href="patient_registration.php">New</a>
   </li>

   <!------------------------ SEarch -------------------------------->
   <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'fd_search.php'){echo 'active'; } ?>">
   <a href="fd_search.php"><i class="fa fa-search fa-fw fa-lg"></i> </a>
   </li>

 <!-----------ADD -------------->
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'expenditure_tbl.php' || basename($_SERVER['REQUEST_URI']) == 'patient_info_add.php' || basename($_SERVER['REQUEST_URI']) == 'fd_add_doctor.php' || basename($_SERVER['REQUEST_URI']) == 'fd_add_source_type.php' || basename($_SERVER['REQUEST_URI']) == 'fd_add_source_name.php' || basename($_SERVER['REQUEST_URI']) == 'state_tbl.php' || basename($_SERVER['REQUEST_URI']) == 'district_tbl.php'){echo 'active'; } ?>">
 <a data-toggle="dropdown"  data-hover="dropdown" class="dropdown-toggle" href="">Add <b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'expenditure_tbl.php'){echo 'active'; } ?>">
    <a href="expenditure_tbl.php"><i class="fa fa-plus fa-fw"></i> Expenditure (Daily) </a>
    </li>
    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'patient_info_add.php'){echo 'active'; } ?>">
    <a href="patient_info_add.php"><i class="fa fa-plus fa-fw"></i> Patient Info </a>
    </li>
     <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'district_tbl.php'){echo 'active'; } ?>">
        <a href="district_tbl.php"><i class="fa fa-plus fa-fw"></i> District</a>
    </li>
    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'state_tbl.php'){echo 'active'; } ?>">
        <a href="state_tbl.php"><i class="fa fa-plus fa-fw"></i> State</a>
    </li>
    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'fd_add_doctor.php'){echo 'active'; } ?>">
        <a href="fd_add_doctor.php"><i class="fa fa-plus fa-fw"></i> Dr. Name</a>
    </li>
    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'fd_add_source_type.php'){echo 'active'; } ?>">
        <a href="fd_add_source_type.php"><i class="fa fa-plus fa-fw"></i> Source type</a>
    </li>

    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'fd_add_source_name.php'){echo 'active'; } ?>">
        <a href="fd_add_source_name.php"><i class="fa fa-plus fa-fw"></i> Source Name</a>
    </li>
  </ul>
 </li>


        <!------------------------ LIST -------------------------------->
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'fd_pending_all.php' || basename($_SERVER['REQUEST_URI']) == 'patient_discount_FD.php' || basename($_SERVER['REQUEST_URI']) == 'card_holder_list_fd.php'){echo 'active'; } ?>">
 <a data-toggle="dropdown"  data-hover="dropdown" class="dropdown-toggle" href=""> List <b class="caret"></b></a>
    <ul class="dropdown-menu">
       <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'fd_pending_all.php'){echo 'active'; } ?>">
          <a href="fd_pending_all.php?tid=1"><i class="fa fa-list fa-fw"></i> Pending (Registration Status)</a>
        </li>

        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'fd_pending_all.php'){echo 'active'; } ?>">
        	<a href="fd_pending_all.php?tid=2"><i class="fa fa-list fa-fw"></i> Today ( Registration )</a>
        </li>

         <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'patient_discount_FD.php'){echo 'active'; } ?>">
        	<a href="patient_discount_FD.php"><i class="fa fa-list fa-fw"></i> Today (Discounted Registration)</a>
        </li>
          <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'card_holder_list_fd.php'){echo 'active'; } ?>">
        	<a href="card_holder_list_fd.php"><i class="fa fa-list fa-fw"></i> Card Holder</a>
        </li>

     </ul>
 </li>

<!---------------- TRACE ------------------>
<li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'trace_ui.php'){echo 'active'; } ?>">
<a href="trace_ui.php">Trace</a>
</li>

<!---------------- Report ------------------>
<li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'report_ui_fd.php'){echo 'active'; } ?>">
<a href="report_ui_fd.php">Report</a>
</li>

<!---------------- DUES ------------------>
<li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'report_ui_fd_due.php'){echo 'active'; } ?>">
<a href="report_ui_fd_due.php">Due</a>
</li>

<!----------------- FYI ------------>
<li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_price_list.php' || basename($_SERVER['REQUEST_URI']) == 'FYI_doctor.php' || basename($_SERVER['REQUEST_URI']) == 'FYI_employee.php' || basename($_SERVER['REQUEST_URI']) == 'FYI_referrals.php' || basename($_SERVER['REQUEST_URI']) == 'FYI_pin.php'){echo 'active'; } ?>">
 <a data-toggle="dropdown"  data-hover="dropdown" class="dropdown-toggle" href="">
 <!--<i class="fa fa-info-circle fa-fw"></i>-->F&nbsp;Y&nbsp;I&nbsp;<b class="caret"></b></a>
    <ul class="dropdown-menu">

        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_price_list.php'){echo 'active'; } ?>">
        	<a href="FYI_price_list.php" target="_blank"><i class="fa fa-circle-o fa-fw"></i> Investigation</a>
        </li>
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_doctor.php'){echo 'active'; } ?>">
        	<a href="FYI_doctor.php" target="_blank"><i class="fa fa-user-md fa-fw"></i> Doctors</a>
        </li>
         <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_employee.php'){echo 'active'; } ?>">
        	<a href="FYI_employee.php" target="_blank"><i class="fa fa-users fa-fw"></i> Staff</a>
        </li>
         <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_referrals.php'){echo 'active'; } ?>">
        	<a href="FYI_referrals.php" target="_blank"><i class="fa fa-circle fa-fw"></i> Other Source | Name</a>
        </li>
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_pin.php'){echo 'active'; } ?>">
        	<a href="FYI_pin.php" target="_blank"><i class="fa fa-sort-alpha-asc fa-fw"></i> PIN Code -  Manipur</a>
        </li>
     </ul>
 </li>
 </ul>

<!-------------------------------------------- welcome ---------------------------------->
<ul class="nav navbar-nav navbar-right">
          <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'front_desk_setting.php'){echo 'active'; } ?>">
          <a data-toggle="dropdown"  data-hover="dropdown" class="dropdown-toggle" href=""><!--<i class="fa fa-user fa-fw fa-lg"></i>-->Welcome, <?php if(isset($_SESSION['name'])){echo $_SESSION['name'];}?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
          <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'change_password_fd.php'){echo 'active'; } ?>">
          <a href="change_password_fd.php" target="_blank"><i class="fa fa-cog fa-fw"></i> Change Password </a></li>
          <li><a href=""><i class="fa fa-envelope fa-fw"></i> Contact Support</a></li>
          <li class="divider"></li>
          <li><a href="logout.php"><i class="fa fa-power-off fa-fw"></i> Logout</a></li>
      </ul>

 </nav>
</div>
</header>
