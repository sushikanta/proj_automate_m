<header id="top" class="navbar navbar-inverse navbar-fixed-top bs-navbar" role="banner">

<div class="container">
 <div class="navbar-header">
<!--  <button class="navbar-toggle" data-target=".bs-navbar-collapse" data-toggle="collapse" type="button">-->
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
  </button>
  <a class="navbar-brand" href="#" style="color:#FFF;"><img src="images/logo.png" style="width:60px; height: 47px;" alt="logo"></img> Super Admin </a>
  </div>

<nav class="nav-collapse collapse bs-navbar-collapse" role="navigation">

<ul class="nav navbar-nav" style="color:#ffffff;">

<!------------------------------- REport -------------------------------------->
	 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'SAD_report_ui.php' || basename($_SERVER['REQUEST_URI']) == 'SAD_report_all_ui.php' || basename($_SERVER['REQUEST_URI']) == 'fd_add_source_name.php'){echo 'active'; } ?>">
 <a data-toggle="dropdown" class="dropdown-toggle" href="">Report <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'SAD_report_ui.php'){echo 'active'; } ?>">
        	<a href="SAD_report_ui.php"><i class="fa fa-list fa-fw"></i> No Due/Disc Registration</a>
        </li>

        <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'SAD_report_all_ui.php'){echo 'active'; } ?>">
        	<a href="SAD_report_all_ui.php"><i class="fa fa-list fa-fw"></i> All Registration</a>
        </li>


     </ul>
 </li>

 <!------------ USERS ------------>
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'user_table_admin.php'){echo 'active'; } ?>">
        <a href="user_table_admin.php">User</a></li>


 </ul>

<!-------------------------------------------- welcome ----------------------------------->
<ul class="nav navbar-nav navbar-right">
          <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'front_desk_setting.php'){echo 'active'; } ?>"><a data-toggle="dropdown" class="dropdown-toggle" href=""><!--<i class="fa fa-user fa-fw fa-lg"></i>-->Welcome, <?php if(isset($_SESSION['name'])){echo $_SESSION['name'];}?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
          <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'change_password_sad.php'){echo 'active'; } ?>">
          <a href="change_password_sad.php"><i class="fa fa-cog fa-fw"></i> Change Password</a></li>
          <li><a href=""><i class="fa fa-envelope fa-fw"></i> Contact Support</a></li>
          <li class="divider"></li>
          <li><a href="logout.php"><i class="fa fa-power-off fa-fw"></i> Logout</a></li>
      </ul>

 </nav>
</div>
</header>

