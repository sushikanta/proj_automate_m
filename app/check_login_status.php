<?php require_once("function.php");
session_start();
ob_start();
// NOT LOGIN IN USERS
if(!isset($_SESSION['status'])){
	session_destroy();
	header("location: index.php?errmsg=3");
	exit;	
	}
?>