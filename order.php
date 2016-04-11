<?php
    session_start();
    include('../../includes/database.php');
    $dbConnection = getDatabaseConnection('simple_pizza');
    
    function getPizzas()
    {
        global $dbConnection;
    
        $sql = "SELECT name  FROM pizza";
        $statement = $dbConnection->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        return $records;
    }
    function getDrinks()
    {
        global $dbConnection;
    
        $sql = "SELECT name  FROM drinks";
        $statement = $dbConnection->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        return $records;
    }
    function getAppetizer()
    {
        global $dbConnection;
    
        $sql = "SELECT name  FROM appetizers";
        $statement = $dbConnection->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        return $records;
    }
    function getDesserts()
    {
         global $dbConnection;
    
        $sql = "SELECT name  FROM desserts";
        $statement = $dbConnection->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        return $records;
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Simple Pizza Order </title>
    </head>
    <body>
            <h1> Welcome To Simple Pizza <?=$_SESSION['userName']?></h1>
            <h2>What Would You Be Ordering Today ?</h2>
            
            Filter by: 
            <input type = "radio" name = "sortBy" value = "Pizza"> Pizza
            <input type = "radio" name = "sortBy" value = "Drinks"> Drinks
            <input type = "radio" name = "sortBy" value = "Appetizer"> Appetizers
            <h1>Specialty Pizzas</h1>
            <?php
                 $pizzas = getPizzas();
                 echo "<table>";
                
                $count  =0;
                 foreach($pizzas as $item)
                {
                   
                    if($count == 0 || $count == 5)
                        echo "<tr>";
                    
                    echo"<td>";
                    echo "<img src = 'img/".$item['name'].".jpg' width = 100 alt = 'picture of a pizza'>";
                    echo"</br>";
                    echo "<input type ='radio' value = ".$item['name']." name = pizza>".$item['name'];
                    echo"</td>";
                    
                    if($count == 1 && $count == 5)
                        echo "</tr>";
                    $count++;
                }
                echo"</table>";
            ?>
            Drinks
            <select>
                <?php
                    $drinks = getDrinks();
                    foreach($drinks as $drink)
                    {
                        echo "<option value = ".$drink['name']." >".$drink['name']."</option>";
                    }
                ?>
            </select>
            <h1>Appetizers</h1>
            
             <?php
                 $appetizer = getAppetizer();
                 echo "<table>";
                
                $count  =0;
                 foreach($appetizer as $item)
                {
                      
                    echo"<td>";
                    echo "<img src = 'img/".$item['name'].".jpg' width = 100 alt = 'picture of a appetizers'>";
                    echo"</br>";
                    echo "<input type ='checkbox' value = ".$item['name'].">".$item['name'];
                    echo"</td>";
                    
                    $count++;
                }
                echo"</table>";
            ?>
            <h1>Desserts</h1>
             <?php
                 $desserts = getDesserts();
                 echo "<table>";
                
                $count  =16;
                 foreach($desserts as $item)
                {
                      
                    echo"<td>";
                    echo "<img src = 'img/".$item['name'].".jpg' width = 100 alt = 'picture of a appetizers'>";
                    echo"</br>";
                    echo "<input type ='checkbox' value = ".$item['name'].">".$item['name'];
                    echo"</td>";
                    
                    $count++;
                }
                echo"</table>";
            ?>   
           <input type = "submit" value = "submit">    
           
    </body>
</html>