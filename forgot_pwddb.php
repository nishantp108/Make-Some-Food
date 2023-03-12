<?php
	session_start(); 
    if(isset($_POST['sendotp']))
    {
        	require("connect.php");
        	$email = $_POST['email'];
		$select = mysqli_query($connect,"SELECT user_first_name,user_last_name FROM user_info WHERE user_email='".$email."'");
		
       /* if(mysqli_error($select))
        {
            echo "Error While Fetching";
        }*/
        if(mysqli_num_rows($select) !=0)
        {
            $_SESSION['email'] = $email;
           
            while($selectstatmentarray = mysqli_fetch_assoc($select))
	        {
		        $firstname = $selectstatmentarray['user_first_name'];
		        $lastname = $selectstatmentarray['user_last_name']; 
	        }
		}
		else
		{
			$_SESSION['forgotpasswordmessage'] = "This Email is not Registered.";
            	header("location:Forgot_PWD.php");
            	return;
		}
        $subject = "Email Verification";
        $pin = genratepin();
        $body = "<html><head></head><body>Dear, ".$firstname." ".$lastname." Your request has been received,<br><br>Your One Time Password(OTP) is ".$pin."<br><br> Please enter this OTP to our designed screen for password changing. <br><br> Thank You, <br><br> -- Team Make Some Food &reg;</body></html>";
        $sendmail = mailsender($email,$subject,$body,$connect,$pin);
		$session['flag'] = true;
		
		$_SESSION['forgotpwd'] = "true";
        header("location:Forgot_PWD2.php");
}
function genratepin($l=4)
{
	$i = 0;
	$pin ="";
	while($i<$l)
	{
		$pin.=mt_rand(1,9);
		$i++;
	}
	return $pin;
}

function mailsender($email, $subject, $body,$connect,$pin)
	{
		require_once 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		
	// SMTP configuration
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';                      // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'makesomefoodwebsite@gmail.com';                    // SMTP username
	$mail->Password = 'makesomefood';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;   


	$mail->setFrom('makesomefoodwebsite@gmail.com', 'Make Some Food');
	$mail->addReplyTo('makesomefoodwebsite@gmail.com', 'Make Some Food');

	// Add a recipient
	$mail->addAddress($email);

	$mail->Subject= $subject;

	$mail->Body = $body;

	// Set email format to HTML
	$mail->isHTML(true);

	// Send email
	if(!$mail->send()){
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
	else
	{
		$deletestatment = mysqli_query($connect,"DELETE from otp_table WHERE user_email='".$email."'");
        $insertstatment = mysqli_query($connect,"INSERT INTO `otp_table`(`user_email`, `otp`) VALUES ('".$email."',".$pin.")");
        
		if(mysqli_connect_error())
		{
			$_SESSION['forgotmessage'] = "Try Again.";
		}
		
		$_SESSION['temp_email'] = $email;//$email;
		
	}

}