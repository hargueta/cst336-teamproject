<?php
session_start();
include ("../../includes/database.php");

$connection = getDatabaseConnection('simple_pizza');

function getUserId(){
    global $connection;
    global $userId;
    
    $sql = "SELECT usernameId FROM users WHERE username='".$_SESSION['username']."'";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $userId = $statement->fetch();
    return $userId;
}

function getPizza()
{
    return $_GET('pizza');
}

function getDrinks()
{
    return $_GET('drinks');
}

function getApps()
{
    return $_GET('apps');
}


function getDesserts()
{
    return $_GET('desserts');
}

function confirmationNum()
{
    $num = "";
    
    
    for($i = 0; $i<9; $i++)
    {
        $rand = rand(0,9);
        $num = $num . $rand;
    }
    
    
    return $num;
}


function getOrder()
{
    
    
    
    
}


function getTotal()
{
    global $userId;
    global $connection;
        
    $sql = "SELECT total FROM `order` WHERE userId='" . $userId. "'";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    return $records;
}
function getTax(){
    global $userId;
    global $connection;
        
    $sql = "SELECT total FROM `order` WHERE userId='" . $userId. "'";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $records = $statement->fetch();
    
    $records = $records * .10;
    return $records;

}

?>

<!DOCTYPE html>
<html>
    
    
    <head>
       <title>Simple Pizza</title>
       
       <link href="login.css" rel="stylesheet" /> 
    </head>
     
   
    <body>
<div class="bg">
        <h1> Simple Pizza </h1>
  </div>      
     
   
        <h2> Thank you! </h2>
        <h3> Here is your summary: </h3>
        
        <?php
            $pizzaitems = $_SESSION['cart'];
                print_r($pizzaitems);
        ?>
           
        Quantity </t> Product </> Price
        <br/>
       
        Tax(10%): <?=getTax()?>
        <br/>
        Total: <?=getTotal()?>
        <br/>
        
        Confirmation # <?=confirmationNum()
        ?>

    
    <br/><br/><br/><br/><br/><br/><br/>
     <hr>
    <footer>
        
        &copy; Simple Pizza, 2016. <br/>
        Disclaimer: Prices and availabilty are subject to change.
        <br />
        

    <br />
    <img src="img/slice.png" height="52" width="52" alt= "pizza logo"/>
    </footer>
    
    </body>
    
    
</html>