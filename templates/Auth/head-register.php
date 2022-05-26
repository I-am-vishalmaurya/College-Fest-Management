
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- https://bootswatch.com/united/ -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="templates/assets/css/bootstrap.min.css">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>Sign up</title>
</head>

<body class="bg-light">

    <div class="container">
        <div class="card shadow-lg o-hidden border-0 my-4">
            <div class="card-body p-0">
                <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image">    
                </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">
                                    Create an head account.
                                </h1>
                                <!-- error show messae -->
                                
                                <?php if(isset($message)){echo '<div class="alert alert-danger">'.$message.'</div>';}
                                if(isset($error)){
                                    echo '<div class="alert alert-danger">'.$error.'</div>';
                                } ?>


                            </div>
                            <form method="POST">
                                <div class="row form-group mb-3">
                                    <div class="col-sm-12 sm-mb-0">
                                        <input type="text" class="form-control form-control-user" name="name" placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control form-control-user" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-sm-6 mb-3 sm-mb-0">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="confirm-password" placeholder="Confirm password" required>
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" required>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">By checking you are agreeing to T&C of eventers.</label>
                                </div>
                                <!-- <div class="form-group row">
                                    <div class="col-sm-6 mb-3 sm-mb-0">
                                        <input type="text" class="form-control form-control-user" name="location" placeholder="Your Prefered Location">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="dob" id="dob_joiner" placeholder="Date of birth" class="form-control form-control-user">
                                        <script>
                                        // Date of birth custom script for placeholder
                                        const dob = document.getElementById('dob_joiner')
                                        dob.onfocus = function (event) {
                                        this.type = 'date';
                                        this.focus();
                                        }
                                        </script>
                                        
                                    </div>
                                    <p class="text-gray">You change your location afterwards.</p>
                                </div> -->

                                <button type="submit" class="btn btn-block w-100 btn-primary" name="register">Sign up</button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="head-login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>
