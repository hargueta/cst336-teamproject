<?php

include('includes/database.php');

function getProductInfo()
{
   $dbConnection = getDatabaseConnection('simple_pizza');
   
   $sql = "SELECT description 
           FROM pizza
           WHERE pizzaId = :pizzaId";
   $namedParameters = array(":pizzaId"=>$_GET['pizzaId']);
   $statement =  $dbConnection->prepare($sql);
   $statement->execute($namedParameters);
   
   return $statement->fetch(PDO::FETCH_ASSOC);
  
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

        <?php
        
        $productInfo = getProductInfo();
        echo $productInfo['description'];
        
        
        ?>

    </body>
</html>