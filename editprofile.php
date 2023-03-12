<?php include("validuser.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    	<meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title>MakeSomeFood | Upload Recipe</title>
    	<link rel="stylesheet" href="css/editprofilecss.css">
    	<link rel="stylesheet" href="dynamicinputfield.php">
	<style type="text/css">
    .form-container
    {
      margin-top: -120px;
    }
  </style>
</head>
<body>

     <!-- ==================== Navigation Bar Starts ==================== -->

     <header>
          <a href="#Home" class="logo">Make Some Food<span>.</span></a>
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

	<!-- ==================== Upload Form Starts ==================== -->

	<center>
		<h2>Update Profile</h2>
	</center>
<?php
if(isset($_GET['user_id']))
{
  $user_id = $_SESSION['user_id'];
  $first_name = '';
  $last_name = '';
  $user_email = '';
  $user_pic = '';
  if($_GET['user_id'] == $user_id)
  {
      include("connect.php");
       $select =  mysqli_query($connect,"SELECT * FROM user_info WHERE user_id = $user_id");
       if(mysqli_error($connect))
       {
          echo "error";
       }
        if(mysqli_num_rows($select))
        {
            while($selectarray = mysqli_fetch_assoc($select))
          {
            $first_name = $selectarray['user_first_name'];
            $last_name = $selectarray['user_last_name'];
            $user_email = $selectarray['user_email'];
            $user_pic = $selectarray['user_profile_pic'];
           }
      }
  
	echo '<div class="form-container"></div>';
	echo '<form method="post" enctype="multipart/form-data">';

		echo '<label for="">First Name </label><br>';
		echo '<input type="text" name="first_name"value="'.$first_name.'" placeholder="Modify Your Name"  class="txt"><br>';

    echo '<label for="">Last Name </label><br>';
    echo '<input type="text" name="last_name" value="'.$last_name.'"class="txt">';
  	
		echo '<div class="rgt" style="top: 4.3%;">';
			echo '<label for="img">Profile Image</label><br>';
			echo '<input type="file" id="img" name="profile_image" value="'.$user_pic.'" accept="image/*" style="width: 100%;" >';
		echo '</div>';
		echo '<br><br>';
    echo '<input type="hidden" name="oldimage" value="<?php echo $user_pic; ?>">';
    echo '<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">';
		echo '<label for="">Email</label><br>';
		echo '<input type="email" name="email" value="'.$user_email.'" class="txt"><br>';

		  echo '</div>';
		echo '<br><br>';

 		echo '<div class="container-contact100-form-btn">';
			echo '<div class="wrap-contact100-form-btn" style="margin-left: auto;margin-right: auto;">';
				echo '<div class="contact100-form-bgbtn"></div>';
				echo '<button class="contact100-form-btn" name="submit">Update</button>';
			echo '</div>';
		echo '</div>';
	echo '</form>';
}
}
else
  {
    echo "Invalid Path. ";
  }
?>
	<!-- ==================== Upload Form Ends ==================== -->

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
$user_id = $_SESSION['user_id'];
if(isset($_POST['user_id']))
{
    include("connect.php");
    $first_name='';
    $last_name='';
    $email='';
    $profilepic = '';
    if(isset($_POST['first_name']))
    {
      $first_name=$_POST['first_name'];
    }
    if(isset($_POST['last_name']))
    {
      $last_name = $_POST['last_name']; 
    }
    if(isset($_POST['email']))
    {
      $email = $_POST['email'];
    }
    if (isset($_FILES['profile_image']) && !empty($_FILES['profile_image']['name']))
    {

       unlink("user_profile_image/$user_id/".$_POST['oldimage']);
            $profilepic   =  $_FILES['profile_image']['name'];
            $profile_tmp  =  $_FILES['profile_image']['tmp_name'];
            mkdir("user_profile_image/$user_id");
            move_uploaded_file($profile_tmp,"user_profile_image/$user_id/".$profilepic);
    }
    else
    {
           
      $profilepic   =  $_POST['oldimage'];


    }
    $select = mysqli_query($connect,"UPDATE `user_info` SET `user_first_name`='$first_name',`user_last_name`='$last_name',`user_email`='$email',`user_profile_pic`='$profilepic' WHERE user_id=$user_id");
    if(mysqli_error($select))
    {
      echo "error";
    }
    else
    {
      header("location:profile.php?user_id=$user_id");
    }
}
?>