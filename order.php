<?php
    session_start();
    include('../../includes/database.php');
    $dbConnection = getDatabaseConnection('simple_pizza');
    
    //obtains all the information from the pizza table 
    function getPizzas()
    {
        global $dbConnection;
    
        $sql = "SELECT * FROM pizza";
        
         if(isset($_GET['orderBy']))
            $sql .= " ORDER BY ".$_GET['orderBy'];
        $statement = $dbConnection->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        return $records;
    }
    //obtains all the information from the drinks table 
    function getDrinks()
    {
        global $dbConnection;
        $sql = "SELECT *  FROM drinks";
        if(isset($_GET['orderBy']))
            $sql .= " ORDER BY ".$_GET['orderBy'];

        $statement = $dbConnection->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        return $records;
    }
    //obtains all the information from the appetizers table 
    function getAppetizer()
    {
        global $dbConnection;
       
            $sql = "SELECT * FROM appetizers";
            
            if(isset($_GET['orderBy']))
                $sql .= " ORDER BY ".$_GET['orderBy'];
            
        $statement = $dbConnection->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
        
    }
    //obtains all the information from the desserts table 
    function getDesserts()
    {
         global $dbConnection;
  
        $sql = "SELECT *  FROM desserts";
        
        if(isset($_GET['orderBy']))
            $sql .= " ORDER BY ".$_GET['orderBy'];
        
        $statement = $dbConnection->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
    }
    
function displayPizza()
{
    echo " <h1>Specialty Pizzas</h1>";
     /*$pizzas = getPizzas();
          echo "<table>";*/
                
     $pizzas = getPizzas();
     
     echo "<center>";
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
        echo"</br>";
        echo"<a  target = 'productInfoiFrame' href = 'productDescription.php?name=" .$item[]
            ]. "'>". 'Description'. "</a";
        
        echo"</td>";
        
        if($count == 1 && $count == 5)
            echo "</tr>";
        $count++;
    }
    echo"</table>";
    echo "<center>";
}
function displayAppetizers()
{
     echo "<h1>Appetizers</h1>";
            
     $appetizer = getAppetizer();
     echo "<center>";
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
    echo "<center>";
        
}
function displayDrinks()
{
    echo "Drinks:";
    $drinks = getDrinks();
    
    echo"<select>";
        foreach($drinks as $drink)
        {
            echo "<option value =".$drink['Name'].">".$drink['Name']."</option>";
        }
    echo"</select>";
}
function displayDesserts()
{
     echo "<h1>Desserts</h1>";
     $desserts = getDesserts();
     echo "<center>";
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
    echo "</center>";
}

?>
<!DOCTYPE html>
<html>
    <head>
       <title>Simple Pizza Order</title>
       
       <link href="login.css" rel="stylesheet" /> 
    </head>
    <body>
            
            <div class="bg">
        <h1> Simple Pizza </h1>
          </div>      
            
            
            
            <h2> Welcome To Simple Pizza, <?=$_SESSION['userName']?> !</h2>
            <h2>What Would You Be Ordering Today ?</h2>
            <form method = "get">
                
                
                <strong>Show: </strong>
                <input type = "radio" name = "sortBy" value = "Pizza"> Pizza
                <input type = "radio" name = "sortBy" value = "Drinks"> Drinks
                <input type = "radio" name = "sortBy" value = "Appetizer"> Appetizers
                <input type = "radio" name = "sortBy" value = "Desserts"> desserts
                </br></br>
                <strong>Order Results By: </strong> 
                <input type = "radio" name = "orderBy" value = "calories"> Calories
                <input type = "radio" name = "orderBy" value = "name"> Name
                </br></br>
                <input type ="submit"  name = "searchForm" value = "show results">
            </form>
            </br></br>
            <?php
                if(isset($_GET['sortBy']) && $_GET['sortBy'] == "Pizza")
                     displayPizza();
                 else if(isset($_GET['sortBy']) && $_GET['sortBy'] == "Drinks")
                    displayDrinks();
                else  if(isset($_GET['sortBy']) && $_GET['sortBy'] == "Appetizer")
                    displayAppetizers();
                else if(isset($_GET['sortBy']) && $_GET['sortBy'] == "Desserts")
                    displayDesserts();
                else if(empty($_GET['sortBy']) || !isset($_GET['sortBy']))
                {
                    displayPizza();
                    displayDrinks();
                    displayAppetizers();
                    displayDesserts();
                }
            ?>
            </br></br>
           <input type = "submit" value = "Add to cart">    
            <div style = "float:left">
            <iframe name = "productInfoiFrame" width = "250" height = "315"
            scr = "getProductInfo.php" frameborder = "1"></iframe>
        </div>
           
           
           
           
           
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