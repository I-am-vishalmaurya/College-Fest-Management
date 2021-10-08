<?php 
    $id = $userData['id'];
    $name = $userData['name'];
    $phone = $userData['phone'];
?>

<?php
$title = "Dashboard - Eventers";
$bodyColor = 'bg-white';
include 'templates/users/header.php';
include 'templates/users/navbar.php';
?>

<div class="container-fluid bg-white">
    <div class="col-8 mt-5 mx-auto ">

        <form action="../source/update-account-details.php" class="user" method="POST" enctype="multipart/form-data">
            <div class="row mx-auto form-group">
                <div class="update__profile__pic my-4">
                    <img src="<?php

                                if (isset($userData['THUMBNAIL'])) {
                                    echo $imgDestination . $userData['THUMBNAIL'];
                                } else {
                                    echo  "templates/assets/images/undraw_profile.svg";
                                }


                                ?>" alt="" class="account__image mx-auto " style="cursor: pointer;">
                    <div class="image__placeholder">
                        <label class="-label" for="file">
                            <i class='bx bxs-camera'></i>
                            <span>Change Image</span>
                        </label>
                        <input id="file" type="file" name="profileImage" style="display: none;" />
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-6">
                    <label for="staticFname" class="col-sm-2 col-md-4 col-form-label">Name</label>
                    <input type="text" class="form-control form-control-user" readonly="" name="name" placeholder="First Name" value=<?php echo $name ?>>
                </div>
                <div class="col-sm-6">
                    <label for="staticFname" class="col-sm-2 col-md-4 col-form-label">Phone</label>
                    <input type="text" class="form-control form-control-user" readonly="" name="name" placeholder="First Name" value=<?php echo $phone ?>>
                </div>
                
            </div>
            <div class="form-group">
                <label for="staticEmail" class="col-sm-2 col-md-4 col-form-label">Email</label>
                <input type="email" class="form-control form-control-user" readonly="" name="email" placeholder="Email" value=<?php echo $userData['email']; ?>>
            </div>
           
            <div class="row form-group">
                <div class="col"><button type="submit" class="btn btn-success w-100">Don't Click</button></div>
                <!-- <div class="col"><button type="submit" class="btn btn-warning w-100">Password</button></div>
                        <div class="col"><button type="submit" class="btn btn-danger w-100">Delete account</button></div> -->
            </div>
        </form>
    </div>
</div>
<?php
include_once 'templates/users/footer.php';
?>