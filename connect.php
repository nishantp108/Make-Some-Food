<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "make_some_food";

$connect = mysqli_connect($servername, $username, $password, $dbname);
if(mysqli_connect_error())
{
    echo "Error While Connecting";
}
?>