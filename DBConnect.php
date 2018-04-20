<?php

$servername = "localhost";
$username = "root";
$password1 = "";
$dbname = "mydb1";


try 
{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password1);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>