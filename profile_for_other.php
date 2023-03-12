<?php include("validuser.php");?>

<html>
    <head>
        <title>MakeSomeFood | User Profile</title>
        <link rel="stylesheet" href="css/profile1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <style type="text/css">
          .section2  a
          {
            text-decoration: none;
          }
          .section1  a
          {
            text-decoration: none;
          }
          .section1 a:hover
          {
            color:grey;
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
            ?><li><a href="profile.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Profile</a></li>
            <li><a href="logout.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Log out</a></li>
          
           </ul>
      </header>

      <!-- ==================== Navigation Bar Ends ==================== -->
<?php
$user_id = $_SESSION['user_id'];
if(isset($_GET['user_id']) AND $_GET['user_id']==$user_id)
{
    include("connect.php");
    $selectinfo = mysqli_query($connect,"SELECT * FROM user_info WHERE user_id=$user_id");
    echo '<div class="container">';
    echo '<div class="innerwrap">';
      echo '<section class="section1 clearfix">';
        echo '<div>';
          echo '<div class="row grid clearfix">';
            echo '<div class="col2 first">';

            if(mysqli_num_rows($selectinfo) != 0)
            {
              while($selectinfoarray = mysqli_fetch_assoc($selectinfo))
              {
                echo '<a href="editprofile.php?user_id='.$user_id.'">';
              echo '<div class="img">';
                echo '<img src="./user_profile_image/'.$user_id.'/'.$selectinfoarray['user_profile_pic'].'" alt="Profile Pic">';
              echo '</div>';
              echo '<h1>'.$selectinfoarray['user_first_name'].' '.$selectinfoarray['user_last_name'].'</h1>';
             echo '</div></a>';
             $selectstatmentfollow = mysqli_query($connect,"SELECT $user_id FROM user_follow WHERE user_following_id=$user_id AND user_follower_id=$recipe_made_user_id");
             if(mysqli_num_rows($selectstatmentfollow) == 0)
              {
                echo '<a href="follow_page.php?user_id='.$user_id.'& recipe_made_user_id='.$recipe_made_user_id.'"><button type="button" class="btn1"> <span> Follow </span> </button></a>';
              }
              else
              {
                  echo '<a href="follow_page.php?user_id='.$user_id.'& recipe_made_user_id='.$recipe_made_user_id.'"><button type="button" class="btn1"> <span> Following </span> </button></a>';
              }
             }
            }
            $selectfollowinginfo = mysqli_query($connect,"SELECT user_following_id FROM user_follow WHERE user_following_id=$user_id");

            echo '<div class="col2 last">';
              echo '<div class="grid clearfix">';
              if(mysqli_num_rows($selectfollowinginfo) !=0)
              {
                echo '<div class="col3 first">';
                  echo '<h1>'.mysqli_num_rows($selectfollowinginfo).'</h1>';
                  echo '<span style="font-size:20px; margin-top:5px ">Following</span>';
                echo '</div>';
              }
              else
              {
                 echo '<div class="col3 first">';
                  echo '<h1>'.mysqli_num_rows($selectfollowinginfo).'</h1>';
                  echo '<span style="font-size:20px; margin-top:5px ">Following</span>';
                echo '</div>';
              }
              $selectfollowerinfo = mysqli_query($connect,"SELECT user_follower_id FROM user_follow WHERE user_follower_id=$user_id");
              if(mysqli_num_rows($selectfollowerinfo) != 0)
              {
                echo '<div class="col3"><h1>'.mysqli_num_rows($selectfollowerinfo).'</h1>';
                echo '<span  style="font-size:20px; margin-top:5px ">Followers</span></div>';
              }
              else
              {
                echo '<div class="col3"><h1>'.mysqli_num_rows($selectfollowerinfo).'</h1>';
                echo '<span  style="font-size:20px; margin-top:5px ">Followers</span></div>';
              }
               $selectlike = mysqli_query($connect,"SELECT recipe_like.user_id FROM recipe_like INNER JOIN recipe_info ON recipe_info.recipe_id = recipe_like.recipe_id WHERE recipe_info.user_id=$recipe_made_user_id");
                if(mysqli_num_rows($selectlike) != 0)
                {
                     echo '<div class="col3 last"><h1>'.mysqli_num_rows($selectlike).'</h1>';
                      echo '<span  style="font-size:20px; margin-top:5px ">Like</span></div>';
                }
                else
                {
                     echo '<div class="col3 last"><h1>'.mysqli_num_rows($selectlike).'</h1>';
                      echo '<span  style="font-size:20px; margin-top:5px ">Like</span></div>';
                }
              echo '</div>';
            echo '</div>';
          echo '</div>';
          echo '<div class="row clearfix">';
            echo '<ul class="row2tab clearfix">';
            echo '</ul>';
          echo '</div>';
        echo '</div>';
        echo '<span class="smalltri">';
          
        echo '<i class="fa fa-star"></i>';
        echo '</span>';
      echo '</section>';

    $selectrecipe = mysqli_query($connect,"SELECT * FROM recipe_info WHERE user_id=$user_id");
    if(mysqli_num_rows($selectrecipe) != 0 )
    {
      echo '<section class="section2 clearfix">';
          echo '<div class="main">';
             // echo '<h1>'..' </h1>';
              echo '<ul class="cards">';
              while($selectallarray = mysqli_fetch_assoc($selectrecipe))
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
  $(".btn1").click(function() {
      $(".btn1 span").html($(".btn1 span").html() == 'Follow' ? 'Following' : 'Follow');
  });
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