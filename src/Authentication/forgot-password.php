<?php 

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $USER_ID = $_POST['user_id'];
        $USER_PASSWORD = $_POST['user_password'];
        $USER_PASSWORD_CONFIRM = $_POST['user_password_confirm'];
        if($USER_PASSWORD === $USER_PASSWORD_CONFIRM){
            $loginManager = new LoginManager();
            $loginManager->forgotPassword($USER_ID, $USER_PASSWORD);
            header('Location: login?passwordreset=success');
        }
        else{
            header('Location: logout');
        }
    }
    else{
        header('Location: logout');
    }

?>