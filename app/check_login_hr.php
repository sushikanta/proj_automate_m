<?php require_once("function.php");
session_start();
ob_start();
if(!isset($_SESSION['status'])){
	header("location: index.php?errmsg=3");
	exit;	
	}
if(isset($_SESSION['status']) && $_SESSION['status'] !='okHr'){
	header("location: index.php?errmsg=3");
	exit;	
	}
?>