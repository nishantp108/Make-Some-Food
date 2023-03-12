<?php
include("validuser.php");
if(isset($_POST['submit']))
{
	include("connect.php");
	$recipe_id = $_POST['recipe_id'];
	$user_id = $_SESSION['user_id'];
	$content = $_POST['message'];
	$select = mysqli_query($connect,"INSERT INTO recipe_report VALUES($recipe_id,$user_id,'$content')");
	if(mysqli_error($connect))
	{
		echo "Error";
	}
	else
	{
		header("location:recipeview.php?recipe_id=".$recipe_id."");
		return;
	}
}