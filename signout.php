<?php 
	session_start();
	if(isset($_SESSION['username'])&&$_SESSION['username']!=NULL){
		unset($_SESSION['username']);
		header('location:signin.php');
	}
?>