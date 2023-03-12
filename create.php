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
    <title>ADMIN PANEL | ADD USER</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" media='screen'>
    <link rel="stylesheet" href="css/adminstyle.css">
    <script src='main.js'></script>
    <style type="text/css">
        input[type=submit]
        {
            width: 150px;
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
    <header>
        <div class="logo">
            <h1 class="logo-text"><span>Make</span>SomeFood</span></h1>
        </div>
        
        <ul class="nav">
            <li><a href="index.php?user_id=<?php echo $user_id?>">Home</a></li>
            <li><a href="advancesearch.php?user_id=<?php echo $user_id?>">Search</a></li>
            <li><a href="Recipeupload.php?user_id=<?php echo $user_id?>">Upload Recipe</a></li>
            <!-- <li><a href="contactus.php?user_id=<?php echo $user_id?>">Contact Us</a></li>
             -->
             <li><a href="profile.php?user_id=<?php echo $user_id?>">Profile</a></li>
            <li><a href="logout.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Log out</a></li>
            
        </ul>

    </header>

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
            <div>
                <!--<a href="create.php" class="btn-big">Add User</a>-->
                <a href="admin.php" class="btn-big">Manage Users</a>
            </div>

            <div class="content">
                <h2 class="page-title">Add Admin</h2>
                <form action="addadmin.php" method="POST">
                    <div>
                        <label>First Name</label>
                        <input type="text" name="fname" class="text-input" >
                    </div>
                    <div>
                        <label>Last Name</label>
                        <input type="text" name="lname" class="text-input" >
                    </div>
                    
                    <div>
                        <label>Password</label>
                        <input type="password" name="password" class="text-input">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" class="text-input">
                    </div>
                    <?php 
                        if(isset($_SESSION['signinmessage']))
                        {
                            echo "<br><span style='color:red;font-size:20px;'>".$_SESSION['signinmessage']."</span>";
                        }
                        elseif(isset($_SESSION['donemessage']))
                        {
                            echo "<br><span style='color:green;font-size:20px;'>".$_SESSION['donemessage']."</span>";
                        }
                        unset($_SESSION['signinmessage']);
                        unset($_SESSION['donemessage']);
                    ?>
                    <div>
                        <input type="submit" name="submit" value="Add Admin" class="btn-big">
                    </div>
            </div>
        </div>

    </div>
</body>
</html>