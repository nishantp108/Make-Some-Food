<?php 
include("validuser.php");
require("connect.php");
$user_id = $_SESSION['user_id'];?>
<!DOCTYPE html>
<html>
<head>
	<title>MakeSomeFood | Search</title>
	<link rel="stylesheet" type="text/css" href="css/advancesearchdisplaycss.css">

	<style type="text/css">
		body{
			background: #E2e2e2;
 			background-position: center;
    			opacity: 1.0;
			max-width:100%;
			max-height:100%;
			background-size: cover;
		}
		<style type="text/css">
          .section2  a
          {
            text-decoration: none;
          }
          
	</style>
</head>
<body>

     <!-- ==================== Navigation Bar Starts ==================== -->

     <header>
          <a href="#Home" class="logo">MakeSomeFood<span>.</span></a>
          <div class="menuToggle" onclick="toggleMenu();"></div>
          <ul class="navigation">
            <li><a href="index.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Home</a></li>
            <li><a href="advancesearch.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Search</a></li>
            <li><a href="Recipeupload.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Upload Recipe</a></li>
            <?php
              include("connect.php");
              $select = mysqli_query($connect,"SELECT admin_id FROM admin_info WHERE user_id=$user_id");
              if(mysqli_num_rows($select) == 0)
              {
                  echo '<li><a href="contactus.php?user_id='.$user_id.'"onclick="toggleMenu();">Contact Us</a></li>
            ';
              }
              else
              {
                  echo '<li><a href="admin.php?user_id='.$user_id.'"onclick="toggleMenu();">Admin Panel</a></li>
            ';
              }
            ?>
            <li><a href="profile.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Profile</a></li>
            <li><a href="logout.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Log out</a></li>
            
          </ul>
     </header>

     <!-- ==================== Navigation Bar Ends ==================== -->

<div class="allcontent">
	<div class="wrapper">
			<form method="POST" id="searchform" action="advancesearchdisplay.php"> 
				<table border="0px">
					<tr>
				  		<td style="width:310px"><input type="text" class="input" placeholder="Search" size="17" name="searchvalue" required>	
		      			</td>
		      			<td>	
		      			<button type="submit" name="searchrecipe" value="submit" form="searchform" style="padding: 0; border: none;"><img src="images/search.png" height="40px" width="25px" /></button>
		      			</td>
		      		</tr>
		      </table>
		     </form>
	</div>
	<?php
