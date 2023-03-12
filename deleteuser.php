<?php
include("validuser.php");
if(isset($_GET['user_id']))
{
	$user_id = $_GET['user_id'];
	include("connect.php");
	$select = mysqli_query($connect,"SELECT recipe_id FROM recipe_info WHERE user_id=$user_id");
	if(mysqli_num_rows($select))
	{
		while($selectarray = mysqli_fetch_assoc($select))
		{
			$recipe_id = $selectarray['recipe_id'];
			$selectreport = mysqli_query($connect,"DELETE FROM recipe_report WHERE recipe_id=$recipe_id");
			//err($selectreport);
			$selectrecipe = mysqli_query($connect,"DELETE FROM recipe_info WHERE recipe_id=$recipe_id");
			//err($selectreport);
			$selectlog = mysqli_query($connect,"DELETE FROM ing_log WHERE recipe_id=$recipe_id");
			//err();
			$selectbenifit = mysqli_query($connect,"DELETE FROM ing_benifit WHERE recipe_id=$recipe_id");
			//err();
			$selectlike = mysqli_query($connect,"DELETE FROM recipe_like WHERE recipe_id=$recipe_id");
			//err();
			$selectcomment = mysqli_query($connect,"DELETE FROM comment WHERE recipe_id=$recipe_id");
			//err();
			$selectstep = mysqli_query($connect,"DELETE FROM recipe_step WHERE recipe_id=$recipe_id");
			//err();
			$selectillness = mysqli_query($connect,"DELETE FROM illness_log WHERE recipe_id=$recipe_id");
			//err();
			$selectrending = mysqli_query($connect,"DELETE FROM trending_recipe WHERE recipe_id=$recipe_id");
		}
		$selectfollow = mysqli_query($connect,"DELETE FROM user_follow WHERE user_following_id=$user_id");
		//err();
		$selectfollower = mysqli_query($connect,"DELETE FROM user_follow WHERE user_follower_id=$user_id");
		//err();
		$selectuser = mysqli_query($connect,"DELETE FROM user_info WHERE user_id=$user_id");
		//err();
	}
	
	header("location:admin.php");	
}
else
{
	echo "d";
}