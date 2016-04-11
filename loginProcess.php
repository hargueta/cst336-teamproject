<?php
session_start();

include ("../includes/database.php");

$connection = getDatabaseConnection('simple_pizza');

$username = $_POST['username'];
$password = sha1($_POST['password']);  //hash("sha1", $_POST['password');

$sql = "SELECT * 
        FROM users
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
    $_SESSION['userName'] = $result['firstName'];
    
    header("Location: order.php");
    
}



?>