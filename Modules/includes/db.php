<?php 

    class eventManagerDB extends mysqli{
        private static $instance = null; 
        private $user = "root";
        private $password = "3112";
        private $dbName = "optimizedeventmanager";
        private $dbHost = "localhost";

        public static function getInstance(){
            if(!self::$instance instanceof self){
                self::$instance = new self;
            }

            return self::$instance;
        }

        public function __clone()
        {
            trigger_error('Clone not allowed.', E_USER_ERROR);
        }

        public function __wakeup()
        {
            trigger_error('Deserializing not allowed.', E_USER_ERROR);
        }

        public function __construct()
        {
            parent::__construct($this->dbHost, $this->user, $this->password, $this->dbName);
            if(mysqli_connect_error()){
                exit('Connection error ('. mysqli_connect_error() . ')' . mysqli_connect_error());
            }
            parent::set_charset('ustf-8');
        }

        public function create_user($email, $password){
            $email = $this->real_escape_string($email);
            $password = $this->real_escape_string($password);
            
            return $this->query("INSERT INTO users_details (EMAIL, PASSWORD) VALUES ('" . $email . "', '". $password ."')");
        }

       
    }

    
?>