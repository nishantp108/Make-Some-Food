<?php  session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>MakeSomeFood | SignUp & Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="css/signin.css" />
  </head>
  <body>

      <!-- ==================== Navigation Bar Starts ==================== -->

      <header>
          <a href="#Home" class="logo">MakeSomeFood<span>.</span></a>
          <div class="menuToggle" onclick="toggleMenu();"></div>
      </header>

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
      
      <!-- ==================== Navigation Bar Ends ==================== -->

    <?php
            if((isset($_SESSION['signinmessage']))){
    ?>

    <div class="container sign-up-mode" style="background-image: url(images/bg.jpg); background-size: cover; background-position: center;">

    <?php
            }
            elseif((isset($_SESSION['loginmessage']))){
    ?>

    <div class="container" style="background-image: url(images/bg.jpg); background-size: cover; background-position: center">

    <?php
            }
            else {
    ?>

    <div class="container" style="background-image: url(images/bg.jpg); background-size: cover; background-position: center">
    <?php
            }
    ?>
      <div class="forms-container">
        <div class="signin-signup">
          <form class="sign-in-form" method="post" action="logindb.php">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Email" name="email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password"/>
            </div>
            <?php 
            if(isset($_SESSION['loginmessage']))
            {
                  echo "<span style=\"color: white;font-size: 20px;margin-left:50px\">".$_SESSION['loginmessage']."</span>" . "<br>";  
            }
            ?>
            <input type="submit" value="Login" class="btn-rec solid" name="login" formaction="logindb.php"/>
            <input type="submit" value="Forgot Password" class="btn-rec solid" formaction="Forgot_PWD.php" />
            
          </form>
          <form class="sign-up-form" method="post" action="signindb.php">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Firstname" name="fname" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Lastname" name="lname" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required/>
            </div>
            <?php 
            if(isset($_SESSION['signinmessage']))
            {
                  echo "<span style=\"color: white;font-size: 20px;margin-left:50px,font-weight:bold;\">".$_SESSION['signinmessage']."</span>" . "<br>";  
            }
            ?>
            <input type="submit" class="btn-rec" name="signin" formaction="signindb.php" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Save recipes across devices, write reviews, and share your own photos and have recipes handy when you cook!
            </p>
            <button class="btn transparent cir" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?<br>Your recipes are waiting</h3>
            <p> Connect to customize your recipe discovery.</p>
            <button class="btn transparent cir" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script type="text/javascript">
      const sign_in_btn = document.querySelector("#sign-in-btn");
      const sign_up_btn = document.querySelector("#sign-up-btn");
      const container = document.querySelector(".container");
      const tempClass = document.querySelector(".sign-up-mode");
      
      sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
      });

      sign_in_btn.addEventListener("click", () => {
        container.classList.remove("sign-up-mode");
        
      });
    </script>
  </body>
</html>
<?php
session_unset();
session_destroy();
?>