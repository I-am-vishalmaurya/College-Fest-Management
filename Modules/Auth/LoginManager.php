<?php 
    class LoginManager{
        private static $instance = null;
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

        
        public function __construct(){
            $this->db = new eventManagerDB();
        }

        public function login($email, $password){
            $query = $this->db->query("SELECT * FROM users_details WHERE EMAIL = '".$email."' AND PASSWORD = '".md5($password)."'");
            if($query){
                return $this->db->query("SELECT * FROM users_details WHERE EMAIL = '".$email."' AND PASSWORD = '".md5($password)."'");
            }
            else{
                return false;
            }
        }

        public function adminLogin($email, $password){
            $query = $this->db->query("SELECT * FROM event_heads WHERE EH_EMAIL = '".$email."' AND EH_PASSWORD = '".md5($password)."'");
            if($query){
                return $this->db->query("SELECT * FROM event_heads WHERE EH_EMAIL = '".$email."' AND EH_PASSWORD = '".md5($password)."'");
            }
            else{
                return false;
            }
        }

        public function getHeadID($email){
            $query = $this->db->query("SELECT ID FROM event_heads WHERE EH_EMAIL = '".$email."'");  
            if($query){
                $row = $query->fetch_assoc();
                return $row['ID'];
            }
            else{
                return false;
            }
        }

        public function getHeadInfo($id){
            $query = $this->db->query("SELECT ORG_ID, EH_NAME, ORG_STATUS FROM event_heads WHERE ID = '$id'");
            if($query){
                $row = $query->fetch_assoc();
                return $row;
            }
            else{
                return false;
            }
        }
    }
?>