<?php
    if(isset($_POST['pwdsubmit']))
    {
        $password = $_POST['password'];
        $cpassword=$_POST['cpassword'];
        session_start();
        $email = $_SESSION['email'];
        if($password == $cpassword)
        {
            require("connect.php");
            $result = mysqli_query($connect,"UPDATE `user_info` SET `user_password`='$cpassword' WHERE `user_email`='".$email."'");
            header("location:Signin.php");
        }
        else
        {
            $_SESSION['passwordmessage'] = "Both Password Does Not Match.";
            //echo $_SESSION['passwordmessage'];
            header("location:Forgot_pwd3.php");
            return;
        } 
    }