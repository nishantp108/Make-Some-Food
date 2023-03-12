<?php
session_start();
if(isset($_SESSION['user_first_name']) && isset($_SESSION['user_last_name']) && isset($_SESSION['user_id'])){
	$user_first_name = $_SESSION['user_first_name'];
	$user_last_name = $_SESSION['user_last_name'];
	$user_id = $_SESSION['user_id']; 
	//echo $_SESSION['user_id'];echo $_SESSION['user_first_name'];echo $_SESSION['user_last_name'];
}
else
{
	//echo $_SESSION['user_id'];echo $_SESSION['user_first_name'];echo $_SESSION['user_last_name'];
	//header("location:Signin.php");
	//return;
}
?>