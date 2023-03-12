<?php

    if(isset($_POST['login']))
    {
        session_start();
        $email = $_POST['email'];
        $PWD = $_POST['password'];

        require("connect.php");
        $checkadmin = mysqli_query($connect,"SELECT `user_id` FROM `admin_info` WHERE `admin_email`='".$email."' && admin_password='".$PWD."'");
        if(mysqli_num_rows($checkadmin) != 0)
        {
            while($checkadminarray = mysqli_fetch_assoc($checkadmin))
            {
                //echo "Done";
                $user_id = $checkadminarray['user_id'];
                $selectuser_id = mysqli_query($connect,"SELECT `user_first_name`,`user_last_name`,`user_id` FROM user_info WHERE user_id=$user_id ");
                if(mysqli_num_rows($selectuser_id)!=0)
                {
                    $selectuser_idarray  =mysqli_fetch_assoc($selectuser_id);
                    $_SESSION['user_first_name'] = $user_first_name = $selectuser_idarray['user_first_name'];
                    $_SESSION['user_last_name'] = $user_last_name = $selectuser_idarray['user_last_name'];
                    $_SESSION['user_id'] = $user_id = $selectuser_idarray['user_id'];
                    header("location:admin.php");
                 }
            }
        }
        else
        {
            $checkuser = mysqli_query($connect,"SELECT `user_first_name`,`user_last_name`,`user_id` FROM `user_info` WHERE `user_email`='".$email."' && user_password='".$PWD."'");
            if(mysqli_num_rows($checkuser) != 0)
            {
                while($checkuserarray = mysqli_fetch_assoc($checkuser))
                {
                    //echo "Done";
                    $user_info = mysqli_fetch_assoc($check);
                    $_SESSION['user_first_name'] = $user_first_name = $checkuserarray['user_first_name'];
                    $_SESSION['user_last_name'] = $user_last_name = $checkuserarray['user_last_name'];
                    $_SESSION['user_id'] = $user_id = $checkuserarray['user_id'];
                    header("location:index.php");
                }
            }
            else
            {
                $_SESSION['loginmessage'] = "Email Or Password does not match.";
                header("location:signin.php");
                return;
            }
        }
    }