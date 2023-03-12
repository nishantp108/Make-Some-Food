<?php
if(isset($_GET['recipe_id']) && isset($_GET['user_id']))
{
	$recipe_id = $_GET['recipe_id'];
	$user_id = $_GET['user_id'];
	include("connect.php");
	$select = mysqli_query($connect,"SELECT recipe_like.recipe_id FROM recipe_like INNER JOIN recipe_info ON recipe_info.recipe_id=recipe_like.recipe_id INNER JOIN user_info ON user_info.user_id=recipe_like.user_id WHERE recipe_info.recipe_id=$recipe_id AND user_info.user_id=$user_id");
	if(mysqli_num_rows($select) == 0)
	{
		echo mysqli_num_rows($select);
		$selectlike = mysqli_query($connect,"INSERT INTO recipe_like VALUES($recipe_id,$user_id)");
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
	else
	{
		$selectlike = mysqli_query($connect,"DELETE FROM recipe_like WHERE `recipe_id`=$recipe_id AND `user_id`=$user_id");
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

}