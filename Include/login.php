<?php

//require_once('init.php');
require('database.php');

if (isset($_POST['submit'])){
    
    
    $Username=$_POST['Username'];
    $Password=$_POST['Password'];
    
    if (empty($Username) || empty($Password)){
        header("Location: ../index.php?error=emptyfields&username=".$Username);
        exit();
    } 
    else{
        
        $result = $database->query("select * from Users where Username = '".$Username."'");
        
        if(!$result){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        
        else{
            
            if($result->num_rows>0){
                $found=$result->fetch_assoc();
                
                if($Password != $found['Password']){
                    header("Location: ../index.php?error=wrongpassword&username=".$Username);
                    exit();
                }
                elseif ($Password == $found['Password']){
                    session_start();
                    $_SESSION['user_id'] = $found['user_id'];
                    $_SESSION['Username'] = $found['Username'];
                    $_SESSION['is_admin'] = $found['Admin'];
                    
                    header("Location: ../index.php?id=".$found['user_id']);
                    exit();
                    
                }
                else{
                    header("Location: ../index.php?error=wrongpassword&username=".$Username);
                    exit();
                }
            } 
            else{
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }
}
else{
    header("Location: ../index.php");
    exit();
    
}

?>