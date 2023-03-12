<?php
include("validuser.php");
if (isset($_POST['submit'])) 
{
    include("connect.php");
	$user_id = $_SESSION['user_id'];
	//echo $user_id;
	//$user_id = 3;
	$recipe_name = mysqli_real_escape_string($connect,$_POST['recipe_name']);

	$about_recipe = '';
	$recipe_type = '';
	$recipe_cuisine = '';
	$recipe_cooktime_hour;
	$recipe_cooktime_min;
	$recipe_serve = '';
	$recipe_level = '';
	$meal_type = '';
	if(isset($_POST['about_recipe'])){
		$about_recipe = mysqli_real_escape_string($connect,$_POST['about_recipe']);
	}
	if(isset($_POST['recipe_type'])){
		$recipe_type = mysqli_real_escape_string($connect,$_POST['recipe_type']);
	}
	if(isset($_POST['recipe_cuisine'])){
		$recipe_cuisine = mysqli_real_escape_string($connect,$_POST['recipe_cuisine']);
	}
	$recipeindexarrayvalue = "";
	if(isset($_POST['recipe_cooktime_hour'])){
		if($_POST['recipe_cooktime_min'] !=0)
		{
		$recipe_cooktime_hour = $_POST['recipe_cooktime_min'];
		}
		else
		{
			$recipe_cooktime_hour = 0;	
		}
	}

	if(isset($_POST['recipe_cooktime_min'])){
		if($_POST['recipe_cooktime_min'] !=0)
		{
		$recipe_cooktime_min = $_POST['recipe_cooktime_min'];
		}
		else
		{
			$recipe_cooktime_min = 0;	
		}
	}

	if(isset($_POST['recipe_serve'])){
		$recipe_serve = $_POST['recipe_serve'];
	}
	if(isset($_POST['recipe_level'])){
		$recipe_level = $_POST['recipe_level'];
	}
	if(isset($_POST['meal_type'])){
		$meal_type = $_POST['meal_type'];
	}
	$recipestep = $_POST['recipestep'];
	$recipeing = $_POST['recipeing'];
	$recipeillness = $_POST['recipe_illness'];
	//$recipemainpic =$_FILES['recipe_image']['name'];
	$recipemainpic =$_FILES['recipe_image']['name'];
	//$recipemainpic =$_FILES['recipe_image']['name'];
		//echo $recipemainpic;
$insert = mysqli_query($connect,"INSERT INTO `recipe_info`(`recipe_name`,`user_id`,`recipe_image`,`about_recipe`,`recipe_type`,`recipe_cuisine`,`recipe_cooktime_hour`,`recipe_cooktime_min`,`recipe_serve`,`recipe_level`,`meal_type`) VALUES ('$recipe_name','$user_id','$recipemainpic','$about_recipe','$recipe_type','$recipe_cuisine','$recipe_cooktime_hour','$recipe_cooktime_min','$recipe_serve','$recipe_level','$meal_type')");
	
	if (mysqli_connect_error()) 
	{
	    header("location:recipeupload.php");
		return;
	}
	
	//find recipe_id
	$findrecipeid = mysqli_query($connect,"SELECT `recipe_id` FROM `recipe_info` where  user_id ='" . $user_id ."' && recipe_name='".$recipe_name."' ORDER BY `recipe_id` DESC");
	if (mysqli_error($connect)) 
	{
	//	header("location:recipeupload.php");
	//	return;
	}
	else
	{
		if(isset($recipeing))
		{	
			if(mysqli_num_rows($findrecipeid) != 0)//check row of recipe_info to find recipe_id
			{
			   	$findrecipeidarray = mysqli_fetch_array($findrecipeid);
				$recipe_id = $findrecipeidarray['recipe_id'];
				foreach ($recipeing as $key => $value) //iterate ing. in foreach 
				{
					$recipeingval = mysqli_real_escape_string($connect,$key[$value]);//store it on variable
					if(isset($recipeingval) && $recipeingval != '')
					{
						$xyz = mysqli_query($connect,"SELECT `ing_id` FROM `ing_info` WHERE ing_name='".$recipeingval."'");
					 	$x = mysqli_fetch_assoc($xyz);
					 	if($x['ing_id'] == null)//check if ing. is already in database(ing_info) then ...
					 	{
					 		//if yes then add it and check it
					 		$adding = mysqli_query($connect,"INSERT INTO `ing_info`(`ing_name`) VALUES('$recipeingval')");
					 		if(mysqli_connect_error())
					 		{
					 			header("location:recipeupload.php");
								return;
								}
						}
						//find the ing_id of particular ing and store in database(ing_info)
						$ing_id_array = mysqli_query($connect,"SELECT `ing_id` FROM `ing_info` WHERE ing_name='".$recipeing[$key]."'");
						$ing_id  = mysqli_fetch_assoc($ing_id_array);
						$recipe_ing_log = mysqli_query($connect,"INSERT INTO `ing_log`(`recipe_id`,`ing_id`) VALUES('$recipe_id','".$ing_id['ing_id']."')");	
					}
				}
			}
		}
		else
		{       	//header("location:recipeupload.php");
		        	//return;
		}
	}

	//step code
	if(mysqli_num_rows($findrecipeid) != 0)//check row of recipe_info to find recipe_id
	{
		foreach ($recipestep as $key1 => $value) //iterate step. in foreach 
		{
			$recipestepval = mysqli_real_escape_string($connect,$key1[$value]);//store it on variable
			if(isset($key1[$value]))
			{
				$recipe_ing_log = mysqli_query($connect,"INSERT INTO `recipe_step`(`recipe_id`,`recipe_step`) VALUES('$recipe_id','".$recipestepval."')");
			}
		}
	}
	foreach ($recipeillness as $key => $value) //iterate ing. in foreach 
			{
				$recipeillnessval = mysqli_real_escape_string($connect,$recipeillness[$key]);//store it on variable
				$xyz = mysqli_query($connect,"SELECT `illness_id` FROM `illness_info` WHERE illness_name='".$recipeillness[$key]."'");
			 	$x = mysqli_fetch_assoc($xyz);

			 	if($x['illness_id'] == null)//check if ing. is already in database(ing_info) then ...
			 	{
			 		//if yes then add it and check it
			 		$adding = mysqli_query($connect,"INSERT INTO `illness_info`(`illness_name`) VALUES('$recipeillnessval')");
			 		if(mysqli_connect_error())
			 		{
			 			header("location:recipeupload.php");
						return;
						}
				}
				//find the ing_id of particular ing and store in database(ing_info)
				$illness_id_array = mysqli_query($connect,"SELECT `illness_id` FROM `illness_info` WHERE illness_name='".$recipeillness[$key]."'");
				$illness_id  = mysqli_fetch_assoc($illness_id_array);
				$recipe_ing_log = mysqli_query($connect,"INSERT INTO `illness_log`(`recipe_id`,`illness_id`) VALUES('$recipe_id','".$illness_id['illness_id']."')");	
			}
	//upload image\
			//echo $recipe_cooktime_min; 
	mkdir("recipe_images_user_upload/$recipe_id");
	move_uploaded_file($_FILES['recipe_image']['tmp_name'],"recipe_images_user_upload/$recipe_id/".$_FILES['recipe_image']['name']);
	header("location:Recipeview.php?recipe_id=".$recipe_id);	
}
else
{
    echo "s";
}
?>