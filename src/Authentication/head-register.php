<?php 
    $message = null;
    $error = null;
    $registerManager = new RegisterManager();
    if(isset($_POST['register'])){
        
        $field = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'confirm-password' => $_POST['confirm-password'],
        );
        if($field['password'] == $field['confirm-password']){
            if($registerManager->required_validation($field)){
                if($registerManager->eventHeadEmailExist($field['email'])){
                    header("location: head-login?status=userAlreadyExist");
                }
                elseif($registerManager->registerEventHead($field['name'], $field['email'], $field['password'], $field['confirm-password'])){
                    $error = "Success";
                    header('Location: head-login?status=registrationSuccessful');
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
