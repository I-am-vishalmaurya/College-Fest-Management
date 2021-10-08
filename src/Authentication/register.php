<?php 
    $message = null;
    $error = null;
    $registerManager = new RegisterManager();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $field = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'confirm-password' => $_POST['confirm-password'],
            'phone-number' => $_POST['phone'],
        );
        if($field['password'] == $field['confirm-password']){
            if($registerManager->required_validation($field)){
                if($registerManager->userEmailExist($field['email'])){
                    header("location: login?status=userAlreadyExist");
                }
                elseif($registerManager->registerUser($field['name'], $field['email'], $field['password'], $field['confirm-password'], $field['phone-number'])){
                    header("location: login?status=registrationSuccessful");
                }
            }
            else{
                $message = $registerManager->errors;
            }
        }   
        else{
            $error = "Password not same";
        }

    }
?>