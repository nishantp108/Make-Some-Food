<?php
if(isset($_GET['feedback_id']))
{
	include("connect.php");
	$feedback_id = $_GET['feedback_id'];	
	$select = mysqli_query($connect,"DELETE FROM feedback WHERE feedback_id=$feedback_id");
	if(mysqli_error($connect))
	{
		echo "f";
	}
	else
	{
		header("location:admincont.php");
		return;
	}
}
else
{
	header("location:admincont.php");
	return;
}