<?php
include("validuser.php");
include("connect.php");
if(isset($_GET['recipe_id']))
{	
	$recipe_id=$_GET['recipe_id'];
	$selecttrendingrecipe = mysqli_query($connect,"SELECT recipe_id FROM trending_recipe WHERE recipe_id=$recipe_id");  
	if(mysqli_num_rows($selecttrendingrecipe)==0)
	{                                       
		$select= mysqli_query($connect,"INSERT INTO trending_recipe VALUES($recipe_id)");
		if(mysqli_error($connect))
		{
			echo "asd";
		}
	}
	else
	{
		$select= mysqli_query($connect,"DELETE FROM trending_recipe WHERE recipe_id=$recipe_id");
		if(mysqli_error($connect))
		{
			echo "asd";
		}
	}	
	header("location:postrecp.php");
		
	
}