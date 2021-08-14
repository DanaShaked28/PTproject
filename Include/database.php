<?php
    require_once('config.php');

    class Database{
        private $connection;
    
        public function __construct(){
            $this->open_db_connection();
        }
        
        private function open_db_connection(){
            
                error_reporting(E_ERROR);
            
            $this->connection=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            
            if ($this->connection->connect_error){
                $this->connection=null;
                exit("Connect failed database: \n". $this->connection->connect_error);
            }
        }
        
        public function get_connection(){
            return $this->connection;
        }
    
        public function query($sql){
            $result=$this->connection->query($sql);
            if (!$result){
 	          return null;
            }
            else{
                return $result;
            }
        }
        
        public function db_disconnect() {
            if(isset($this->connection)){
                $this->connection -> close();
            }
        }
    }

    $database=new Database();

?>