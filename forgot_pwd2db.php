<?php
    if(isset($_POST['otpsend']))
    {
        require("connect.php");
        session_start();

        $email = $_SESSION['email'];        
        $user_otp = $_POST['otp'];
        $select = mysqli_query($connect,"SELECT * FROM otp_table WHERE user_email='".$email."'");
        if(mysqli_error($connect))
        {
            echo "error while fetching";
        }
        if(mysqli_num_rows($select) != 0)
        {
            $otptable = mysqli_fetch_assoc($select);
            $otp = $otptable['otp'];
            if($user_otp == $otp)
            {
                header("location:Forgot_PWD3.php");
            }
            else
		    {
                $_SESSION['otpmessage'] = "OTP is wrong.";
                header("location:Forgot_pwd2.php");
                return;
		    }
        }
    }