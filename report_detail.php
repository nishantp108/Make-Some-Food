<?php 
include("validuser.php");
include("connect.php");
$user_id = $_SESSION['user_id'];
$select = mysqli_query($connect,"SELECT admin_id FROM admin_info WHERE user_id=$user_id");
if(mysqli_num_rows($select) == 0)
{
    return;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>MakeSomeFood | Admin Panel</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" media='screen'>
    <link rel="stylesheet" href="adminstyle.css">
    <script src='main.js'></script>
    <style type="text/css">
        table tr td
        {
            text-align: center;
            overflow-wrap: anywhere;
            max-width: 140px;
        }
        table tr th
        {
            text-align: center;
        }
        table tr
        {
            max-width:150px;
        }
        tr td a
        {
            text-decoration: none;
            color: black;
        }
        tr td a:hover
        {
            color: skyblue;
        }
    </style>
</head>
<body>
    <!-- ==================== Navigation Bar Starts ==================== -->

     <header>
          <a href="index.php?user_id=<?php echo $user_id?>" class="logo">MakeSomeFood<span>.</span></a>
          <div class="menuToggle" onclick="toggleMenu();"></div>
          <ul class="navigation">
               <li><a href="index.php?user_id=<?php echo $user_id?>" onclick="toggleMenu();">Home</a></li>
               <li><a href="advancesearch.php?user_id=<?php echo $user_id?>" onclick="toggleMenu();">Search</a></li>
               <li><a href="recipeupload.php?user_id=<?php echo $user_id?>" onclick="toggleMenu();">Upload Recipe</a></li>
               <li class="user"><a href="profile.php?user_id=<?php echo $user_id?>" onclick="toggleMenu();">Profile</a></li>
               <li><a href="logout.php?user_id=<?php echo $user_id?>" onclick="toggleMenu();">Log out</a></li>
          </ul>
     </header>

     <!-- ==================== Navigation Bar Ends ==================== -->

    <div class="admin-wrapper">
        <div class="left-sidebar">
            <ul>
                <li><a href="postrecp.php">Post Recipes</a></li>
                <li><a href="admin.php">Manage Users</a></li>
                <li><a href="managerec.php">Manage Recipes</a></li>
                <li><a href="admincont.php">User Messages</a></li>
            </ul>
        </div>

        <div class="admin-content">
           

            <div class="content">
                <h2 class="page-title" style="float: left;">French Fries</h2>
                <table>
                    <thead> 
                    
                        <th>Username</th>
                        <th>Report Descreption</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
                        <?php
                            include("connect.php");
                            $select = mysqli_query($connect,"SELECT * FROM feedback ORDER BY feedback_id DESC");
                            if(mysqli_num_rows($select)!=0)
                            {
                                $count = 1;
                                while($selectarray = mysqli_fetch_assoc($select))
                                {
                                     echo '<tr>';
                                        echo '<td>'.$count++.'</td>';      
                                        echo '<td>'.$selectarray['user_name'].'</td>';
                                        echo '<td>'.$selectarray['feedback'].'</td>';
                                        echo '<td class="delete"><a href="removefeedback.php?feedback_id='.$selectarray['feedback_id'].'">Remove</a></td>';
                                        echo '<td class="delete"><a href="removefeedback.php?feedback_id='.$selectarray['feedback_id'].'">Delete</a></td>';
                                    echo '</tr>';
                                }
                            }
                        ?>
                       
                    </tbody>
                </table>
            </div>
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