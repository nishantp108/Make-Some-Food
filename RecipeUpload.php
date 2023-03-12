<?php include("validuser.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>MakeSomeFood | Upload Recipe</title>
    	<meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="css/recipeupload.css">
    	<link rel="stylesheet" href="dynamicinputfield.php">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    	<script>

$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".container1");
    var add_button = $(".btn1");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div><input type="text" name="recipeing[]" style="width: 55%;"/><a href="#" class="delete"><span style="margin-left: 1%;"><img src="./images/close.png" height="25px" width="25px" style="margin-top: 2%; filter: invert(.4)"></span></a></div>'); //add input box
        } else {
            alert('You Reached the limits');
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".container2");
    var add_button = $(".btn2");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div><input type="text" name="recipestep[]" style="width: 55%;"/><a href="#" class="delete"><span style="margin-left:1%;"><img src="./images/close.png" height="25px" width="25px" style="margin-top: 2%; filter: invert(.4)"></span></a></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".container3");
    var add_button = $(".btn3");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div><input type="text" name="recipeing[]" style="width: 55%;"/><a href="#" class="delete"><span style="margin-left:2%;"><img src="./images/close.png" height="25px" width="25px" style="margin-top: 2%; filter: invert(.4)"></span></a></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
</script>

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

	<!-- ==================== Upload Form Starts ==================== -->

	<center>
		<h2>Upload Your Recipe</h2>
	</center>

	<div class="form-container"></div>
	<form method="post" action="recipeuploaddb.php" enctype="multipart/form-data">
		<label for="">Recipe Name</label><br>
		<input type="text" name="recipe_name"value="" placeholder="Name Of Your Recipe"  class="txt">
		
		<div class="rgt" style="top: 4.3%;">
			<label for="img">Image Of Your Recipe</label><br>
			<input type="file" id="img" name="recipe_image"  accept="image/*" style="width: 100%;" >
		</div>			
		<br><br>
		
		<label for="">Ingredients</label><br>
		<div class="container1">
			<dl>
		    	<dt><input type="text" name="recipeing[]" placeholder="Example : 100ml water" style="width: 55%;"></dt>
			</dl>					    	
		</div>			
		<button type="button" class="btn1"> <span>+</span> Add Ingredient</button>
	
		<!--<input type="ing" placeholder="100ml water" required style="width: 55%;">
		-->
		<br><br>

		<label for="">Steps</label><br>
		<div class="container2">
			<dl>
		    	<dt><input type="text" name="recipestep[]" placeholder="Example : Boil water" value=""  style="width: 55%;"></dt>
			</dl>	    	
		</div>
		<button type="button" class="btn2"> <span>+</span> Add Step</button>
		<br><br>
	
		<label for="">Tell Us About Your Recipe</label><br>
		<textarea name="about_recipe" style="width: 92%;"value="" class="txt" cols="40" rows="7" placeholder="About your recipe"></textarea>
		<br><br>
		
		<label for="">Cooking Time</label><br>
		<input type="number" name="recipe_cooktime_hour" min="0" value="" max="12" placeholder="hours"  class="num" style="width: 12%"> :
		<input type="number" name="recipe_cooktime_min" min="0" max="59" placeholder="minutes"  class="num" style="width: 15%">
		<br>
		
		<div class="rgt" style="margin-top: -7.3%;">
			<label for="">Serves to</label><br>
			<input type="number" name="recipe_serve" min="1" value="" placeholder="No. of People"  class="num" style="padding: 2.3%; margin-top: .8%; width: 99%">
		</div>
		<br>
		
		<label for="">Recipe type</label><br>
		<div class="type">
			<input type="radio" name="recipe_type" value="Veg" id="">Veg<br>
			<input type="radio" name="recipe_type" value="Non-Veg" id="">Non-Veg<br>
			<input type="radio" name="recipe_type" value="Veg (With eggs)" id="">Veg (With eggs)
			<!-- <input type="text" name="recipe_type" value=""> -->
		</div>
		<br>

		<div class="recipe_timing2">
			<label for="">Recipe Level</label><br>
			<select class="sel" name="recipe_level">
				<option value="All" value="" selected>All</option>
				<option value="For Beginners">For Beginners</option>
				<option value="For Intermediate">For Intermediate</option>
				<option value="For Expert">For Expert</option>
			</select>
		</div>
		<br>

		<div class="recipe_meal_type">
			<label for="">Recipe Meal type</label><br>
			<select class="sel"name="meal_type">
				<option value="" selected>All</option>
				<option value="Lunch">Lunch</option>
				<option value="Dinner">Dinner</option>
				<option value="Breakfast">Breakfast</option>
			</select>
		</div>
		<br>
		
		<div class="cuisine">
			<label for="">Cuisine</label><br>
			<input type="text" name="recipe_cuisine" placeholder="Example : Indian" style="padding: 2.3%; 	font-size: 15px; width: 100%;">
		</div>
		<br><br>
		<label for="">Why you should eat it ???</label><br>
		<div class="container3">
			<dl>
		    	<dt><input type="text" name="recipe_illness[]" placeholder="Example : Lower Stamina, low Weight" style="width: 55%"></dt>
			</dl>					    	
		</div>			
		<button type="button" class="btn3"> <span>+</span> Add Illness</button>
		<br>

 		<div class="container-contact100-form-btn">
			<div class="wrap-contact100-form-btn" style="margin-left: auto;margin-right: auto;">
				<div class="contact100-form-bgbtn"></div>
				<button class="contact100-form-btn" name="submit">Submit</button>
			</div>
		</div>
	</form>

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