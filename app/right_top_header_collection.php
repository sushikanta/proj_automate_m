<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
  <div class="container">

  <div class="navbar-header"> 
      <a class="navbar-brand" href="#"><img src="images/brand-logo.png" class="img-responsive" alt="Responsive image"/></a>
  </div>  
   
  <nav class="nav-collapse collapse bs-navbar-collapse" role="navigation"> 
    <ul class="nav navbar-nav">      
      
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'sample_collection_table.php' || basename($_SERVER['REQUEST_URI']) =='sample_collection_test_list.php'){echo 'active'; }else { echo ""; } ?>">
    <a href="sample_collection_table.php"><i class="fa fa-tint fa-fw fa-lg"></i>Sample Collection</a></li>
 
 <li class="<?php if(basename($_SERVER['REQUEST_URI']) == '#'){echo 'active'; }else { echo ""; } ?>">
    <a href="#"><i class="fa fa-list fa-fw fa-lg"></i> Patient List</a></li>     
    
  <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'user_table_sample_collection.php'){echo 'active'; }else { echo ""; } ?>">
    <a href="user_table_sample_collection.php"><i class="fa fa-user fa-fw fa-lg"></i>Sample Collectors</a></li>       

</ul>
				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <?php echo $_SESSION['name'];?> <b class="caret"></b></a>
				  <ul class="dropdown-menu">
                    <li><a href="#"><i class="icon-cog"></i> Preferences</a></li>
                    <li><a href="#"><i class="icon-envelope"></i> Contact Support</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
				 </ul>
				</li>
				</ul>
			</nav>	
</div>
</header>