<?php 
    if(isset($_POST['login'])){
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
                'usertype'=>'USER',
            );
            setcookie('userData', json_encode($userData), time() + (86400 * 30 * 15), "/");
            $userData = json_decode($_COOKIE['userData'], true);
            echo $userData['name'];
            //header("Refresh:0");
            header("location: /optimized-event-manager/dashboard");
        }
        else{
            header("location: /optimized-event-manager/login?invalidUserOrPassword");
        }
    }

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    <!-- https://bootswatch.com/united/ -->
    <link rel="stylesheet" href="templates/assets/css/bootstrap.min.css">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom CSS -->
    
    <title>Log in</title>
</head>

<body>
    <div class="container">
        <?php
        $currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
            "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
            $_SERVER['REQUEST_URI'];
        $url = substr($currentURL, strrpos($currentURL, '?') + 1);
        if ($url == "passwordSuccessfullyreset") {
            echo '<div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close close" data-dismiss="alert"></button>
        <strong>Well done!</strong> You successfully reset the password login with new password to.
      </div>';
        }
        elseif($url == "invalidUserOrPassword"){
            echo '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="btn-close close" data-dismiss="alert"></button>
            <strong>Invalid Username or Password</strong> Please check the entered email and password.
          </div>';
        }

        ?>
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-3">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group mb-3">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group mb-3">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block w-100">
                                            Login
                                        </button>
                                        <hr>

                                    </form>

                                    <div class="row">
                                        <div class="col">
                                            <div class="text-center">
                                                <a class="small" href="#">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="text-center">
                                                <a class="small" href="register.php">Create an Account!</a>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="text-center">
                                                <a class="small" href="head-login.php">Login as event head</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>



        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>