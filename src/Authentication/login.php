<?php 
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = new LoginManager();
        $data = $user->login($email, $password);
        
        if(mysqli_num_rows($data) == 1){
            $row = mysqli_fetch_assoc($data);
            
            $userData = array(
                'isUserLoggedIn'=> true,
                'id' => $row['ID'],
                'name' => $row['NAME'],
                'email' => $row['EMAIL'],
                'phone' => $row['PHONE'],
                'usertype'=>'USER',
            );
            $past = time() - 3600;
            foreach ( $_COOKIE as $key => $value )
            {
                setcookie( $key, $value, $past, '/' );
            }
            setcookie('userData', json_encode($userData), time() + (86400 * 30 * 15), "/");
            $userData = json_decode($_COOKIE['userData'], true);
            echo $userData['name'];
            //header("Refresh:0");
            header("location: dashboard");
        }
        else{
            header("location: login?invalidUserOrPassword");
        }
    }

?>