<?php
	include("validuser.php");
	if(!isset($_GET['recipe_id']))
	{
		echo "Invalid URL.";
		return;
	}
	include("connect.php");
	//session_start();
	//$user_id = $_SESSION['user_id'];
	$recipe_id = $_GET['recipe_id'];
	$selectarray = array();
	$select = mysqli_query($connect,"SELECT recipe_name,user_first_name,user_last_name FROM recipe_info INNER JOIN user_info ON recipe_info.user_id=user_info.user_id WHERE recipe_info.recipe_id=$recipe_id");
	if(mysqli_num_rows($select)!=0)
	{
		$selectarray = mysqli_fetch_assoc($select);

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>MakeSomeFood | Contact Us</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">

	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">

	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/contactus.css"> 
	<style type="text/css">
		.input100
		{
			padding-top: 10px;
			padding-bottom: 10px;
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

	<div class="container-contact100" style="background-image: url('images/bg1.jpeg');">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" method="post" action="reportpagedb.php">
				<span class="contact100-form-title">
					Report Recipe
				</span>

					<span class="label-input100">Reported Recipe Name</span>
					<div class="input100"><spna style="text-transform: capitalize;font-size: 30px;"><?php echo $selectarray['recipe_name'];?></spna></div>
					<span class="label-input100">Creater Name</span>
					<div class="input100"><spna style="text-transform: capitalize;font-size: 30px;"> <?php echo $selectarray['user_first_name'].' '.$selectarray['user_last_name'] ?></div>
				
				<input type="hidden" name="recipe_id" value="<?php echo $recipe_id; ?>">

				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input100">Message</span>
					<textarea class="input100" name="message" placeholder="Your message here..."></textarea>
				</div>
				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn" name="submit">
							Submit
						</button>
					</div>
				</div>
			</form>
		</div>

		</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
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