if(isset($_POST['searchrecipe']))
{
	require("connect.php");
	$search = $_POST['searchvalue'];
	$select6 = mysqli_query($connect,"SELECT recipe_info.* FROM recipe_info WHERE recipe_name LIKE'%$search%'");
	tabledisplay($select6);			
}
if(isset($_POST['advancesearchbtn']))
{
	require("connect.php");
	$select6 = "";
	$selected_row = find4();
	if(!empty($_POST['ing_name']) && !empty($_POST['illness_name']))
	{
		$ing_name = $_POST['ing_name'];
		$illness_name = $_POST['illness_name'];
		if(count($selected_row) == 3)
		{
			$recipe_level = $_POST['recipe_level'];
			$recipe_type = $_POST['recipe_type'];
			$recipe_cooktime_ = $selected_row['0'];
			$time_array = explode(":",$_POST['recipe_cooktime_']);
			$recipetimehour = $time_array[0];
			$recipetimemin = $time_array[1];
			//echo var_dump(!is_null($_POST['illness_name']))."nm".var_dump(!is_null($_POST['ing_name']));//.$_POST['illness_name'];
			$select6 = mysqli_query($connect,"SELECT  recipe_info.* FROM ing_info INNER JOIN ing_log ON ing_log.ing_id = ing_info.ing_id INNER JOIN recipe_info ON recipe_info.recipe_id = ing_log.recipe_id WHERE ing_info.ing_name = '$ing_name' 
				INTERSECT 
				SELECT  recipe_info.* FROM illness_info INNER JOIN illness_log ON illness_info.illness_id=illness_log.illness_id INNER JOIN recipe_info ON illness_log.recipe_id =recipe_info.recipe_id WHERE illness_info.illness_name= '$illness_name' 
				INTERSECT 
				SELECT recipe_info.* FROM recipe_info WHERE recipe_info.recipe_type='$recipe_type' AND recipe_info.recipe_cooktime_hour=$recipetimehour AND recipe_info.recipe_cooktime_min=$recipetimemin AND recipe_info.recipe_level='$recipe_level'");
			//comment code
			tabledisplay($select6);
		} 
		else if (count($selected_row) == 2) 
		{	if(!empty($_POST['recipe_cooktime_']))
			{	
				$selected_row1 = $_POST[$selected_row['1']];
				$selected_row1_name = $selected_row['1'];
				$time_array = explode(":",$_POST['recipe_cooktime_']);
				$recipetimehour = $time_array[0];
				$recipetimemin = $time_array[1];
		
			$select6 = mysqli_query($connect,"SELECT recipe_info.* FROM ing_info INNER JOIN ing_log ON ing_log.ing_id = ing_info.ing_id INNER JOIN recipe_info  ON recipe_info.recipe_id = ing_log.recipe_id WHERE ing_info.ing_name = '$ing_name'
			INTERSECT
			SELECT recipe_info.* FROM illness_info INNER JOIN illness_log ON illness_info.illness_id=illness_log.illness_id INNER JOIN recipe_info ON illness_log.recipe_id =recipe_info.recipe_id WHERE illness_info.illness_name= '$illness_name' 
			INTERSECT
			SELECT recipe_info.* FROM recipe_info WHERE `$selected_row1_name`='$selected_row1' AND recipe_info.recipe_cooktime_hour=$recipetimehour AND recipe_info.recipe_cooktime_min=$recipetimemin ");
			//echo"2";
			tabledisplay($select6);
			}
			else if(empty($_POST['recipe_cooktime_']))
			{
				$selected_row1_name =$selected_row['0'];
				$selected_row2_name =$selected_row['1'];
				$selected_row1 =$_POST[$selected_row['0']];
				$selected_row2 =$_POST[$selected_row['1']]; 
				
				$select6 = mysqli_query($connect,"SELECT recipe_info.* FROM ing_info INNER JOIN ing_log ON ing_log.ing_id = ing_info.ing_id INNER JOIN recipe_info  ON recipe_info.recipe_id = ing_log.recipe_id WHERE ing_info.ing_name = '$ing_name'
				INTERSECT
				SELECT recipe_info.* FROM illness_info INNER JOIN illness_log ON illness_info.illness_id=illness_log.illness_id INNER JOIN recipe_info ON illness_log.recipe_id =recipe_info.recipe_id WHERE illness_info.illness_name= '$illness_name' 
				INTERSECT
				SELECT recipe_info.* FROM recipe_info WHERE  `$selected_row1_name`='$selected_row1' AND `$selected_row2_name`='$selected_row2'");
			//echo"3";
			tabledisplay($select6);
			}
		}
		else if (count($selected_row) == 1) 
		{	if(!empty($_POST['recipe_cooktime_']))
			{
				$time_array = explode(":",$_POST['recipe_cooktime_']);
				$recipetimehour = $time_array[0];
				$recipetimemin = $time_array[1];
		

			$select6 = mysqli_query($connect,"SELECT recipe_info.* FROM ing_info INNER JOIN ing_log ON ing_log.ing_id = ing_info.ing_id INNER JOIN recipe_info  ON recipe_info.recipe_id = ing_log.recipe_id WHERE ing_info.ing_name = '$ing_name'
			INTERSECT
			SELECT recipe_info.* FROM illness_info INNER JOIN illness_log ON illness_info.illness_id=illness_log.illness_id INNER JOIN recipe_info ON illness_log.recipe_id =recipe_info.recipe_id WHERE illness_info.illness_name= '$illness_name' 
			INTERSECT
			SELECT recipe_info.* FROM recipe_info WHERE recipe_info.recipe_cooktime_hour=$recipetimehour AND recipe_info.recipe_cooktime_min=$recipetimemin ");
			//echo"4";
			tabledisplay($select6);
			}
			else if(empty($_POST['recipe_cooktime_']))
			{
				$selected_row1_name =$selected_row['0'];
				$selected_row1 =$_POST[$selected_row1_name];
				
				$select6 = mysqli_query($connect,"SELECT recipe_info.* FROM ing_info INNER JOIN ing_log ON ing_log.ing_id = ing_info.ing_id INNER JOIN recipe_info  ON recipe_info.recipe_id = ing_log.recipe_id WHERE ing_info.ing_name = '$ing_name'
				INTERSECT
				SELECT recipe_info.* FROM illness_info INNER JOIN illness_log ON illness_info.illness_id=illness_log.illness_id INNER JOIN recipe_info ON illness_log.recipe_id =recipe_info.recipe_id WHERE illness_info.illness_name= '$illness_name' 
				INTERSECT
				SELECT recipe_info.* FROM recipe_info WHERE `$selected_row1_name`='$selected_row1'");
				//echo"5";
			tabledisplay($select6);
			}
		}
		else if (count($selected_row) == 0) 
		{	
			$select6 = mysqli_query($connect,"SELECT recipe_info.* FROM ing_info INNER JOIN ing_log ON ing_log.ing_id = ing_info.ing_id INNER JOIN recipe_info  ON recipe_info.recipe_id = ing_log.recipe_id WHERE ing_info.ing_name = '$ing_name'
			INTERSECT
			SELECT recipe_info.* FROM illness_info INNER JOIN illness_log ON illness_info.illness_id=illness_log.illness_id INNER JOIN recipe_info ON illness_log.recipe_id =recipe_info.recipe_id WHERE illness_info.illness_name= '$illness_name'");
			//echo"5.";
			tabledisplay($select6);
		}
	}//2
	else if(!empty($_POST['ing_name']) && empty($_POST['illness_name']))
	{
		$selected_row = find4();
		$ing_name = $_POST['ing_name'];
		if(count($selected_row) == 3)
		{
			$recipe_level = $_POST['recipe_level'];
			$recipe_type = $_POST['recipe_type'];
			$recipe_cooktime_ = $selected_row['0'];
			
			$time_array = explode(":",$_POST['recipe_cooktime_']);
			$recipetimehour = $time_array[0];
			$recipetimemin = $time_array[1];
			
			$select6 = mysqli_query($connect,"SELECT recipe_info.* FROM ing_info INNER JOIN ing_log ON ing_log.ing_id = ing_info.ing_id INNER JOIN recipe_info  ON recipe_info.recipe_id = ing_log.recipe_id WHERE ing_info.ing_name = '$ing_name'
			INTERSECT
			SELECT recipe_info.* FROM recipe_info WHERE  recipe_info.recipe_type='$recipe_type' AND recipe_info.recipe_cooktime_hour=$recipetimehour AND recipe_info.recipe_cooktime_min=$recipetimemin AND recipe_info.recipe_level='$recipe_level'");
			//comment code
			//echo"6";
			tabledisplay($select6);
		}
		else if (count($selected_row) == 2) 
		{	
			if(!empty($_POST['recipe_cooktime_']))
			{
				$selected_row1 = $_POST[$selected_row['1']];
				$selected_row1_name = $selected_row['1'];
				$time_array = explode(":",$_POST['recipe_cooktime_']);
				$recipetimehour = $time_array[0];
				$recipetimemin = $time_array[1];
		

			$select6 = mysqli_query($connect,"SELECT recipe_info.* FROM ing_info INNER JOIN ing_log ON ing_log.ing_id = ing_info.ing_id INNER JOIN recipe_info  ON recipe_info.recipe_id = ing_log.recipe_id WHERE ing_info.ing_name = '$ing_name'
			INTERSECT
			SELECT recipe_info.* FROM recipe_info WHERE  `$selected_row1_name`='$selected_row1' AND recipe_info.recipe_cooktime_hour=$recipetimehour AND recipe_info.recipe_cooktime_min=$recipetimemin ");
			//echo"7";
			tabledisplay($select6);
			}
			else if(empty($_POST['recipe_cooktime_']))
			{
				//echo "c";
				$selected_row1_name =$selected_row['0'];
				$selected_row2_name =$selected_row['1'];
				$selected_row1 =$_POST[$selected_row['0']];
				$selected_row2 =$_POST[$selected_row['1']]; 
				
				$select6 = mysqli_query($connect,"SELECT recipe_info.* FROM ing_info INNER JOIN ing_log ON ing_log.ing_id = ing_info.ing_id INNER JOIN recipe_info  ON recipe_info.recipe_id = ing_log.recipe_id WHERE ing_info.ing_name = '$ing_name'
				INTERSECT
				SELECT recipe_info.* FROM recipe_info WHERE `$selected_row1_name`='$selected_row1'AND `$selected_row2_name`='$selected_row2'");
				//echo"8";
				tabledisplay($select6);
			}
		}
		else if (count($selected_row) == 1) 
		{	
			if(!empty($_POST['recipe_cooktime_']))
			{
				$time_array = explode(":",$_POST['recipe_cooktime_']);
				$recipetimehour = $time_array[0];
				$recipetimemin = $time_array[1];
		

			$select6 = mysqli_query($connect,"SELECT recipe_info.* FROM ing_info INNER JOIN ing_log ON ing_log.ing_id = ing_info.ing_id INNER JOIN recipe_info  ON recipe_info.recipe_id = ing_log.recipe_id WHERE ing_info.ing_name = '$ing_name'
			INTERSECT
			SELECT recipe_info.* FROM recipe_info WHERE recipe_info.recipe_cooktime_hour=$recipetimehour AND recipe_info.recipe_cooktime_min=$recipetimemin ");
			//echo"9";
			tabledisplay($select6);
			}
			else if(empty($_POST['recipe_cooktime_']))
			{
				$selected_row1_name =$selected_row['0'];
				$selected_row1 =$_POST[$selected_row1_name];
			//echo $selected_row1.$ing_name;
				$select6 = mysqli_query($connect,"SELECT recipe_info.* FROM ing_info INNER JOIN ing_log ON ing_log.ing_id = ing_info.ing_id INNER JOIN recipe_info  ON recipe_info.recipe_id = ing_log.recipe_id WHERE ing_info.ing_name ='potato'
    				INTERSECT
    				SELECT recipe_info.* FROM recipe_info WHERE `recipe_type`='veg'");

				//echo"10";
				echo mysqli_num_rows($select6);
			tabledisplay($select6);
			}
		}
		else if (count($selected_row) == 0) 
		{	
			$select6 = mysqli_query($connect,"SELECT recipe_info.* FROM ing_info INNER JOIN ing_log ON ing_log.ing_id = ing_info.ing_id INNER JOIN recipe_info  ON recipe_info.recipe_id = ing_log.recipe_id WHERE ing_info.ing_name = '$ing_name'");
		tabledisplay($select6);
		}
	}//3
	else if(!empty($_POST['illness_name']) && empty($_POST['ing_name']))
	{	
		$selected_row = find4();
		$illness_name = $_POST['illness_name'];
		
		if(count($selected_row) == 3)
		{
			$recipe_level = $_POST['recipe_level'];
			$recipe_type = $_POST['recipe_type'];
			$recipe_cooktime_ = $selected_row['0'];
			
			$time_array = explode(":",$_POST['recipe_cooktime_']);
			$recipetimehour = $time_array[0];
			$recipetimemin = $time_array[1];
			
			$select6 = mysqli_query($connect,"
			SELECT recipe_info.* FROM illness_info INNER JOIN illness_log ON illness_info.illness_id=illness_log.illness_id INNER JOIN recipe_info ON illness_log.recipe_id =recipe_info.recipe_id WHERE illness_info.illness_name= '$illness_name' 
			INTERSECT
			SELECT recipe_info.* FROM recipe_info WHERE  recipe_info.recipe_type='$recipe_type' AND recipe_info.recipe_cooktime_hour=$recipetimehour AND recipe_info.recipe_cooktime_min=$recipetimemin AND recipe_info.recipe_level='$recipe_level'");
			//comment code
			//echo"11";
			tabledisplay($select6);
		}
		else if (count($selected_row) == 2) 
		{	if(!empty($_POST['recipe_cooktime_']))
			{
				$selected_row1 = $_POST[$selected_row['1']];
				$selected_row1_name = $selected_row['1'];
				$time_array = explode(":",$_POST['recipe_cooktime_']);
				$recipetimehour = $time_array[0];
				$recipetimemin = $time_array[1];
		

			$select6 = mysqli_query($connect,"
			SELECT recipe_info.* FROM illness_info INNER JOIN illness_log ON illness_info.illness_id=illness_log.illness_id INNER JOIN recipe_info ON illness_log.recipe_id =recipe_info.recipe_id WHERE illness_info.illness_name= '$illness_name' 
			INTERSECT
			SELECT  recipe_info.* FROM recipe_info WHERE `$selected_row1_name`='$selected_row1' AND recipe_info.recipe_cooktime_hour=$recipetimehour AND recipe_info.recipe_cooktime_min=$recipetimemin ");
			//echo"12";
			tabledisplay($select6);
			}
			else if(empty($_POST['recipe_cooktime_']))
			{
				$selected_row1_name =$selected_row['0'];
				$selected_row2_name =$selected_row['1'];
				$selected_row1 =$_POST[$selected_row['0']];
				$selected_row2 =$_POST[$selected_row['1']]; 
				
				$select6 = mysqli_query($connect,"
				SELECT recipe_info.* FROM illness_info INNER JOIN illness_log ON illness_info.illness_id=illness_log.illness_id INNER JOIN recipe_info ON illness_log.recipe_id =recipe_info.recipe_id WHERE illness_info.illness_name= '$illness_name' 
				INTERSECT
				SELECT recipe_info.* FROM recipe_info WHERE  `$selected_row1_name`='$selected_row1'AND `$selected_row2_name`='$selected_row2'");
				//echo"13";
			tabledisplay($select6);
			}
		}
		else if (count($selected_row) == 1) 
		{	if(!empty($_POST['recipe_cooktime_']))
			{
				$time_array = explode(":",$_POST['recipe_cooktime_']);
				$recipetimehour = $time_array[0];
				$recipetimemin = $time_array[1];
		

			$select6 = mysqli_query($connect,"
			SELECT recipe_info.* FROM illness_info INNER JOIN illness_log ON illness_info.illness_id=illness_log.illness_id INNER JOIN recipe_info ON illness_log.recipe_id =recipe_info.recipe_id WHERE illness_info.illness_name= '$illness_name' 
			INTERSECT
			SELECT recipe_info.* FROM recipe_info WHERE recipe_info.recipe_cooktime_hour=$recipetimehour AND recipe_info.recipe_cooktime_min=$recipetimemin ");
			//echo"14";
			tabledisplay($select6);
			}
			else if(empty($_POST['recipe_cooktime_']))
			{
				$selected_row1_name =$selected_row['0'];
				$selected_row1 =$_POST[$selected_row1_name];
				
				$select6 = mysqli_query($connect,"
				SELECT recipe_info.* FROM illness_info INNER JOIN illness_log ON illness_info.illness_id=illness_log.illness_id INNER JOIN recipe_info ON illness_log.recipe_id =recipe_info.recipe_id WHERE illness_info.illness_name= '$illness_name' 
				INTERSECT
				SELECT recipe_info.* FROM recipe_info WHERE `$selected_row1_name`='$selected_row1'");
			tabledisplay($select6);
			}
		}
		else if (count($selected_row) == 0) 
		{	
			$select6 = mysqli_query($connect,"
			SELECT recipe_info.* FROM illness_info INNER JOIN illness_log ON illness_info.illness_id=illness_log.illness_id INNER JOIN recipe_info ON illness_log.recipe_id =recipe_info.recipe_id WHERE illness_info.illness_name= '$illness_name'");
		//	echo"15";
			tabledisplay($select6);
		}
	}//4
	elseif(empty($_POST['advancesearchcontent'])&&empty($_POST['ing_name']) && empty($_POST['illness_name']))
	{
		$selected_row = find4();
		
		if(count($selected_row) == 3)
		{
			$recipe_level = $_POST['recipe_level'];
			$recipe_type = $_POST['recipe_type'];
			$recipe_cooktime_ = $selected_row['0'];
			
			$time_array = explode(":",$_POST['recipe_cooktime_']);
			$recipetimehour = $time_array[0];
			$recipetimemin = $time_array[1];
			
			$select6 = mysqli_query($connect,"
			SELECT recipe_info.* FROM recipe_info WHERE  recipe_info.recipe_type='$recipe_type' AND recipe_info.recipe_cooktime_hour=$recipetimehour AND recipe_info.recipe_cooktime_min=$recipetimemin AND recipe_info.recipe_level='$recipe_level'");
			//comment code
			//echo"16";
			tabledisplay($select6);
		}
		else if (count($selected_row) == 2) 
		{	if(!empty($_POST['recipe_cooktime_']))
			{
				$selected_row1 = $_POST[$selected_row['1']];
				$selected_row1_name = $selected_row['1'];
				$time_array = explode(":",$_POST['recipe_cooktime_']);
				$recipetimehour = $time_array[0];
				$recipetimemin = $time_array[1];
		

			$select6 = mysqli_query($connect,"
			SELECT recipe_info.* FROM recipe_info WHERE `$selected_row1_name`='$selected_row1' AND recipe_info.recipe_cooktime_hour=$recipetimehour AND recipe_info.recipe_cooktime_min=$recipetimemin ");
			//echo"17";
			tabledisplay($select6);
			}
			else if(empty($_POST['recipe_cooktime_']))
			{
				$selected_row1_name =$selected_row['0'];
				$selected_row2_name =$selected_row['1'];
				$selected_row1 =$_POST[$selected_row['0']];
				$selected_row2 =$_POST[$selected_row['1']]; 
				
				$select6 = mysqli_query($connect,"
				SELECT recipe_info.* FROM recipe_info WHERE `$selected_row1_name`='$selected_row1'AND `$selected_row2_name`='$selected_row2'");
				echo"18";
				tabledisplay($select6);
			}
		}
		else if (count($selected_row) == 1) 
		{	if(!empty($_POST['recipe_cooktime_']))
			{
				$time_array = explode(":",$_POST['recipe_cooktime_']);
				$recipetimehour = $time_array[0];
				$recipetimemin = $time_array[1];
		

			$select6 = mysqli_query($connect,"
			SELECT recipe_info.* FROM recipe_info WHERE recipe_info.recipe_cooktime_hour=$recipetimehour AND recipe_info.recipe_cooktime_min=$recipetimemin ");
			//echo"19";
			tabledisplay($select6);
			
			}
			else if(empty($_POST['recipe_cooktime_']))
			{
				$selected_row1_name =$selected_row['0'];
				$selected_row1 =$_POST[$selected_row1_name];

				$select6 = mysqli_query($connect,"
				SELECT recipe_info.*  FROM recipe_info WHERE  `$selected_row1_name`='$selected_row1'");
				//echo"20";
				tabledisplay($select6);
			}
		}
		else if (count($selected_row) == 0) 
		{	
			$select6 = mysqli_query($connect,"
			SELECT recipe_info.* FROM illness_info INNER JOIN illness_log ON illness_info.illness_id=illness_log.illness_id INNER JOIN recipe_info ON illness_log.recipe_id =recipe_info.recipe_id WHERE illness_info.illness_name= '$illness_name'");
			//echo"21";
			tabledisplay($select6);
		}
	}
	elseif(!empty($_POST['advancesearchcontent']) )
	{
		$search = $_POST['advancesearchcontent'];
		$select6 = mysqli_query($connect,"SELECT recipe_info.* FROM recipe_info WHERE recipe_name LIKE'%$search%'");
		//echo"22";
		tabledisplay($select6);
			
	}
}			
function find4()
{
	$row_name = array("recipe_cooktime_","recipe_type","recipe_level");
	$selected_row = array();

	for($i =0;$i<3;$i++)
	{   
		$row_names =$row_name[$i];
		if(!empty($_POST[$row_names]))
		{
			$row =$_POST[$row_names];
			array_push($selected_row,$row_name[$i]);
		}
	}
	//print_r($selected_row);
	return $selected_row;
}
function tabledisplay($select)
{
	if(mysqli_num_rows($select) != 0 )
    {
      echo '<section class="section2 clearfix">';
          echo '<div class="main">';
             // echo '<h1>'..' </h1>';
              echo '<ul class="cards">';
              while($selectallarray = mysqli_fetch_assoc($select))
              {
                echo '<li class="cards_item">';
                  echo '<div class="card">';
                    echo '<img src="./images/icons/veg.png" class="type">';
                    echo '<div class="card_image">';
                      echo '<img src="./recipe_images_user_upload/'.$selectallarray['recipe_id'].'/'.$selectallarray['recipe_image'].'"alt="Recipe Image">';
                    echo '</div>';
                    echo '<div class="card_content">';
                      $recipe_names =  $selectallarray['recipe_name'];
                       if(strlen($recipe_names) > 15)
                       {
                            $recipe_name = substr($recipe_names,0,15);
                            echo '<span class="card_title">'. $recipe_name.'..</span><br><br>';
                       }
                       else
                       {
                            echo '<span class="card_title">'.$recipe_names.'</span><br><br>';
                       }
                      echo '<ul>';
                      if($selectallarray['meal_type'] !='')
                      {
                        echo '<li>Cuisine :- '.$selectallarray['meal_type'].'</li>';
                      }
                      $recipe_id = $selectallarray['recipe_id'];
                      echo '<a href="Recipeview.php?recipe_id='.$recipe_id.'"><button class="btn card_btn">View Recipe</button></a>';
                    echo '</div>';
                  echo '</div>';
                echo '</li>';
          }
      echo '</section>';
    echo '</div>';
  echo '</div>  ';
}
}			
?>
<script>
	window.addEventListener('scroll',function(){
          const header = document.querySelector('header');
          header.classList.toggle('sticky',window.scrollY > 0);
     });
     function toggleMenu(){
          const menuToggle = document.querySelector('.menuToggle');
          const navigation = document.querySelector('.navigation');
          menuToggle.classList.toggle('active');
          navigation.classList.toggle('active');
     }
</script>
</body>
</html>