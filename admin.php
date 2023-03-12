<?php 
include("validuser.php");
include("connect.php");
$user_id = $_SESSION['user_id'];
//echo $_SESSION['user_id'];
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
    <title>MakeSomeFood | Manage User</title>
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
            <li><a href="index.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Home</a></li>
            <li><a href="advancesearch.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Search</a></li>
            <li><a href="Recipeupload.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Upload Recipe</a></li>
            <!-- <li><a href="contactus.php?user_id=<?php echo $user_id?>">Contact Us</a></li>
             -->
            <li><a href="profile.php?user_id=<?php echo $user_id?>"onclick="toggleMenu();">Profile</a></li>
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
                <a href="create.php" class="btn-big">Add Admin</a>
            </div>

            <div class="content">
                <h2 class="page-title">Manage Users</h2>
                <table>
                    <thead>
                        <th>SN</th>
                        <th>Username</th>
                        <th>Report Count</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        $countarray =array();
                               // $recipe_id_num = $selectrecipe_idarray['recipe_id'];
                                $selectrecipecount = mysqli_query($connect,"SELECT recipe_info.recipe_name,recipe_info.recipe_id,user_info.user_first_name,user_info.user_last_name,user_info.user_id,count(recipe_info.user_id) FROM `recipe_info` INNER JOIN recipe_report ON recipe_info.recipe_id = recipe_report.recipe_id INNER JOIN user_info ON recipe_info.user_id=user_info.user_id GROUP BY recipe_info.user_id");
                                //err();
                                if(mysqli_num_rows($selectrecipecount) !=0)
                                {

                                    while($selectrecipecountarray = mysqli_fetch_assoc($selectrecipecount))
                                    {
                                        array_push($countarray,$selectrecipecountarray);
                                    }    
                                }
                            //}
                            usort($countarray, function($a, $b) {
                                if($a['count(recipe_info.user_id)'] == $b['count(recipe_info.user_id)'])
                                {
                                    return 0;
                                }
                                elseif($a['count(recipe_info.user_id)'] > $b['count(recipe_info.user_id)'])
                                {
                                    return -1;
                                }
                                elseif($a['count(recipe_info.user_id)'] < $b['count(recipe_info.user_id)'])
                                {
                                    return 1;
                                }
                            });
                             foreach($countarray as $value)
                             {
                              //  echo 
                                    if($value['count(recipe_info.user_id)'] !=0)
                                    {
                                        echo '<tr>';
                                            echo '<td>'.$counter.'</td>';      
                                            echo '<td><a href="profile_for_other.php?user_id='.$value['user_id'].'">'.$value['user_first_name'].' '.$value['user_last_name'].'</a></td>';
                                            echo '<td>'.$value['count(recipe_info.user_id)'].'</a></td>';
                                            echo '<td><a href="deleteuser.php?user_id='.$value['user_id'].'">Delete</a></td>';
                                        echo '</tr>';
                                        $counter++;
                                    }
                            }
                            //SELECT recipe_info.*,user_info.*,count(recipe_info.user_id),recipe_report.* FROM `recipe_info` INNER JOIN recipe_report ON recipe_info.recipe_id = recipe_report.recipe_id INNER JOIN user_info ON recipe_info.user_id=user_info.user_id GROUP BY recipe_info.user_id  
                            //print_r($countarray);
                        ///}
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>