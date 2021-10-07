<?php
    //session_destroy();
    //header('Location: /optimized-event-manager');
    
   
    if(isset($_COOKIE['headUser'])){
        $data = json_decode($_COOKIE['headUser'], true);
        if(isset($data['id'])){
            //unset($_COOKIE['headUser']);
            setcookie('headUser', 'none', time() - 86400 , '/');
            echo "Done";
            header("location: head-login");
        }
    }
    elseif(isset($_COOKIE['userData'])){
        $userData = json_decode($_COOKIE['userData'], true);
        if(isset($userData['id'])){
            setcookie('userData', '', time() - 86400 * 30, '/');
            header("location: login");
        }
    }
    
    
?>