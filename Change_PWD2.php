<?php 
include("validuser.php");
require("connect.php");
$user_id = $_SESSION['user_id'];?>
<!DOCTYPE html>
<html lang="en">
<head>
     <title>MakeSomeFood | Create New Password</title>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="css/Change_PWD2.css">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Potta+One&display=swap" rel="stylesheet">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
     
     <div class="main" style="background: url(./images/bg4.jpeg); background-size: cover;">
          <div class="formContainer">
               <div class="text">
                    <h2>Create New Password</h2>
               </div>
               <form class="form" method="post">
                    <div class="inputBox1">
                         <input type="password" class="i1" placeholder="New Password" name="password" required>
                    </div>
                    <div class="inputBox3">
                         <input type="password" class="i3" placeholder="Confirm Password" name="cpwd" required>
                    </div>
                    <div class="inputBox2">
                         <input type="submit" class="i2" name="pwdsubmit">
                    </div>
                     <?php 
                    if(isset($_SESSION['passwordmessage']))
                    {
                         echo "<span style=\"color:red;font-size: 20px;,font-weight:bold;\">".$_SESSION['passwordmessage']."</span>" . "<br>";  
                    }
                    ?> 
               </form>
          </div>
     </div>

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
<?php
if(isset($_POST['pwdsubmit']))
{
  $pwd = $_POST['password'];
  $cpwd = $_POST['cpwd'];
  $user_id = $_SESSION['user_id'];
  if($pwd == $cpwd)
  {
    include("connect.php");
    $result = mysqli_query($connect,"UPDATE `user_info` SET `user_password`='$cpwd' WHERE `user_id`='".$user_id."'");  
    header("location:profile.php?recipe_made_user_id=$user_id");
  }
  else
  {
    $_SESSION['passwordmessage'] = "Both Password Does Not Match.";
    header("location:Change_PWD2.php");
    return;
  }
}
