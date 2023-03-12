<?php
include("connect.php");

if(isset($_GET['recipe_id']))
{
	function err()
	{
		if(mysqli_error($connect))
		{
			echo "Error";
		}
	}
	$recipe_id = $_GET['recipe_id'];
	$selectreport = mysqli_query($connect,"DELETE FROM recipe_report WHERE recipe_id=$recipe_id");
	err();
	$selectrecipe = mysqli_query($connect,"DELETE FROM recipe_info WHERE recipe_id=$recipe_id");
	err();
	$selectlog = mysqli_query($connect,"DELETE FROM ing_log WHERE recipe_id=$recipe_id");
	err();
	$selectbenifit = mysqli_query($connect,"DELETE FROM ing_benifit WHERE recipe_id=$recipe_id");
	err();
	$selectlike = mysqli_query($connect,"DELETE FROM recipe_like WHERE recipe_id=$recipe_id");
	err();
	$selectcomment = mysqli_query($connect,"DELETE FROM comment WHERE recipe_id=$recipe_id");
	err();
	$selectstep = mysqli_query($connect,"DELETE FROM recipe_step WHERE recipe_id=$recipe_id");
	err();
	$selectillness = mysqli_query($connect,"DELETE FROM illness_log WHERE recipe_id=$recipe_id");
	err();
	$selectrending = mysqli_query($connect,"DELETE FROM trending_recipe WHERE recipe_id=$recipe_id");
	err();
	
	header("location:managerec.php");
	
	
}