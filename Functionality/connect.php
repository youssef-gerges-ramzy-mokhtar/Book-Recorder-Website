<?php
// This File is used to connect to the DataBase

$serverName = "mysql";
$userName = "22lzusr007";
$password = "HQAZSWLUC58";
$db = "22lzdb007";

$conn = mysqli_connect($serverName, $userName, $password, $db);

if ($conn->connect_error) {
   die("Connection failed: Please Try Again Later");
}


?>