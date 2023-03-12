<?php
if($_GET['recipe_id'])
{
	include("connect.php");
	$recipe_id = $_GET['recipe_id'];
	$select = mysqli_query($connect,"DELETE FROM recipe_report WHERE recipe_id=$recipe_id");
	if(mysqli_error($connect))
	{
		echo "Error";
	}
	else
	{
		header("location:managerec.php");
	}
}