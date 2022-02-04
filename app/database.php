<?php
    class dataBase{
        public $conn;
     
        public $servername; 
        public $username;
        public $password; 
        public $db_name;        

        function __construct(){ 
            try{
                $this->servername = getenv("MYSQL_SERVER");
                $this->username = getenv("MYSQL_USER");
                $this->password = getenv("MYSQL_ROOT_PASSWORD");
                $this->db_name = getenv("MYSQL_DATABASE");
                $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->db_name);
            }     
            catch(Exception $e){
                echo "<script> window.alert('Error in database connection!');</script>";
            }            
        } 

        function run_queries($sql){
            return $this->conn->query($sql);
        }
    }
?>