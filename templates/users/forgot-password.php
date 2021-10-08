
<?php
$title = "Dashboard - Eventers";
$bodyColor = 'bg-white';
include 'templates/users/header.php';
include 'templates/users/navbar.php';
?>
<div class="container">
    <div class="card border-0 my-5">
        <div class="row">
            <div class="col-12 my-4">
                <h3 class="text-center">Forgot Password</h3>
            </div>

            <div class="col-12">
                <form method="post">
                    <div class="row mx-auto">
                    <div class="form-group">
                       
                        <input type="hidden" class="form-control" name="user_id" value=<?php echo $userData['id'] ?>>
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" name="user_password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm New Password</label>
                        <input type="password" class="form-control" name="user_password_confirm" placeholder="Confirm New Password">
                    </div>
                    <div class="form-group">
                        <input type="submit" id = "btn-forgot-passoword-submit" class="btn btn-primary" value="Submit">
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'templates/users/footer.php';
?>