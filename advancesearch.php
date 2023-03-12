<?php 
include("validuser.php");
require("connect.php");
$user_id = $_SESSION['user_id'];?>
<html>
  <head>
    <title>MakeSomeFood | Search</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700" rel="stylesheet" />
    <link href="css/advancesearchcss.css" rel="stylesheet" />
    <style type="text/css">
      body
      {
        background-repeat: no-repeat;
        background-size: 100% 100%;
        opacity: 1.0;
      }
      body .s010 form .inner-form .basic-search
      {
        box-shadow: -1px 1px 12px -1px grey;
      }
      body .s010 form .inner-form .advance-search
      {
        box-shadow: -2px 1px 15px -1px grey;
        margin-top: 18px;
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

    <div class="s010" style="background: url(./images/bg3.jpg) no-repeat; background-position: center; background-size: cover;">
      <form method="post" action="advancesearchdisplay.php">
        <div class="inner-form">
          <div class="basic-search">
            <div class="input-field">
              <span color="white"><input id="search" type="text" value="" name="advancesearchcontent" placeholder="Enter Recipe Name" /></span>
              <div class="icon-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                  <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                </svg>
              </div>
            </div>
          </div>
          <div class="advance-search">
            <span class="desc">ADVANCED SEARCH</span>
            <div class="row">
              <div class="input-field">
                <div class="input-select">
                  <select name="recipe_type">
                    <option placeholder="" value="" selected>Type</option>
                     <?php
                      require("connect.php");
                      $seltime = mysqli_query($connect,"SELECT DISTINCT recipe_type FROM recipe_info");
                        if(mysqli_num_rows($seltime) != 0)
                        {
                         while($selecttime = mysqli_fetch_assoc($seltime)) 
                        { 
                          /*if($selecttime['recipe_type'] != "0" && $selecttime['recipe_cooktime_min'] != "0")
                          {*/
                            echo "<option value='".$selecttime['recipe_type']."'>".'</option>';
     //                     }
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select name="ing_name">
                    <option placeholder=""  value="" selected>Ingredient</option>
                    <?php
                      finddata("ing_name","ing_info");
                    ?>
                    </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select name="illness_name">
                    <option placeholder="" value="" selected>Illness</option>
                    <?php
                    finddata("illness_name","illness_info");
                    ?>  
                  </select>
                </div>
              </div>
            </div>
            <div class="row second">
              <div class="input-field">
                <div class="input-select">
                  <select name="recipe_cooktime_">
                    <option placeholder="" value="" selected>Time</option>
                    <?php
                      require("connect.php");
                      $seltime = mysqli_query($connect,"SELECT DISTINCT recipe_cooktime_hour, recipe_cooktime_min FROM recipe_info");
                        if(mysqli_num_rows($seltime) != 0)
                        {
                         while($selecttime = mysqli_fetch_assoc($seltime)) 
                        { 
                          if($selecttime['recipe_cooktime_hour'] != "0" && $selecttime['recipe_cooktime_min'] != "0")
                          {
                            echo "<option value='".$selecttime['recipe_cooktime_hour'].":".$selecttime['recipe_cooktime_min']."'>".$selecttime['recipe_cooktime_hour'].' Hour '.$selecttime['recipe_cooktime_min'].' Min</option>';
                          }
                          else if($selecttime['recipe_cooktime_hour'] != "0")
                          {
                             echo "<option value='".$selecttime['recipe_cooktime_hour'].":00'>".$selecttime['recipe_cooktime_hour'].' Hour</option>'; 
                          }
                          else if($selecttime['recipe_cooktime_min'] != "0")
                          {
                            echo "<option value='00:".$selecttime['recipe_cooktime_min']."'>".$selecttime['recipe_cooktime_min'].' Min</option>';
                          }
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="input-field">
                <div class="input-select">
                  <select data-trigger="" name="recipe_level">
                    <option placeholder="" value="" selected>Recipe Level</option>
                    <option value="Beginners">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Expert">Expert</option>
                    <option value="All">All</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row third">
              <div class="input-field">
                <div class="result-count"></div>
                <div class="group-btn">
                  <button class="btn-delete" id="delete">RESET</button>
                  <button class="btn-search" name="advancesearchbtn">SEARCH</button>
                </div>
              </div>
            </div>
          </div>          
        </div>
      </div>
      </form>
    </div>
   <script src="./js1/extention/choices.js"></script>
    <script>
      const customSelects = document.querySelectorAll("select");
      const deleteBtn = document.getElementById('delete')
      const choices = new Choices('select',
      {
        searchEnabled: false,
        itemSelectText: '',
        removeItemButton: true,
      });
      for (let i = 0; i < customSelects.length; i++)
      {
        customSelects[i].addEventListener('addItem', function(event)
        {
          if (event.detail.value)
          {
            let parent = this.parentNode.parentNode
            parent.classList.add('valid')
            parent.classList.remove('invalid')
          }
          else
          {
            let parent = this.parentNode.parentNode
            parent.classList.add('invalid')
            parent.classList.remove('valid')
          }
        }, false);
      }
      deleteBtn.addEventListener("click", function(e)
      {
        e.preventDefault()
        const deleteAll = document.querySelectorAll('.choices__button')
        for (let i = 0; i < deleteAll.length; i++)
        {
          deleteAll[i].click();
        }
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
<?php
function finddata($row_name,$table_name)
{
  require("connect.php");
  $select = mysqli_query($connect,"SELECT DISTINCT `$row_name` from `$table_name` ORDER BY $row_name ASC");
  if(mysqli_num_rows($select) !=0)
  {
    while($sel = mysqli_fetch_assoc($select))
    {
      echo "<option value='".$sel[$row_name]."'>".$sel[$row_name].'</option>';
    }
  }
}
?>