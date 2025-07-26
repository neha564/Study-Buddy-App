<?php
$servername="localhost";
$username="root";
$password="";
$dbname="children";
//create connection
$con =mysqli_connect($servername,$username,$password,$dname);

//check connection

if(!$con)
{
    echo "failure";
    die("connection failed: " . mysqli_connect_error());
}
else{
    echo"connected successfully";
}
?>
