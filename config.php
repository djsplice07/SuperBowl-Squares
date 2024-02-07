<!-- 
www.vnlisting.com
Online Super Bowl Squares Script
Please read the "Readme.txt for license agreement, installtion and usage instructions 
-->

<?php

//make changes accordingly to your database
$hostname = "DB_HOSTNAME";
$database = "DB_NAME";
$username = "USERNAME";
$password = "P4SSW0RD";
$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}

?>
