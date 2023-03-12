<?php include("validuser.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
     <title>MakeSomeFood | Recipe Viewer</title>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="css/recipeview.css">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<!-- $as = date("Y-m-d H:i:sa");
 -->
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
            <div style="background-image: url();">
          
          </ul>
     </header>

     <!-- ==================== Navigation Bar Ends ==================== -->
<?php
function mysqli_raisederror()
{
     if(mysqli_connect_error())
     {
          echo "0000";
     }
     else
     {
          //echo "aaaaa ";
     }
}
if(isset($_GET['recipe_id']))
{
     include("connect.php");
     $recipe_id=$_GET['recipe_id'];
     $user_id =$_SESSION['user_id'];
     
     $selectstatment = mysqli_query($connect,"SELECT recipe_info.*,user_info.user_first_name,user_info.user_last_name,user_info.user_profile_pic FROM recipe_info INNER JOIN user_info ON recipe_info.user_id=user_info.user_id WHERE recipe_info.recipe_id=$recipe_id");
     mysqli_raisederror();   
     $selectstatment1 = mysqli_query($connect,"SELECT recipe_info.*,user_info.user_first_name,user_info.user_last_name,user_info.user_profile_pic FROM recipe_info INNER JOIN user_info ON recipe_info.user_id=user_info.user_id WHERE recipe_info.recipe_id=$recipe_id");
     mysqli_raisederror();   
     
     //ing
     $selectstatmenting = mysqli_query($connect,"SELECT DISTINCT ing_info.ing_name FROM recipe_info INNER JOIN ing_log ON recipe_info.recipe_id=ing_log.recipe_id INNER JOIN ing_info ON ing_log.ing_id=ing_info.ing_id WHERE recipe_info.recipe_id=$recipe_id");

     mysqli_raisederror(); 
     $selectstatmentillness = mysqli_query($connect,"SELECT DISTINCT illness_info.illness_name FROM recipe_info INNER JOIN illness_log ON recipe_info.recipe_id=illness_log.recipe_id INNER JOIN illness_info ON illness_log.ing_id=illness_info.ing_id WHERE recipe_info.recipe_id=$recipe_id");

     mysqli_raisederror(); 

     //step
     $selectstatmentstep = mysqli_query($connect,"SELECT DISTINCT recipe_step.recipe_step FROM recipe_info INNER JOIN recipe_step ON recipe_info.recipe_id=recipe_step.recipe_id WHERE recipe_info.recipe_id=$recipe_id");
     mysqli_raisederror();

     $selectstatmentcomments = mysqli_query($connect,"SELECT DISTINCT comment.comment,user_info.user_id,user_info.user_profile_pic,user_info.user_id,user_info.user_first_name,user_info.user_last_name FROM recipe_info INNER JOIN comment ON recipe_info.recipe_id=comment.recipe_id INNER JOIN user_info ON comment.user_id=user_info.user_id WHERE recipe_info.recipe_id=$recipe_id");
     mysqli_raisederror();

     $selectstatmentfollow = mysqli_query($connect,"SELECT user_following_id FROM user_follow INNER JOIN recipe_info ON recipe_info.user_id = user_follow.user_follower_id INNER JOIN user_info ON user_info.user_id = user_follow.user_following_id WHERE recipe_info.recipe_id=$recipe_id AND user_info.user_id=$user_id");

     $selectstatmentlike = mysqli_query($connect,"SELECT recipe_like.recipe_id,count(recipe_like.recipe_id) FROM recipe_like INNER JOIN recipe_info ON recipe_info.recipe_id=recipe_like.recipe_id INNER JOIN user_info ON user_info.user_id=recipe_like.user_id WHERE recipe_info.recipe_id=$recipe_id AND user_info.user_id=$user_id");

     $selectuserinfo = mysqli_query($connect,"SELECT user_profile_pic FROM user_info WHERE user_id=$user_id");
     if(mysqli_num_rows($selectstatment) != 0)
     {
          while($selectstatmentarray = mysqli_fetch_assoc($selectstatment))
          {    
               $recipe_made_user_id = $selectstatmentarray['user_id'];
          }   
     }  

     echo '<div class="main"></div>';
     echo '<div class="hero">';
          echo '<div class="first">';
               echo '<div class="recipe_img">';
                   echo ' <img src="./images/bg4.jpeg">';
                    echo '<div class="like_report">';
                    $selectlikecount = mysqli_fetch_array($selectstatmentlike);
                    if($selectlikecount[1] == 0)
                    {
                         echo '<a href="like.php?recipe_id='.$recipe_id.'& user_id='.$user_id.'"><img class="like" src="./images/icons/like_white.png"></a><span>'.$selectlikecount[1].'</span>';
                         
                    }
                    else
                    {
                         echo '<a href="like.php?recipe_id='.$recipe_id.'& user_id='.$user_id.'"><img class="like" src="./images/icons/like_white.png"></a><span>'.$selectlikecount[1].'</span>';
                         
                    }
                         //echo '<a href="like.php?recipe_id='.$recipe_id.'& user_id='.$user_id.'"><img class="like" src="./images/icons/like_white.png"></a><span>'.$selectlikecount[1].'</span>';
                    if($recipe_made_user_id != $user_id)
                    {
                         //echo  '<a href="reportpage.php?recipe_id='.$recipe_id.'"><div class="report"></div>';
                         echo '<a href="reportpage.php?recipe_id='.$recipe_id.'"><img class="report" src="./images/icons/Report_black.png"></a>';//<span> 10</span>';
                    }
                    echo '</div>';
               echo '</div>';
               if(mysqli_num_rows($selectstatment1) != 0)
               {
                    while($selectstatmentarray = mysqli_fetch_assoc($selectstatment1))
                    { 
                         echo '<div class="recipename">';
                              echo '<h1>'.$selectstatmentarray['recipe_name'].'</h1>';
                         echo '</div>';
                         if($recipe_made_user_id != $user_id)
                         {    
                              echo '<div class="cook_info">';
                                   $profile_pic = $selectstatmentarray['user_profile_pic'];
                                   echo "<a href='profile.php?user_id=".$recipe_made_user_id."'><img src='./user_profile_image/".$user_id."/".$profile_pic."class='userimg'>";
                                   echo '<span>'.$selectstatmentarray['user_first_name'].' '.$selectstatmentarray['user_last_name'].'</span></a>';
                                   if($recipe_made_user_id != $user_id)
                                   {
                                        if(mysqli_num_rows($selectstatmentfollow) == 0)
                                        {
                                              echo '<span class="follow"><a href="follow_page.php?recipe_made_user_id='.$recipe_made_user_id.'& user_id='.$user_id.'& recipe_id='.$recipe_id.'">Follow</a></span>';
                                        }
                                        else
                                        {
                                            echo '<span class="follow"><a href="follow_page.php?recipe_made_user_id='.$recipe_made_user_id.'& user_id='.$user_id.'& recipe_id='.$recipe_id.'">Following</a></span>'; 
                                        }
                                   }
                                 //  echo '<span class="follow">Follow</span>';
                              echo '</div>';
                         
                         }
                         else
                         {
                              echo '<div class="cook_info">';
                                   $profile_pic = $selectstatmentarray['user_profile_pic'];
                                   echo "<a href='profile.php?user_id=".$recipe_made_user_id."'><img src='./user_profile_image/".$user_id."/".$profile_pic."class='userimg'>";
                                   echo '<span>'.$selectstatmentarray['user_first_name'].' '.$selectstatmentarray['user_last_name'].'</span></a>';
                                   //echo '<span class="follow">Follow</span>';
                              echo '</div>';
                         
                         }
                         /*echo '<div class="cook_info">';
                              echo '<img src="./images/joker.png" class="userimg">';
                              echo '<span>Shubham Bhogayata</span>';
                              echo '<span class="follow">Follow</span>';
                         echo '</div>';
                         */
                         echo '<div class="time_serves">';
                              echo '<div class="time">';
                                   echo '<div class="image">';
                                       echo ' <img class="watch" src="./images/icons/Watch.png"> <span>Time</span>';
                                  echo ' </div>';
                                  if($selectstatmentarray['recipe_cooktime_hour'] !=0 && $selectstatmentarray['recipe_cooktime_min'] !=0)
                                   {
                                        echo ' <div class="time2">';
                                        echo '<span>'.$selectstatmentarray['recipe_cooktime_hour'].'h : '.$selectstatmentarray['recipe_cooktime_min'].'min</span>';
                                        echo '</div>';
                                   }
                                   elseif($selectstatmentarray['recipe_cooktime_hour'] !=0)
                                   {
                                       echo ' <div class="time2">';
                                        echo '<span>'.$selectstatmentarray['recipe_cooktime_hour'].'h</span>';
                                        echo '</div>';  
                                   }
                                   elseif($selectstatmentarray['recipe_cooktime_min'])
                                   {
                                        echo ' <div class="time2">';
                                        echo '<span>'.$selectstatmentarray['recipe_cooktime_min'].'min</span>';
                                        echo '</div>';
                                   }
                                  /*echo ' <div class="time2">';
                                        echo '<span>30h : 60min</span>';
                                   echo '</div>';*/
                             echo ' </div>';
                              echo '<hr>';
                              echo '<div class="serves">';
                                   echo '<div class="image">';
                                        echo '<img class="people" src="./images/icons/Serves.png"> <span>Serves</span>';
                                   echo '</div>';
                                   echo '<div class="serves2">';
                                        echo '<span>'.$selectstatmentarray['recipe_serve'].
                                        ' person(s)</span>';
                                   echo '</div>';
                              echo '</div>';
                         echo '</div>';
                    }
               }

               if(mysqli_num_rows($selectstatmenting) != 0)
               {
                    echo '<div class="ingrediants">';
                         echo '<img class="ing" src="./images/icons/ings.png"><span class="name">Ingredients</span>';
                   while($selectstatmentingarray = mysqli_fetch_assoc($selectstatmenting))
                    {
                         echo '<div class="ings">';
                              echo '<ul>';
                                   echo '<li>'.$selectstatmentingarray['ing_name'].'</li>'; 
                              echo '</ul>';
                         echo '</div>';
                    }
                    echo '</div>';
               }
          echo '</div>';
          
          if(mysqli_num_rows($selectstatmentstep)!=0)
          {
               $Counter=0;
               echo '<div class="steps">';
                         echo '<div class="image">';
                              echo '<img class="ing" src="./images/icons/Steps.png"><span class="name">Steps</span>';
                         echo '</div>';
               while($selectstatmentsteparray = mysqli_fetch_assoc($selectstatmentstep))
               {
                    $Counter++;
                    
                         echo '<ul>';
                             echo ' <div class="step">';
                                   echo '<li>'.$Counter.'</li><span>'.$selectstatmentsteparray['recipe_step'].'</span>';
                              echo '</div>';
                         echo '</ul>'; 
               }
               echo '</div>';
          }
          if(mysqli_num_rows($selectstatmentillness) != 0)
          {
               echo '<div class="ingrediants" style="margin-bottom:50px;">';
                         echo '<img class="ing" src="./images/icons/health.png"><span class="name">Helpful for </span>';
              while($selectstatmentillnessarray = mysqli_fetch_assoc($selectstatmentillness))
               {
                         echo '<div class="ings" style="margin-left: -50px;">';
                              echo '<ul>';
                                   echo '<li>'.$selectstatmentillnessarray['illness_name'].'</li>';
                              echo '</ul>';
                         echo '</div>';
               }
               echo '</div>';
          }

          echo '<div class="comments">';
               echo '<div class="image">';
                    echo '<img class="ing" src="./images/icons/Comments.png"><span class="name">Comments</span>';
               echo '</div>';
               
          echo '<form method="post" class="post_comment" action="comment.php" >';
               if(mysqli_num_rows($selectuserinfo) !=0)
               {
                    $selectuserinfopic = mysqli_fetch_assoc($selectuserinfo);
                    echo '<img src="user_profile_image/'.$user_id.'/'.$selectuserinfopic['user_profile_pic'].'" class="userimage">';
               }
               echo '<input type="text" class="input" name="comment" placeholder="Post a Comment...">';
               echo '<input type="hidden" name="recipe_id" value="'.$recipe_id.'">';
               echo  '<button type="submit" name="postc"><img src="./images/icons/send_comm.png" class="send"></button>';
               //echo '<img src="./images/icons/send_comm.png" class="send">';
          echo '</form>';
               
               /*if(mysqli_num_rows($selectuserinfo) !=0)
               {
                    $selectuserinfopic = mysqli_fetch_assoc($selectuserinfo);
                    echo '<div><img src="user_profile_image/'.$user_id.'/'.$selectuserinfopic['user_profile_pic'].'" class="userimage"></div>';
               }*/
          if(mysqli_num_rows($selectstatmentcomments)!=0)
          {
               while($selectstatmentcommentsarray = mysqli_fetch_assoc($selectstatmentcomments))
               {
                    echo '<div class="cook_info">';
                         echo '<div class="user">';
                              if($selectstatmentcommentsarray['user_id'] != $user_id)
                              {
                                   echo "<a href='profile_for_other.php?user_id=".$selectstatmentcommentsarray['user_id']."'>";
                              }
                              else
                              {
                                   echo "<a href='profile.php?user_id=".$selectstatmentcommentsarray['user_id']."'>";
                              }
                              echo '<img src="user_profile_image/'.$selectstatmentcommentsarray['user_id'].'/'.$selectstatmentcommentsarray['user_profile_pic'].'" class="userimg">';
                              echo '<span>'.$selectstatmentcommentsarray['user_first_name']." " .$selectstatmentcommentsarray['user_last_name'].'</span></a>';
                              //echo '<span class="follow">4 min ago</span>';
                         echo '</div>';
                         echo '<span class="comment">'.$selectstatmentcommentsarray['comment'].'</span>';
                    echo '</div>';
               }
          }

                     /*<div class="cook_info">
                    <div class="user">
                         <img src="./images/joker.png" class="userimg">
                         <span>Shubham Bhogayata</span>
                         <span class="follow">4 min ago</span>
                    </div>
                    <span class="comment">mast recipe che bro</span>
               </div>
               <div class="cook_info">
                    <div class="user">
                         <img src="./images/joker.png" class="userimg">
                         <span>Shubham Bhogayata</span>
                         <span class="follow">4 min ago</span>
                    </div>
                    <span class="comment">mast recipe che bro</span>
               </div>*/ 
          echo '</div>';
     echo '</div>';
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