<?php
include("validuser.php");

if(isset($_POST['postc']))
{
	$comment = $_POST['comment'];
	$recipe_id = $_POST['recipe_id'];
	$user_id = $_SESSION['user_id'];
	include("connect.php");
	$select = mysqli_query($connect,"INSERT INTO comment(recipe_id,user_id,comment) VALUES($recipe_id,$user_id,'$comment')");
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