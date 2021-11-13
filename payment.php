<?php 
     session_start();
      include("connection.php");
      include("functions.php");

    $pid = $_REQUEST['pay'];
    $uname = $_SESSION['user_name'];
    $pdate = date('y/m/d');

    $pprice = $_SESSION['pprice'];
    
    $sqry="SELECT * FROM ordertable WHERE p_id='$pid' AND CName='$uname' AND order_date='$pdate'";

    if(!($squ= mysqli_query($con,$sqry))){
        echo"Data retrival failed";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <title>SHOP WITH US</title>
    <link rel="stylesheet" href="paymentDes.css" />
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
        <table border="0" >
        <?php

            while( $row = mysqli_fetch_assoc($squ) ){ //this will not work if squ is changed
                echo"
            <tr height='100px'>
                <th width='400px'>ORDER ID</th>
                <td width='400px'>{$row['order_id']}</td>
            </tr>
            <tr height='100px'><th width='400px'>TOTAL PRICE</th><td>Rs.{$row['total']}.00</td></tr>
            <tr height='100px'><th width='400px'>ORDER DATE</th><td>{$row['order_date']}</td></tr>
            <tr height='400px' colspan='2'><td></td><td>Your Order is noted. You can proceed to pay acc.no.0122-3344-555543</td></tr>
                
                ";
            }

            if($_SERVER['REQUEST_METHOD'] == "POST")
        {
          $uname =$_SESSION['user_name'];
          $qry= " INSERT INTO ordertable (p_id,order_date,total,CName) VALUES ('$pid','$pdate','$pprice','$uname') ";
          mysqli_query($con, $qry);
        }
            
        ?>
  
        </table>
    </div>
          </section>
</body>
</html>
