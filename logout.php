<?php 
include("validuser.php");
session_unset();
session_destroy();
header("location:signin.php");
?>