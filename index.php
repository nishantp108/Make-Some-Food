<?php 
include("validuser.php");
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <title>MakeSomeFood | MakeSomeFood.com</title>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/Homepage.css">
     <style type="text/css">
          a{
               text-decoration: none;
          }
     </style>
</head>
<body>
     <!-- ==================== Navigation Bar Starts ==================== -->

     <header>
          <a href="index.php" class="logo">MakeSomeFood<span>.</span></a>
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
            ?><li><a href="profile.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Profile</a></li>
            <li><a href="logout.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Log out</a></li>
          
            </ul>
     </header>

     <!-- ==================== Navigation Bar Ends ==================== -->

     <!-- ==================== HomePage Starts ==================== -->

     <section class="banner" id="banner">
          <div class="content">
               <h2>Food <span>doesn't have <br> a religion.</span> It is a religion</h2>
          </div>
     </section>

     <!-- ==================== HomePage Ends ==================== -->
<?php
$selectveg = mysqli_query($connect,"SELECT * FROM  recipe_info WHERE recipe_type='Veg'");
$selectnonveg = mysqli_query($connect,"SELECT * FROM  recipe_info WHERE recipe_type='Non-Veg'");
$selectall = mysqli_query($connect,"SELECT * FROM  recipe_info ");
$selecttrendingrecipe = mysqli_query($connect,"SELECT recipe_info.* FROM trending_recipe INNER JOIN recipe_info ON recipe_info.recipe_id=trending_recipe.recipe_id");
$selectlatest = mysqli_query($connect,"SELECT * FROM recipe_info ORDER BY recipe_id DESC");

call($selecttrendingrecipe,"Trending");
call($selectlatest,"Latest Recipe");
call($selectall,"All Type");
call($selectveg,"Vegetarian");
call($selectnonveg,"Non Vegetarian");


function call($select,$type)
{
     echo '<section class="section2 clearfix">';
          echo '<div class="main">';
                    if(mysqli_num_rows($select) !=0)
                    {
                         echo '<h1>'.$type.' Recipes</h1>';
                         echo '<ul class="cards">';
                         $counter = 0;
                         while($selectarray = mysqli_fetch_assoc($select))
                         {
                              if($counter == 4)
                              {
                                   break;
                              }
                                   echo '<li class="cards_item">';
                                        echo '<div class="card">';
                                             if($selectarray['recipe_type'] == 'Veg')
                                             {
                                                  echo '<img src="./images/icons/veg.png" class="type" alt="">';
                                             }
                                             elseif($selectarray['recipe_type'] == 'Non-Veg')
                                             {
                                                  echo '<img src="./images/icons/nonveg.png" class="type" alt="">';
                                             }
                                             elseif($selectarray['recipe_type'] == 'Veg (With eggs)')
                                             {
                                                  echo '<img src="./images/icons/egg.png" class="type" alt="">';
                                             }
                                             echo '<div class="card_image">';
                                                  echo '<img src="./recipe_images_user_upload/'.$selectarray['recipe_id'].'/'.$selectarray['recipe_image'].'">';
                                             echo '</div>';
                                             echo '<div class="card_content">';
                                             $recipe_names =  $selectarray['recipe_name'];
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
                                                       if(isset($selectarray['meal_type']))
                                                       {
                                                            echo '<li>Meal Type :- '.$selectarray['meal_type'].'</li>';
                                                       }
                                                       if(isset($selectarray['recipe_serve']))
                                                       {
                                                            echo '<li>Serve :- '.$selectarray['recipe_serve'].' People</li>';
                                                       }
                                                       if(isset($selectarray['recipe_level']))
                                                       {
                                                            echo '<li>'.$selectarray['recipe_level'].'</li>';
                                                       }
                                                  echo '</ul>';
                                                  $recipe_id = $selectarray['recipe_id'];
                                                  echo '<a href="Recipeview.php?recipe_id='.$recipe_id.'"><button class="btn card_btn">View Recipe</button></a>';
                                             echo '</div>';
                                        echo '</div>';
                                   echo '</li>'; 
                                   $counter++;   
                              }
                              echo '</ul>';
                         }
          
          echo '</div>';
          echo '</section>';
}
     ?> 
     
     <script type="text/javascript">
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