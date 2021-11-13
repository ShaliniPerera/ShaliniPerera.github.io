<?php 
     session_start();
      include("connection.php");
      include("functions.php");

      $sqry="SELECT * FROM product ";

        if(!($squ= mysqli_query($con,$sqry))){
            echo"Data retrival failed";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SHOP WITH US</title>
    <link rel="stylesheet" href="shopDes.css" />    
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
                <?php
                    while( $row = mysqli_fetch_assoc($squ) ){
                        echo" <tr><td >                   
                        <img src='{$row['pImg']}' height='180px' width='320px' />                   
                    </td>
                    <td width='900px' ><div id='itm1'>{$row['pName']}</div>
                    <p id='itmdes'>{$row['pDesc']}</p>
                    <div id='price'>Rs.{$row['pPrice']}/=</div></td>
                    <td width='250px'>
                     <form action='http://localhost/legends/checkout.php' method='POST'>
                      <button name='buyid' type='submit' value='{$row['pID']}' >Buy Now </button>
                    </form></td></tr> ";
                    }
                ?>    
                            
        </table>
    </div>
  </section>

  </body>
</html>
