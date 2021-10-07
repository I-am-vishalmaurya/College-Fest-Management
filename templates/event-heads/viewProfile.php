<?php 
    $id = $data['id'];
    $name = $data['name'];

?>


<?php
$title = "Profile - Eventers";
$bodyColor = 'bg-white';
include 'templates/event-heads/header.php';
include 'templates/event-heads/navbar.php';
?>

<div class="container-fluid bg-white">
    <div class="col-8 mt-5 mx-auto ">

        <form action="../source/update-account-details.php" class="user" method="POST" enctype="multipart/form-data">
            <div class="row mx-auto form-group">
                <div class="update__profile__pic my-4">
                    <img src="<?php

                                if (isset($data['THUMBNAIL'])) {
                                    echo $imgDestination . $data['THUMBNAIL'];
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
                
            </div>
            <div class="form-group">
                <label for="staticEmail" class="col-sm-2 col-md-4 col-form-label">Email</label>
                <input type="email" class="form-control form-control-user" readonly="" name="email" placeholder="Email" value=<?php echo $data['email']; ?>>
            </div>
           
            <div class="row form-group">
                <div class="col"><button type="submit" class="btn btn-success w-100">Update the account</button></div>
                <!-- <div class="col"><button type="submit" class="btn btn-warning w-100">Password</button></div>
                        <div class="col"><button type="submit" class="btn btn-danger w-100">Delete account</button></div> -->
            </div>
        </form>
    </div>
</div>
<?php
include_once 'templates/event-heads/footer.php';
?>