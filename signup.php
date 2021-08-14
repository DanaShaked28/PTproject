<?php 

	require_once('Include/init.php');
	
        
        function function_alert($msg) {
            echo "<script type='text/javascript'>alert('$msg');
            window.location.href='index.php';
            </script>";
            
        }

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            $Name=$_POST['Name'];
            $LastName=$_POST['LastName'];
            $Email=$_POST['Email'];
            $AptNo=$_POST['AptNo'];
            $Username=$_POST['Username'];
            $Password=$_POST['Password'];
            $Admin=$_POST['Admin'];
            
            if(empty($Name) || empty($LastName) || empty($Email) || empty($AptNo) || empty($Username) || empty($Password)){
            header("Location: signup.php?signuperror=emptyfields&Username=".$Username."&Email=".$Email);
            exit(); 
            }
            elseif(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
                header("Location: signup.php?signuperror=invalidmail&name=".$Name);
                exit(); 
            }
            
              
            $User = new User();
                    
            $exist = $User->find_username($Username);
                    
            if($exist == 1){
                header("Location: signup.php?signuperror=existusername&Username=".$Username);
                exit();
            }
    
            //validation

            else{
                $User = new User();
                
                $result = $User->add_User($user_id, $Name, $LastName, $Email, $AptNo, $Username, $Password, $Admin);

                if ($result == 'User Was Added Successfully'){
                
                function_alert("Thank You For Signing Up! You will Now Be Redirected to Log In Page...");
                    
                }
           }
        }

?> 

<!DOCTYPE html>
<html>
<head><meta charset="shift_jis">
	<title>Signup</title>
    
     <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="html/JS/jquery-3.5.1.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="CSS/myStyle.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    

</head>
<body>
    
    <header>
    <div id="indexWrapper">
              <a href="index.php?id=<?php $_SESSION['user_id'] ?>"><img src="logo.png"/></a>  
    </div>
    </header>
    
    <div id="wrapper">
        <div id="internalWrapper">
            
            <main> 
                <h2>Sign Up</h2>

                <form method="POST">

                  <div class="container">
                      
                      <?php
                            if(isset($_GET['signuperror'])){
                                if ($_GET['signuperror'] == "existusername"){
                                    echo '<p class="error">Username Already Exist. Please Choose Another</p>';
                                }
                                elseif ($_GET['signuperror'] == "invalidmail"){
                                    echo '<p class="error">Email is invalid. Please try again.</p>';
                                }
                            }

                      ?>
                      
                    <label for="Name"><b>Name:</b></label>
                    <input type="text" name="Name">
                    <br><br>
                    
                    <label for="LastName"><b>Last Name:</b></label>
                    <input type="text" name="LastName">
                    <br><br>
                    
                    <label for="Email"><b>Email:</b></label>
                    <input type="text" name="Email" placeholder="me@gmail.com">
                    <br><br>

                    <label for="AptNo"><b>Apartment No.:</b></label>
                    <input type="text" name="AptNo">
                    <br><br>

                    <label for="Username"><b>Username:</b></label>
                    <input type="text" name="Username">
                    <br><br>

                    <label for="Password"><b>Choose Password:</b></label>
                    <input type="password" name="Password">
                    <br><br>

                    <label for="Admin" required><b>I Am a: </b></label><br>
                    <input id="Admin" type="radio" name="Admin" value="0" required>
                    <label for="Resident"> Resident</label><br>
                    <input id="Admin" type="radio" name="Admin" value="1">
                    <label for="Board"> Board Member</label><br><br>
                
                    <input id="enter" type="submit" value="Sign Up">
                    
                  </div>

                  <div class="container" style="background-color:#f1f1f1">
                      <a id="enter" href="index.php">Click here to Login</a>
                  </div>

                </form>

            </main>
        </div>
    </div>
    
    <div id="clear"></div>
  
</body>
</html>