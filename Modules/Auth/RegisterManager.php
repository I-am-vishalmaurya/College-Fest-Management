<?php 

    class RegisterManager{
        public $errors;


        public function __construct(){
            $this->db = new eventManagerDB();
        }

        
        public function registerUser($name, $email, $password, $confirmpassword, $phoneNumber){
            $name = $this->db->real_escape_string($name);
            $email = $this->db->real_escape_string($email);
            $password = $this->db->real_escape_string($password);
            $confirmpassword = $this->db->real_escape_string($confirmpassword);
            $phoneNumber = $this->db->real_escape_string($phoneNumber);
            if($password === $confirmpassword){
                $password = md5($password);
                $result = $this->db->query("INSERT INTO users_details (NAME, EMAIL, PASSWORD, PHONE) VALUES ('$name', '$email', '$password', '$phoneNumber')");
                return $result;
            }
            else{
                return false;
               
            }
            
        }

        public function registerEventHead($name, $email, $password, $confirmpassword){
            $name = $this->db->real_escape_string($name);
            $email = $this->db->real_escape_string($email);
            $password = $this->db->real_escape_string($password);
            $confirmpassword = $this->db->real_escape_string($confirmpassword);
            if($password === $confirmpassword){
                $password = md5($password);
                $result = $this->db->query("INSERT INTO event_heads (EH_NAME, EH_EMAIL, EH_PASSWORD) VALUES ('$name', '$email', '$password')");
                return $result;
            }
            else{
                return false;
            }
        }

        public function userEmailExist($email){
            $email = $this->db->real_escape_string($email);
            $result = $this->db->query("SELECT ID FROM users_details WHERE EMAIL = '$email'");
            if($result->num_rows > 0){
                return true;
            }
            else{
                return false;
            }
            
        }

        public function eventHeadEmailExist($email){
            $email = $this->db->real_escape_string($email);
            $result2 = $this->db->query("SELECT ID FROM event_heads WHERE EH_EMAIL = '$email'");
            if($result2->num_rows > 0){
                return true;
            }
            else{
                return false;
            }
        }

        public function required_validation($data){
            $count = 0;
            foreach($data as $key => $value){
                if(empty($value)){
                    $count++;
                    $this->errors = "<p>" . $key . "is required </p>";
                }
            }
            if($count == 0){
                return true;
            }
        }

    }

?>