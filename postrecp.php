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
    <title>ADMIN PANEL | Publish Recipes</title>
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
           

            <div class="content">
                <h2 class="page-title">Trending Recipes</h2>
                <table>
                    <thead>
                        <th>SN</th>
                        <th>Username</th>
                        <th>Recipe_Name</th>
                        <th>Recipe Like Count</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        include("connect.php");
                        
                        $selectrecipe_id = mysqli_query($connect,"SELECT recipe_id FROM recipe_like GROUP BY recipe_id");
                        $counter = 1;
                        $countarray =array();
                        if(mysqli_num_rows($selectrecipe_id) !=0)
                        {
                            while($selectrecipe_idarray = mysqli_fetch_assoc($selectrecipe_id))
                            {
                                $recipe_id_num = $selectrecipe_idarray['recipe_id'];
                                $selectrecipecount = mysqli_query($connect,"SELECT user_first_name,user_last_name,user_info.user_id,recipe_info.recipe_id,recipe_name,count(recipe_like.recipe_id) FROM recipe_like INNER JOIN recipe_info ON recipe_info.recipe_id=recipe_like.recipe_id INNER JOIN user_info ON recipe_info.user_id=user_info.user_id WHERE recipe_like.recipe_id=$recipe_id_num ");
                                if(mysqli_num_rows($selectrecipecount) !=0)
                                {

                                    while($selectrecipecountarray = mysqli_fetch_assoc($selectrecipecount))
                                    {
                                        array_push($countarray,$selectrecipecountarray);
                                    }    
                                }
                            }
                            usort($countarray, function($a, $b) {
                                if($a['count(recipe_like.recipe_id)'] == $b['count(recipe_like.recipe_id)'])
                                {
                                    return 0;
                                }
                                elseif($a['count(recipe_like.recipe_id)'] > $b['count(recipe_like.recipe_id)'])
                                {
                                    return -1;
                                }
                                elseif($a['count(recipe_like.recipe_id)'] < $b['count(recipe_like.recipe_id)'])
                                {
                                    return 1;
                                }
                            });
                             foreach($countarray as $value)
                             {
                                    if($value['count(recipe_like.recipe_id)'] !=0)
                                    {
                                        $recipe_id=$value['recipe_id'];
                                        echo '<tr>';
                                            echo '<td>'.$counter.'</td>';  
                                             echo '<td><a href="profile_for_other.php?user_id='.$value['user_id'].'">'.$value['user_first_name'].' '.$value['user_last_name'].'</a></td>';
                                            echo '<td><a href="recipeview.php?recipe_id='.$value['recipe_id'].'">'.$value['recipe_name'].'</td>';
                                            echo '<td>'.$value['count(recipe_like.recipe_id)'].'</a></td>';
                                            $selecttrendingrecipe = mysqli_query($connect,"SELECT recipe_id FROM trending_recipe WHERE recipe_id=$recipe_id");
                                            if(mysqli_num_rows($selecttrendingrecipe)==0)
                                            {
                                                echo '<td class="publish"><a href="publish.php?recipe_id='.$recipe_id.'">Publish</a></td>';
                                            }
                                            else
                                            {
                                                echo '<td class="publish"><a href="publish.php?recipe_id='.$recipe_id.'">Depublish</a></td>';
                                            }
                                        echo '</tr>';
                                        $counter++;
                                    }
                            }
                            //print_r($countarray);
                        }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>