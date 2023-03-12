<!DOCTYPE html>
<html lang="en">
<head>
     <title>MakeSomeFood | Email Verification</title>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="css/Forgot_PWD2.css">
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Potta+One&display=swap" rel="stylesheet">
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
               <div class="email">
                    <h2>
                         <?php 
                         //session_start();
                         echo $_SESSION['email'];
                         ?>
                    </h2>
               </div>
               <form class="form" method="post" action="Forgot_PWD2db.php">
                    <div class="inputBox1">
                         <input type="number" class="i1" placeholder="OTP" name="otp" required>
                    </div>
                    <?php
                        // $email = $_SESSION['email'];
                         //echo $email; 
                    if(isset($_SESSION['otpmessage']))
                    {
                         echo "<span style=\"color: white;font-size: 30px,font-weight:bold;\">".$_SESSION['otpmessage']."</span>" . "<br>";  
                    }
                    ?>
                    <div class="inputBox2">
                         <input type="submit" class="i2" value="Verify" name="otpsend">
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
<?php/*
session_unset();
session_destroy();*/
?>
