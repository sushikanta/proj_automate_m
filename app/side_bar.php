<div class="side-bar">
  <ul class="nav nav-list bs-docs-sidenav affix">
    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'patient_registration.php'){echo 'active'; }else { echo ""; } ?>">
    <a href="patient_registration.php"><i class="icon-user icon-large icon-white"></i>&nbsp;&nbsp;&nbsp;New Registration</a></li>
    
    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == 'patient_list.php'){echo 'active'; }else { echo ""; } ?>">
    <a href="patient_list.php"><i class="icon-search icon-large icon-white"></i>&nbsp;&nbsp;&nbsp;Patient List</a></li>
    
    <li class="<?php if(basename($_SERVER['REQUEST_URI']) == '#'){echo 'active'; }else { echo ""; } ?>">
    <a href="#"><i class="icon-search icon-large icon-white"></i>&nbsp;&nbsp;&nbsp;Patient Test</a></li>
  </ul>
</div>	