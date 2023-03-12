<?php
    if(isset($_POST['submit']))
    {
        $hostname ="localhost";
        $username = "root";
        $password= "";
        $dbname = "make_some_food";

        $connect = mysqli_connect($hostname,$username,$password,$dbname);
        if(mysqli_connect_error())
        {
            echo "Error While Connecting";
            //header("location:contactus.php");
        }
        else
        {
            $name = $_POST['username'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $insert = mysqli_query($connect,"INSERT INTO `feedback`(`user_name`, `email`, `feedback`) VALUES ('$name','$email','$message')");
            if(mysqli_error($connect))
            {
                echo "Error While Inserting";
                //header("location:contactus.php");
            }
            else
            {
                //session_start();
                //$_SEESION['flag'] = "true"; 
                echo '<script>alert("Thanks For Your Feedback.");</script>';   
              
                echo '<script>window.location = "contactus.php";</script>"';
                 
            }
        }
    }
?>