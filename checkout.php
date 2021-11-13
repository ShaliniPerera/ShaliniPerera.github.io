<?php 
     session_start();

      include("connection.php");
      include("functions.php");
      check_login($con);

    $pid = $_REQUEST['buyid'];
    
    $sqry="SELECT * FROM product WHERE pID='$pid'";

    if(!($squ= mysqli_query($con,$sqry))){
        echo"Data retrival failed";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <title>SHOP WITH US</title>
    <link rel="stylesheet" href="checkoutDes.css" />
  </head>
  <body>

  <section >
      <nav>
        <div class="logo">
        <img src="images/logo2.png" width="500px" height="100px">
        </div>
        
        <div class="menu">
        <a href="home.php">Home</a>
          <a href="shop.php">Shop</a>
        </div>
        <div class="item">
          
          <?php
            if(!(isset($_SESSION['user_name']))){echo"
              <a href='login.php'><button class='btn' onclick='login.php'>Login</button>
              </a>";}
            else{echo"
              <a href='logout.php'><button class='btn' onclick='logout.php'>Log Out</button></a>";
              }
            ?>
          
        </div>
      </nav>
      <div class="table">
        <table border="1" >
            <tr height="100px">
                <th width="400px">PRODUCT NAME</th>
                <th width="400px">DATE</th>
                <th width="400px">PRODUCT PRICE</th>
            </tr>

        <?php
            while( $row = mysqli_fetch_assoc($squ) ){
                  $pname=$row['pName'];
                  $pprice=$row['pPrice'];
                  $pdate= date("y/m/d");
                  $pid = $row['pID'];
                  
                  $_SESSION['pprice']=$pprice;

                echo" <tr height='100px'><td>$pname</td><td>$pdate</td><td>Rs.$pprice.00</td></tr>              
                
                <tr>
                <td><button onclick= document.location='shop.php'> Go Back </button></td><td></td>
                <td><form action='http://localhost/legends/payment.php' method='POST'>
                  <button type='submit' name='pay' value='{$row['pID']}' > Buy </button></form></td>    
            </tr>
                
                ";
            }

        ?>
        
            <td>
            </td>

        </table>
    </div>
    </section>

  </body>
</html>
