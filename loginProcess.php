<?php
session_start();

include ("../includes/database.php");

$connection = getDatabaseConnection('otter_express');

$username = $_POST['username'];
$password = sha1($_POST['password']);  //hash("sha1", $_POST['password');

$sql = "SELECT * 
        FROM admin
        WHERE username = '$username' 
        AND password = '$password'"; //Not preventing SQL injection!

$sql = "SELECT * 
        FROM admin
        WHERE username = :username 
        AND password = :password";        
$namedParameters = array();
$namedParameters[':username'] = $username;
$namedParameters[':password'] = $password;
$statement = $connection->prepare($sql);
$statement->execute($namedParameters);
$result = $statement->fetch(PDO::FETCH_ASSOC);

//print_r($result);

if (empty ($result)) {
    //the username or password were wrong
    echo "Wrong username/password!";
} else {
    
    $_SESSION['username'] = $username;
    $_SESSION['adminName'] = $result['firstName'] . "  " . $result['lastName'];
    
    //header("Location: admin.php");
    
}



?>