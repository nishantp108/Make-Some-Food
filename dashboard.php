<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ADMIN PANEL | Dashboard </title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" media='screen'>
    <link rel="stylesheet" href="css/adminstyle.css">
    <script src='main.js'></script>
    <style type="text/css">
        table tr td
        {
            text-align: center;
        }
        table tr th
        {
            text-align: center;
        }
        a
        {
            text-decoration: none;
            color: black;
        }
        a:hover
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
        <ul class="nav">
            <li><a href="index.php?user_id=<?php echo $user_id?>">Home</a></li>
            <li><a href="advancesearch.php?user_id=<?php echo $user_id?>">Search</a></li>
            <li><a href="Recipeupload.php?user_id=<?php echo $user_id?>">Upload Recipe</a></li>
            <!-- <li><a href="contactus.php?user_id=<?php echo $user_id?>">Contact Us</a></li>
             -->
             <li><a href="profile.php?user_id=<?php echo $user_id?>">Profile</a></li>
            <li><a href="logout.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Log out</a></li>
            
        </ul>
</li>
        </ul>
    </header>

    <div class="admin-wrapper">

        <div class="left-sidebar">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="postrecp.php">Post Recipes</a></li>
                <li><a href="admin.php">Manage Users</a></li>
                <li><a href="managerec.php">Manage Recipes</a></li>
                <li><a href="admincont.php">User Messages</a></li>
            </ul>
        </div>

        <div class="admin-content">
        <div class="dashboard-cards">

            <div class="card-single">
                <div class="card-body">
                    <span class="ti-briefcase"></span>
                    <div>
                        <h5>Manage USers</h5>
                        <h4>3030</h4>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="">View all</a>
                </div>
            </div>

            <div class="card-single">
                <div class="card-body">
                    <span class="ti-reload"></span>
                    <div>
                        <h5>Manage Recipes</h5>
                        <h4>30450</h4>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="">View all</a>
                </div>
            </div>

            <div class="card-single">
                <div class="card-body">
                    <span class="ti-checkbox"></span>
                    <div>
                        <h5>Post Recipes</h5>
                        <h4>30450</h4>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="">View all</a>
                </div>
            </div>

        </div>
      </div>

    </div>
</body>
</html>