<header id="top" class="navbar navbar-inverse navbar-fixed-top bs-navbar" role="banner">
<div class="container">
 <div class="navbar-header">
<!--  <button class="navbar-toggle" data-target=".bs-navbar-collapse" data-toggle="collapse" type="button">-->
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
  </button>
     <a class="navbar-brand" href="#" style="color:#FFF; line-height: 45px; padding-left: 10px"> HR - Dept </a>
  </div>

<nav class="nav-collapse collapse bs-navbar-collapse" role="navigation">

<ul class="nav navbar-nav" style="color:#ffffff;">

    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'employee_table.php'){echo 'active'; }else { echo ""; } ?>">
    <a href="employee_table.php"> List</a>
    </li>

    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'employee_add.php'){echo 'active'; }else { echo ""; } ?>">
    <a href="employee_add.php"> Add</a>
    </li>







<!------------FYI-------------->
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_pin.php'){echo 'active'; } ?>">
 <a data-toggle="dropdown" class="dropdown-toggle" href=""> F&nbsp;Y&nbsp;I&nbsp; <b class="caret"></b></a>
    <ul class="dropdown-menu">

        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'FYI_pin.php'){echo 'active'; } ?>">
        	<a href="FYI_pin.php"><i class="fa fa-sort-alpha-asc fa-fw"></i> PIN Code -  Manipur</a>
        </li>
     </ul>
 </li>
</ul>

  <!------welcome/Logout------>
  <ul class="nav navbar-nav navbar-right">
	<li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'user_table_admin_setting.php'){echo 'active';} ?>" >
		<a data-toggle="dropdown" class="dropdown-toggle" href="#">
			Welcome, <?php echo $_SESSION['name'];?> <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'change_password_hr.php'){echo 'active'; } ?>">
          	<a href="change_password_hr.php"><i class="fa fa-cog fa-fw"></i> Change Password</a>
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
