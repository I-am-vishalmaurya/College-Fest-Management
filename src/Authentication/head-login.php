<?php
    // if(isset($_SESSION['EH_email'])){
    //     header('Location: /optimized-event-manager/event-head');
    // }
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = new LoginManager();
        $data = $user->adminLogin($email, $password);
        
        if(mysqli_num_rows($data) == 1){
            $row = mysqli_fetch_assoc($data);
            $headData = array(
                'isHeadLoggedIn'=> true,
                'id'=>$row['ID'],
                'name'=>$row['EH_NAME'],
                'email'=>$row['EH_EMAIL'],
                'usertype'=>'EVENT_HEAD',
            );
            // deleting all cookies of other account if any
            $past = time() - 3600;
            foreach ( $_COOKIE as $key => $value )
            {
                setcookie( $key, $value, $past, '/' );
            }
            setcookie('headUser', json_encode($headData), time() + (86400 * 30 * 15), "/");
            header("location: event-head");
        }
        else{
            header("location: head-login?status=invalidUserOrPassword");
        }
    }
    

?>

