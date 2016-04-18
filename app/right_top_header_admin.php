<?php
$app_title = 'Automate-M';
if (isset($_SESSION['app_settings'])) {
    $settings = $_SESSION['app_settings'];
    if (@$settings['logo']['setting']) {
        $trial_days = $settings['trial_days']['setting'];
        $logo_img = '<img height="50px" style="max-width: 119px;" src="' . $settings['logo']['setting'] . '" />';

    }
    if (@$settings['app_name']['setting']) {
        $app_title = @$settings['app_name']['setting'];
    }
}

?>
<header class="navbar navbar-inverse navbar-fixed-top no-print" role="banner" id="no-print">
  <div class="container">

  <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
  </button>
      <a class="navbar-brand" href="#" style="color:#FFF; line-height: 45px; padding-left: 10px"><?php echo @$logo_img; ?>  <?php echo $app_title; ?>: Admin</a>
  
  </div>

  <nav class="nav-collapse collapse bs-navbar-collapse" role="navigation">
    <ul class="nav navbar-nav">

<!---------- SEARCH -------- -->
<li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'search_ui_admin.php'){echo 'active'; } ?>">
<a href="search_ui_admin.php"><i class="fa fa-search fa-lg fa-fw"></i></a></li>

 <!---------  LIST ------- -->
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'discount_today.php' || basename($_SERVER['REQUEST_URI']) == 'card_holder_list.php'){echo 'active'; } ?>">
 <a data-toggle="dropdown"  data-hover="dropdown" class="dropdown-toggle" href="#">
<!-- <i class="fa fa-ticket fa-fw fa-lg"></i> -->List <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'discount_today.php'){echo 'active'; } ?>">
        <a href="discount_today.php"><i class="fa fa-list fa-fw "></i> Discount (Today) </a></li>
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'card_holder_list.php'){echo 'active'; } ?>">
        <a href="card_holder_list.php"><i class="fa fa-list fa-fw"></i> Card Holder (Today)</a></li>
     </ul>
 </li>



<!------------------ INVESTIGATION ----------- -->
<li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'price_version.php' || basename($_SERVER['REQUEST_URI']) == 'price_revise.php' || basename($_SERVER['REQUEST_URI']) == 'price_compare.php' || basename($_SERVER['REQUEST_URI']) == 'testCategory.php' || basename($_SERVER['REQUEST_URI']) == 'testName_price.php'){echo 'active'; } ?>">
  <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><!--<i class="fa fa-circle-o fa-fw fa-lg"></i> -->Investigation <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'testName_price.php'){echo 'active'; } ?>">
        <a href="testName_price.php"><i class="fa fa-plus fa-fw"></i> Investigation</a>
        </li>
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'testCategory.php'){echo 'active'; } ?>">
        <a href="testCategory.php"><i class="fa fa-plus fa-fw"></i> Category</a></li>

          <li class="divider"></li>
          <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'price_version.php'){echo 'active'; } ?>">
          <a href="price_version.php"><i class="fa fa-plus fa-fw"></i> Price Version </a></li>
           <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'price_revise.php'){echo 'active'; } ?>">
          <a href="price_revise.php"><i class="fa fa-plus fa-fw"></i> Revise Price </a></li>
           <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'price_compare.php'){echo 'active'; } ?>">
          <a href="price_compare.php"><i class="fa fa-plus fa-fw"></i> Version wise Price </a></li>

    </ul>
 </li>


