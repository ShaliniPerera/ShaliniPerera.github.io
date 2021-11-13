
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>LOG IN</title>
    <link rel="stylesheet" href="log_in.css" />
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

      <div class="loginbox">
        <img src="images/profile.jpg" class="avatar" />
        <h1>Login Here</h1>

        <form method="post">
            
          <p>Username</p>
          <br><br>
          <input type="text" name="user_name" placeholder="Enter Username" /><br><br>
          
          <p>Password</p><br><br>
          <input type="password" name="password" placeholder="Enter Password" /><br><br>
          
          <input type="submit" name="" value="Log In" /><br />
          
          <?php 
                session_start();

                    include("connection.php");
                    include("functions.php");

                    if($_SERVER['REQUEST_METHOD'] == "POST")
                    {
                        //something was posted
                        $user_name = $_POST['user_name'];
                        $password = ($_POST['password']);

                        if(!empty($user_name) && !empty($password) )
                        {
                            //read from database
                            $query = "select * from user where user_name = '$user_name' limit 1";
                            $result = mysqli_query($con, $query);

                            if($result)
                            {
                                if($result && mysqli_num_rows($result) > 0)
                                {
                                    $user_data = mysqli_fetch_assoc($result);
                                    
                                    if($user_data['password'] == $password)
                                    {
                                        $_SESSION['user_name'] = $user_data['user_name'];
                                        header("Location: home.php");
                                        die;
                                    }
                                }
                            }                            
                            echo "wrong username or password!";
                        }else
                        {
                            echo "wrong username or password!";
                        }                        
                    }                   
                ?>
 
<br>
        </form>
      </div>
  
    </body>
  </html>

  <head>
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="login.css" />
  </head>

  <body></body>
</html>
