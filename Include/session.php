<?php
  
require_once('init.php');

class Session{
    private $signed_in;
    private $user_id;
    
    

    public function __construct(){
        session_start();
        $this->check_login();
    }
    
     private function check_login(){
        if (isset($_SESSION['user_id'])){
            $this->user_id=$_SESSION['user_id'];
            $this->signed_in=true;
        }
        else{
            unset($this->user_id);
            $this->signed_in=false;
        }
    }
    
    public function login($User){
        if($User){
            $this->user_id=$User->get_user_id();
            $_SESSION['user_id']=$User->get_user_id();
            $this->signed_in=true;
        }
    }
    
       
    public function logout(){
        echo 'logout';
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in=false;
        
    }
    
    public function __get($property){
        if (property_exists($this,$property))
            return $this->$property;
    }
     
}
$session=new Session();


    
?>