<li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'doctor_add.php' || basename($_SERVER['REQUEST_URI']) == 'doctor_table.php' || basename( $_SERVER['SCRIPT_NAME']) == 'doctor_detail_view.php' || basename( $_SERVER['SCRIPT_NAME']) == 'doctor_detail.php')
{echo 'active';} ?>">
<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><!--<i class="fa fa-user-md fa-fw fa-lg"></i> -->Doctor <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'doctor_add.php'){echo 'active'; } ?>">
        <a href="doctor_add.php"><i class="fa fa-plus fa-fw"></i> Doctor</a></li>
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'doctor_table.php'){echo 'active'; } ?>">
        <a href="doctor_table.php"><i class="fa fa-list fa-fw"></i> Doctor List</a></li>
      </ul>
 </li>

 <!---------- DEPARTMENT -------->
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'department_table.php'){echo 'active'; } ?>">
        <a href="department_table.php">Dept</a></li>

  <!-------- DESIGNATION ------>
  <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'designation_table.php'){echo 'active'; } ?>">
        <a href="designation_table.php">Designation</a></li>


  <!---------- EDIT / REMOVE ------>
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'district_tbl_admin.php' || basename($_SERVER['REQUEST_URI']) == 'state_tbl_admin.php' || basename($_SERVER['REQUEST_URI']) == 'source_type_admin.php' || basename($_SERVER['REQUEST_URI']) == 'source_name_admin.php'){echo 'active'; } ?>">
 <a data-toggle="dropdown"  data-hover="dropdown" class="dropdown-toggle" href="">Edit <b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'expenditure_search_ui.php'){echo 'active'; } ?>">
    <a href="expenditure_search_ui.php" target="_blank"><i class="fa fa-edit fa-fw"></i> Expenditure </a>
    </li>
     <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'district_tbl_admin.php'){echo 'active'; } ?>">
        <a href="district_tbl_admin.php"><i class="fa fa-edit fa-fw"></i> District</a>
    </li>
    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'state_tbl_admin.php'){echo 'active'; } ?>">
        <a href="state_tbl_admin.php"><i class="fa fa-edit fa-fw"></i> State</a>
    </li>
    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'source_name_admin.php'){echo 'active'; } ?>">
        <a href="source_name_admin.php"><i class="fa fa-edit fa-fw"></i> Source Name</a>
    </li>
    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'source_type_admin.php'){echo 'active'; } ?>">
        <a href="source_type_admin.php"><i class="fa fa-edit fa-fw"></i> Source Type</a>
    </li>

  </ul>
 </li>

<!------------FYI-------------->
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_employee.php' || basename($_SERVER['REQUEST_URI']) == 'FYI_referrals.php' || basename($_SERVER['REQUEST_URI']) == 'FYI_pin.php'){echo 'active'; } ?>">
 <a data-toggle="dropdown"  data-hover="dropdown" class="dropdown-toggle" href="">
 <!--<i class="fa fa-info-circle fa-spin fa-fw fa-lg"></i> -->F&nbsp;Y&nbsp;I&nbsp;<b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_employee.php'){echo 'active'; } ?>">
        	<a href="FYI_employee.php" target="_blank"><i class="fa fa-users fa-fw"></i> Employee List</a>
        </li>
         <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_referrals.php'){echo 'active'; } ?>">
        	<a href="FYI_referrals.php" target="_blank"><i class="fa fa-circle fa-fw"></i> Other Sources</a>
        </li>
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_pin.php'){echo 'active'; } ?>">
        	<a href="FYI_pin.php" target="_blank"><i class="fa fa-sort-alpha-asc fa-fw"></i> PIN Code -  Manipur</a>
        </li>
     </ul>
 </li>
 <!------------ End FYI-------------->

</ul>

  <!------welcome/Logout------>
  <ul class="nav navbar-nav navbar-right">
	<li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'change_password_admin.php'){echo 'active';} ?>" >
		<a data-toggle="dropdown"  data-hover="dropdown" class="dropdown-toggle" href="#"><!--<i class="fa fa-user fa-fw fa-lg"></i>-->
			Welcome, <?php echo $_SESSION['name'];?> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'change_password_adm.php'){echo 'active'; } ?>">
          	<a href="change_password_adm.php"><i class="fa fa-cog fa-fw"></i> Change Password</a>
          </li>
            <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'settings.php'){echo 'active'; } ?>">
                <a href="settings.php"><i class="fa fa-cog fa-fw"></i> Settings</a>
            </li>
          <li><a href="#"><i class="fa fa-envelope fa-fw"></i> Contact Support</a></li>
          <li class="divider"></li>
          <li><a href="logout.php"><i class="fa fa-power-off fa-fw"></i> Logout</a></li>
       </ul>
      </li>
   </ul>
			</nav>
</div>
</header>
