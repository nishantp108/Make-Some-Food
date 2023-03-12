<?php
include("connect.php");
//session_start();
//$recipe_made_user_id  = $_SESSION['recipe_made_user_id'];
//$user_id = $_SESSION['user_id'];
if(isset($_GET['recipe_made_user_id']) && isset($_GET['user_id']) && isset($_GET['recipe_id']))
{
	$recipe_made_user_id = $_GET['recipe_made_user_id'];	
	$user_id=$_GET['user_id'];
	$recipe_id = $_GET['recipe_id'];
	$check = mysqli_query($connect,"SELECT * FROM `user_follow` WHERE `user_following_id`= $user_id AND user_follower_id=$recipe_made_user_id");
	if(mysqli_num_rows($check) == 0)
	{
		$select = mysqli_query($connect,"INSERT INTO `user_follow`(`user_following_id`, `user_follower_id`) VALUES (".$user_id.",".$recipe_made_user_id.")");
		
	}
	else if(mysqli_num_rows($check) !=0)
	{
		$select = mysqli_query($connect,"DELETE FROM `user_follow` WHERE `user_following_id`= $user_id AND user_follower_id=$recipe_made_user_id");
		//error1();
	}
	if(mysqli_error($connect))
	{
		echo "error";
	}
	else
	{	
		header("location:Recipeview.php?recipe_id=$recipe_id");
		return;
	}	
}
else if(isset($_GET['recipe_made_user_id']) && isset($_GET['user_id']))
{
	$recipe_made_user_id = $_GET['recipe_made_user_id'];	
	$user_id=$_GET['user_id'];
	$check = mysqli_query($connect,"SELECT * FROM `user_follow` WHERE `user_following_id`= $user_id AND user_follower_id=$recipe_made_user_id");
	if(mysqli_num_rows($check) == 0)
	{
		$select = mysqli_query($connect,"INSERT INTO `user_follow`(`user_following_id`, `user_follower_id`) VALUES (".$user_id.",".$recipe_made_user_id.")");
	}
	else if(mysqli_num_rows($check) !=0)
	{
		$select = mysqli_query($connect,"DELETE FROM `user_follow` WHERE `user_following_id`= $user_id AND user_follower_id=$recipe_made_user_id");
		//error1();
	}
	if(mysqli_error($connect))
	{
		echo "error";
	}
	else
	{	
		header("location:profile_for_other.php?user_id=".$recipe_made_user_id);
		return;
	}

	
}
