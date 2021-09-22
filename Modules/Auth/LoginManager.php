<?php 
    class LoginManager{
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
                return $this->db->query("SELECT * FROM users_details WHERE EMAIL = '".$email."' AND PASSWORD = '".md5($password)."'");
            }
            else{
                return false;
            }
        }
    }
?>