<?php
    require_once('Include/init.php');
    
    //session_start();

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
                    echo 'You are logged out. Please sign in.';
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
                    
                <div  style="width:100%">
                    
                    <h2> All Tenants </h2> <br>
                    
                    <div class="container">
                        
                        <?php
                        
                        if (isset($_SESSION['user_id'])){
                            if ($_SESSION['is_admin'] == 1){#Admin
                            
                            echo '<table>
                                <tr>
                                    <th> User ID</th>
                                    <th> Name</th>
                                    <th> Last Name</th>
                                    <th> Email</th>
                                    <th> Apt. no.</th>
                                    <th> Username</th>
                                    <th> Password</th>
                                    <th> Admin</th>
                                </tr>
                                ';
                            
                            $result=$database->query("SELECT * FROM Users");
                            
                            if ($result->num_rows>0){
                                while($row=$result->fetch_assoc()){
                                    
                                   echo'
                                        <tr>
                                            <td> '.$row['user_id'].'</td>
                                            <td> '.$row['Name'].'</td>
                                            <td> '.$row['LastName'].'</td>
                                            <td> '.$row['Email'].'</td>
                                            <td> '.$row['AptNo'].'</td>
                                            <td> '.$row['Username'].'</td>
                                            <td> '.$row['Password'].'</td>';
                                             
                                            if ($row['Admin'] == 1){
                                                echo '<td>Yes</td>';
                                                
                                            }
                                            elseif($row['Admin'] == 0){
                                                echo '<td>No</td>';
                                                
                                            }
                                       echo '</tr>';
                                        
                                       

                                }
                                echo  '</table>';
                            }
                            else
                              echo "No data found";
                                
                            }
                        }

                        
                        ?>
                      
                    </div>

                <br>
                    
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