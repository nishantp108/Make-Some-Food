<!DOCTYPE html>
<html lang="en">
<head>
     <title>MakeSomeFood | Forgot Password</title>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="css/Forgot_PWD.css">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

     <!-- ==================== Navigation Bar Starts ==================== -->

     <header>
          <a href="#Home" class="logo">MakeSomeFood<span>.</span></a>
          <div class="menuToggle" onclick="toggleMenu();"></div>
        <?php
        session_start();
        include("connect.php");
        if(isset($_SESSION['user_id']))
        {
          $user_id = $_SESSION['user_id'];
          echo '<ul class="navigation">';
            echo '<li><a href="index.php?user_id='.$user_id.'" onclick="toggleMenu();">Home</a></li>';
            echo '<li><a href="advancesearch.php?user_id='.$user_id.'" onclick="toggleMenu();">Search</a></li>';
            echo '<li><a href="Recipeupload.php?user_id='.$user_id.'"onclick="toggleMenu();">Upload Recipe</a></li>';
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
              echo '<li><a href="profile.php?user_id='.$user_id.'"onclick="toggleMenu();">Profile</a></li>';
            echo '<li><a href="logout.php?user_id='.$user_id.'"onclick="toggleMenu();">Log out</a></li>';
          echo '</ul>';
        }
          ?>
     </header>

     <!-- ==================== Navigation Bar Ends ==================== -->

     <div class="main" style="background: url(./images/bg.jpg); background-size: cover;">
          <div class="formContainer">
               <div class="text">
                    <h2>Forgot Password</h2>
               </div>
               <form class="form" method="post" action="forgot_pwddb.php">
                    <div class="inputBox1">
                         <input type="text" class="i1" placeholder="Email" name="email" required>
                    </div>
                    <?php 
                    if(isset($_SESSION['forgotpasswordmessage']))
                    {
                         echo "<span style=\"color: white;font-size: 20px;font-weight:bold;\">".$_SESSION['forgotpasswordmessage']."</span>" . "<br>";  
                    }
                    unset($_SESSION['forgotpasswordmessage']);
                    ?>
                    <div class="inputBox2">
                         <input type="submit" class="i2" name="sendotp">
                    </div>
                    
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
//session_unset();
//session_destroy();
?>