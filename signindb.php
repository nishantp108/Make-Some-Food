<?php
    if(isset($_POST['signin']))
    {
        session_start();
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $email = $_POST['email'];
        $PWD = $_POST['password'];

        if(strlen($PWD) <= 8)
        {

        }
        else
        {
            $_SESSION['signinmessage'] = "Password Must be 8 Character Long.";
            header("location:Signin.php");
            return;
        }
        require("connect.php");
        $select = mysqli_query($connect,"SELECT `user_id` FROM `user_info` WHERE `user_email`='".$email."'");
        if(mysqli_num_rows($select) == 0)
        {
            $profile_pic = "prpfilepic.png";
            $insert = mysqli_query($connect,"INSERT INTO `user_info`(`user_first_name`, `user_last_name`, `user_email`, `user_password`,`user_profile_pic`) VALUES('$firstname','$lastname','$email','$PWD','$profile_pic')");
            if(mysqli_error($connect))
            {
                header("location:signin.php");
                return;    
            }
            else
            {
                    $select = mysqli_query($connect,"SELECT `user_id`,`user_first_name`, `user_last_name` FROM `user_info` where  user_email ='".$email."'");
                    if(mysqli_connect_error())
                    {
                        $_SESSION['signinmessage'] = "We Could Not Create Your Account, Try Again After Some Time.";
                        header("location:Signin.php");
                        return;
                    }
                    else
                    {
                        while($userinfo =mysqli_fetch_assoc($select))
                        {
                            $_SESSION['user_first_name'] = $userinfo['user_first_name'];
                            $_SESSION['user_last_name'] = $userinfo['user_last_name'];
                            $_SESSION['user_id'] = $userinfo['user_id'];    
                        }
                        header("location:index.php");
                        return;
                    } 
                header("location:signin.php");
            }
        }
        else
        {
            $_SESSION['signinmessage'] = "This Email is already Register.";
            header("location:signin.php");
            return;
        }
    }