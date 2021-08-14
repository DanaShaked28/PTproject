<?php
    require_once('Include/init.php');
    
    session_start();

    $user_id=$session->user_id;
    $User=new User();
    $User->find_user_by_id($user_id); 

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

                               echo' <li><a class="navBtn" href="Reports.php?id='.$_GET['id'].'">Report</a></li>'
                                ;
                                echo' <li><a class="navBtn" href="Social.php?id='.$_GET['id'].'">Social</a></li>';
                                
                            }
                        }
                        if ($_SESSION['is_admin'] == 1){ #admin
                            echo '
                            <li><a class="navBtn" href="ManReports.php?id='.$_GET['id'].'">Manage Reports</a></li>
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
                    
                    <h2> About Us </h2> <br>
                    
                    <p> Domi is a free app for managing the shared building! <br><br>
                    
                    Both to the house committee, and to the tenants and also to the management companies! 
                    The app provides a comprehensive solution and meets all the needs of the House Committee in the
                    management of the building (finances, collection, tasks, voting votes, etc.) and thus facilitates
                    and streamlines the work of House Committee representatives. In addition, it provides a communication
                    infrastructure for all the building's occupants among themselves and of course with the House Committee,
                    allowing accessible and convenient access to reports and professional services.</p>
                    
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