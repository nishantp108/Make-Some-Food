<?php 
include("validuser.php");
require("connect.php");
$user_id = $_SESSION['user_id'];?>
<!DOCTYPE html>
<html lang="en">
<head>
     <title>MakeSomeFood | Change Password</title>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/Change_PWD.css">
      <style type="text/css">
       a{
        text-decoration: none;
        font-weight: bold;
        font-size:20px;
       }
       a:hover
       {
        color: mediumvioletred; 
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

     <div class="main" style="background: url(./images/bg4.jpeg); background-size: cover; background-repeat: no-repeat;">
          <div class="formContainer">
               <div class="text">
                    <h2>Change Password</h2>
               </div>
               <div class="email">
                <?php 
                  include("connect.php");
                  $user_id = $_SESSION['user_id'];
                  $select = mysqli_query($connect,"SELECT user_email FROM user_info WHERE user_id=$user_id");
                  if(mysqli_error($connect))
                  {
                    echo "Error";
                  }
                    if(mysqli_num_rows($select)!=0)
                    {
                      while($selectarray = mysqli_fetch_assoc($select))
                      {
                        echo "<h3>".$selectarray['user_email'].'<h3>';
                      }
                    }
                  ?>  
               </div>
               <form class="form" method="post">
                    <div class="inputBox1">
                         <input type="password" class="i1" placeholder="Current Password" name="pwd" required>
                    </div>
                    <div class="inputBox2">
                         <input type="submit" class="i2" value="Verify" name="pwdsend">
                    </div>
                   <a href="Forgot_PWD.php">Forgot Password</a><br>
                    
                     <?php
                        // $email = $_SESSION['email'];
                         //echo $email; 

                    if(isset($_SESSION['pwdnotmatch']))
                    {
                         echo "<span style=\"color: red;font-size: 20px;font-weight:bolder;\">".$_SESSION['pwdnotmatch']."</span>" . "<br>";  
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
  //session_start();
  if(isset($_POST['pwdsend']))
  {
    include("connect.php");
    $pwd = $_POST['pwd'];
    $user_id = $_SESSION['user_id'];
    $select = mysqli_query($connect,"SELECT user_first_name,user_last_name FROM user_info WHERE user_id='".$user_id."'AND `user_password`='".$pwd."'");
    
    if(mysqli_connect_error())
    {
      echo "error";
    }
    if(mysqli_num_rows($select) != 0)
    {
      unset($_SESSION['pwdnotmatch']);
      header("location:Change_PWD2.php");
      return;
    }
    else
    {
      $_SESSION['pwdnotmatch'] = "Password Does Not Match";
      header("location:Change_PWD.php");
      return;
    }
  }