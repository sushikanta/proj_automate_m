<?php require_once("config.php"); ?>
<?php
  session_start();
  session_unset();
  ob_start();
  unset($_SESSION['status']);
  unset($_SESSION['username']);
  unset($_SESSION['user_full_name']);
  unset($_SESSION['user_dept_id']);  
  session_destroy();
  
  header( 'Location: index.php?smsg=1' ) ;
  ob_end_flush();
?>