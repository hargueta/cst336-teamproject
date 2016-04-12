<?php
session_start();

include ("../includes/database.php");


$connection = getDatabaseConnection('simple_pizza');

function getUserId(){
    global $connection;
    global $userId;
    $username = $_SESSION['username'];
    
    $sql = "SELECT userId FROM users WHERE username='".$username."'";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $userId = $statement->fetch();
    return $userId;
    
    print_r($userId);
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

function getProducts(){
    global $connection;
    global $userId;
    
    $sql = "SELECT * FROM users WHERE userId='".$userId."' limit 1";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $record = $statement->fetchAll(PDO::FETCH_ASSOC);
    if($record['pizzaId']!=0){
        $sql = "SELECT name, price FROM `order` o JOIN `pizza` p on o.pizzaId=p.pizzaId WHERE userId='".$userId."' limit 1";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $record = $statement->fetch();
        echo $record['name'] . " $" .$record['price'] . "<br />";
    }
    if($record['appetizer']!=0){
        $sql = "SELECT name,price FROM `order` o JOIN `appetizers` p on o.pizzaId=p.appetizerId WHERE userId='".$userId."' limit 1";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $record = $statement->fetch();
        echo $record['name'] . " $" .$record['price'] . "<br />";
    }
    if($record['drink']!=0){
        $sql = "SELECT Name,price FROM `order` o JOIN `drinks` p on o.drirnkId=p.drinkId WHERE userId='".$userId."' limit 1";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $record = $statement->fetch();
        echo $record['Name'] . " $" .$record['price'] . "<br />";
    }
    if($record['desserts']!=0){
        $sql = "SELECT name,price FROM `order` o JOIN `desserts` d on o.dessertId=d.desertId WHERE userId='".$userId."' limit 1";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $record = $statement->fetch();
        echo $record['name'] . " $" .$record['price'] . "<br />";
    }
}
function getTotal()
{
    global $userId;
    global $connection;
        

    $sql = "SELECT total FROM `order` WHERE userId='". $userId."'";

    $statement = $connection->prepare($sql);
    $statement->execute();
    $records = $statement->fetch();
    
    echo $records['total'];
}
function getTax(){
    global $userId;
    global $connection;
        
    $sql = "SELECT total FROM `order` WHERE userId='" . $userId. "'";

    $statement = $connection->prepare($sql);
    $statement->execute();
    $records = $statement->fetch();
    
    $tax = $records['total'] * .10;
    echo $tax;

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
            //$pizzaitems = $_SESSION['cart'];
             //   print_r($pizzaitems);
        ?>
     
        <br/>
        <br />
        <?=getProducts()?>
       
        Tax(10%): $<?=getTax()?>
        <br/>
        Total: $<?=getTotal()?>
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