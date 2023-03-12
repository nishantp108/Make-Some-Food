<?php
    if(isset($_POST['submit']))
    {
        session_start();
        $firstname = $_POST['fname'];
        $lastname = $_POST['lname'];
        $email = $_POST['email'];
        $PWD = $_POST['password'];

        require("connect.php");
        $select = mysqli_query($connect,"SELECT `user_id` FROM `user_info` WHERE `user_email`='".$email."'");
        if(mysqli_num_rows($select) == 0)
        {       
            $insert = mysqli_query($connect,"INSERT INTO `user_info`(`user_first_name`, `user_last_name`, `user_email`, `user_password`) VALUES('$firstname','$lastname','$email','$PWD')");
           $selectemail = mysqli_query($connect,"SELECT `user_id` FROM `user_info` WHERE `user_email`='".$email."'");
            if(mysqli_num_rows($selectemail)!=0)
            {
                $selectemailarray = mysqli_fetch_assoc($selectemail);
                $admin_user_id = $selectemailarray['user_id'];
                    $insertadmin = mysqli_query($connect,"INSERT INTO `admin_info`(`user_id`,`admin_first_name`, `admin_last_name`, `admin_email`, `admin_password`) VALUES ($admin_user_id,'$firstname','$lastname','$email','$PWD')");
                    if(mysqli_error($connect))
                    {
                        header("location:create.php");
                        return; 
                    }
                    else
                    {
                            $select = mysqli_query($connect,"SELECT `user_id`,`user_first_name`, `user_last_name` FROM `user_info` where  user_email ='".$email."'");

                            if(mysqli_connect_error())
                            {
                                $_SESSION['signinmessage'] = "We Could Not Create Your Account, Try Again After Some Time.";
                                header("location:create.php");
                                return;
                            }
                            else
                            {
                                $_SESSION['donemessage'] = "Account Created Sucessfully.";
                                header("location:create.php");
                                return;
                            } 
                    }
            }
            else
            {
                header("location:create.php");
                return;
            }
        }
        else
        {
            $_SESSION['signinmessage'] = "This Email is already Register.";
            header("location:create.php");
            return;
        }
    }
    