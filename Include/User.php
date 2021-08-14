<?php
    require('database.php');

    class User{

        private $user_id;
        private $Name;
        private $LastName;
        private $Email;
        private $AptNo;
        private $Username;
        private $Password;
        private $Admin;
        
        
    public function get_user_id(){
        return $this->user_id;
    }
    public function get_Name(){
        return $this->Name;
    }
    public function get_LastName(){
        return $this->LastName;
    }
    public function get_Email(){
        return $this->Email;
    }
    public function get_AptNo(){
        return $this->AptNo;
    }
    public function get_Username(){
        return $this->Username;
    }
    public function get_Password(){
        return $this->Password;
    } 
    public function get_Admin(){
        return $this->Admin;
    }
    
        
    private function has_attribute($attribute){
        $object_properties=get_object_vars($this);
            return array_key_exists($attribute,$object_properties);
    }
    
    private function instantation($products_array){
        foreach($products_array as $attribute=>$value){
            if ($result=$this->has_attribute($attribute))
                $this->$attribute=$value;
            }
    }
        
    public function find_user_by_username($Username, $Password) {
       global $database;
        $error = null;
        $result = $database->query("select * from Users where Username = '".$Username."' and Password = '".$Password."'");
        if (!$result) {
            $error='Can not find User. Error:'.$database->get_connection()->error;
        }
        elseif($result->num_rows>0){
            $found=$result->fetch_assoc();
            $this->instantation($found);
        }
        else{
            $error="Can not find User by this Username";
        }
        return $error;
    }
    
    public function find_username($Username) {
       global $database;
        $error = null;
        $result = $database->query("select * from Users where Username = '".$Username."' ");
        if (!$result) {
            $error='Can not find User. Error:'.$database->get_connection()->error;
        }
        elseif($result->num_rows>0){
            $error = 1;
        }
        else{
            $error="Can not find User by this Username. \n Please Try Again.";
        }
        return $error;
    }  
    
    
    public function find_user_by_id($user_id){
        global $database;
        $error=null;
        $result=$database->query("select * from Users where user_id='".$user_id."'");
		
        if (!$result)
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        elseif ($result->num_rows>0){
            $found_user=$result->fetch_assoc();
			$this->instantation($found_user);
        }
         else
             $error="Can not find user by this id";
		 
        return $error;
    }

    public function is_admin($Username, $Password){
        global $database;
        $error=null;
        $result = $database->query("select * from Users where Username = '".$Username."' and Password = '".$Password."'");

        if($result->num_rows>0){
            $user_data=$result->fetch_assoc();

            if($user_data["Admin"] == FALSE){
                $error=FALSE;
            }
            else{
                $error=TRUE;
            }
        }

        return $error;
    }

    public static function add_User($user_id, $Name, $LastName, $Email, $AptNo, $Username, $Password, $Admin){
        global $database;
        $error=null;
        $sql="Insert into Users(user_id, Name, LastName, Email, AptNo, Username, Password, Admin) values ('".$user_id."','".$Name."','".$LastName."','".$Email."','".$AptNo."','".$Username."','".$Password."','".$Admin."')";
        $result=$database->query($sql);
        if (!$result)
            $error='Can not add User. Error:'.$database->get_connection()->error;
        else
            $error='User Was Added Successfully';
        return $error;
    }
        
    }