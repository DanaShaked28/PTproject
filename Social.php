<?php
    require_once('Include/init.php');
    
    session_start();

    $user_id=$session->user_id;
    $User=new User();
    $User->find_user_by_id($user_id); 
    
    if (isset($_POST['submit-social'])){
        
        $social=$_POST['social'];
        
        echo var_dump($social);
        
         if($social=='https://www.facebook.com/'){

             window.location.replace("https://www.facebook.com/");
             exit();
         }
    }

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Domi</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" type="text/css" href="CSS/myStyle.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <script>
            function log_out(){
                window.location='logout.php';
            }
        </script>

    </head>
    <body>
        <header>
            
            <div id="indexWrapper">
              <a href="index.php?id=<?php $_SESSION['user_id'] ?>"><img src="logo.png"/></a>  
            </div>


        </header>
        
        
        <div id="logs">
         
            <?php
            
                echo 'Hello ';
            
                if (isset($_SESSION['user_id'])){
                    
                    $User=new User();
                    $error=$User->find_user_by_id($_SESSION['user_id']);
                    if (!$error){
                        $session->login($User);
                    }
                    else{
                    echo 'window.alert($error)';
                    }
                
                    echo $User->get_name();
                    echo '!';
                }
                else{
                    echo 'Guest! <br>';
                    echo 'You are logged out. Please sign in below.';
                }
                
            ?>


            <?php
                if ($session->signed_in){
                    echo '<button id="enter" onclick="log_out()">Log-out</button>';
                }
            ?>

        </div>
        <main>
        <div id="wrapper">
            <div id="internalWrapper">
                

                <?php
                if (isset($_SESSION['user_id'])){
                    echo '
                    <ul> ';
                       echo' <li><a class="navBtn" href="index.php?id='.$_SESSION['user_id'].'">Home</a></li>';
                      
                        ;
                        if ($_SESSION['is_admin'] == 0){ #not admin
                            if (isset($_GET['id']) && !empty($_GET['id'])){
                                 echo' <li><a class="navBtn" href="Services.php?id='.$_GET['id'].'">Services</a></li>';
                                echo '
                                <li><a class="navBtn" href="Payments.php?id='.$_GET['id'].'">Payments</a></li>';
                               echo' <li><a class="navBtn" href="Reports.php?id='.$_GET['id'].'">Report</a></li>'
                                ;
                                echo' <li><a class="navBtn" href="Social.php?id='.$_GET['id'].'">Social</a></li>';
                                 echo' <li><a class="navBtn" href="Social.php?social=https://www.facebook.com/&id='.$_GET['id'].'">facebook</a></li>';
                                
                            }
                        }
                        if ($_SESSION['is_admin'] == 1){ #admin
                            echo '
                            <li><a class="navBtn" href="ManReports.php?id='.$_GET['id'].'">Manage Reports</a></li>
                            <li><a class="navBtn" href="ManPayments.php?id='.$_GET['id'].'">Manage Payments</a></li>
                            <li><a class="navBtn" href="ManTenants.php?id='.$_GET['id'].'">Manage Tenants</a></li>
                            ';
                        }
                        echo '</ul>
                        ';
                }
                else{
                    echo '<h2>Welcome to Domi</h2>';
                }
                ?>
                    
                <br>
                    
                <div id="wrapper">
                    
                <div id="about">
                    
                    <h2> Our Social </h2> <br>
                    
                    <p>Visit Our Social Media Pages!</p>
                    
                    <form method="post" style="padding: 2%;">
                        
                     <label for="Social">Choose a Social App To Redirect To:</label><br>
                      
                     <input type="radio" id="Facebook" name="Social" value="Facebook">
                     <img class="social" src="Images/Fac.png">
                     <label for="Facebook">Facebook</label><br>
                     <input type="radio" id="Instagram" name="Social" value="Instagram">
                     <img class="social" src="Images/Ins.png">
                     <label for="Instagram">Instagram</label><br>
                     <input type="radio" id="Twitter" name="Social" value="Twitter">
                     <img class="social" src="Images/Twi.png">
                     <label for="Twitter">Twitter</label>                      

                      <br><br>
                      <button type="submit-social" value="submit-social" name="submit-social" id="enter"><b>Take me there!</b></button>
                      
                    </form>

                    <br>
                    

                </div>
                    
                <div id="login">
 
                <?php
                
                    $user_id = $_GET['id'];
                    
                    if($user_id != 0)
                    {
                        $User=new User();
                        $result = $User->find_user_by_id($_GET['id']);
                        
                        if($_SESSION['is_admin'] == 1){
                            $admin = 'Board Member';
                        }
                        elseif($_SESSION['is_admin'] == 0){
                            $admin = 'Resident';
                        }
                        
                        echo '<h2>Your Account</h2><br>';
                        echo '
                        <p class="info">
                        User ID: '. $User->get_user_id().' <br>
                        Full Name: '. $User->get_name() .' '. $User->get_lastName(). '</br>
                        E-mail: '. $User->get_email() .'</br>
                        Username: '. $User->get_username() .'<br>
                        Password: '. $User->get_Password() .'<br>
                        Type: '.$admin .'
                        </p>';

                    }
                

                    if($session->signed_in){
                        echo '';
                    }
                    else{
                        
                        echo '
                            
                        <h2>Log In</h2>
                    
                        <p style="text-align:center"> Please sign in to your account or register </p>
                        
                        
                        
                        <form action="Include/login.php" method="post">
                    
                          <div class="container">';
                          
                            if(isset($_GET['error'])){
                                if ($_GET['error'] == "emptyfields"){
                                    echo '<p class="error">Please fill in all fields!</p>';
                                } elseif ($_GET['error'] == "wrongpassword"){
                                    echo '<p class="error">Wrong password!</p>';
                                }elseif ($_GET['error'] == "nouser"){
                                    echo '<p class="error">User doesn\'t exist!</p>';
                                }
                            }
                            
                           echo' <label for="Username"><b>Username:</b></label>
                            <input type="text" placeholder="Enter Username" name="Username" value="'.$_GET['Username'].'">
        
                            <label for="password"><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="Password"><br><br>
        
                            <button type="submit" value="submit" name="submit" id="enter">Login</button>
                          </div>
        
                          <div class="container" style="background-color:#f1f1f1">
                              <a id="enter" href="signup.php">Click here to Sign Up</a>
                          </div>
    
                        </form>
                        
                        ';

                    }
                    
                ?> 
                    


                </div>
                

            </div>
               
            </div>
        </div>
        </main>
        
            <div id="clear"></div>
            <footer>
                <img class="social" src="Images/f.png">
                <img class="social" src="Images/i.png">
                <img class="social" src="Images/e.png">
                <img class="social" src="Images/m.png">
                <br>
                
                <p>Domi</p>
            </footer>

    </body>
</html>