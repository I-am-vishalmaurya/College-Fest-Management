<?php

$message = null;
$errors = null;
$eventManager = new EventManager();
$filterTags = $eventManager->getTags();
try {
    $subevents = $eventManager->getSubEventDetails();
} catch (Exception $e) {
    $errors = $e->getMessage();
}

?>

<?php
$title = "Dashboard - Eventers";
$bodyColor = 'bg-white';
include 'templates/users/header.php';
include 'templates/users/navbar.php';
?>

<?php
$currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
  "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
  $_SERVER['REQUEST_URI'];
$url = substr($currentURL, strrpos($currentURL, '?') + 1);
if ($url == "joined=true") {
  echo '<div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close close" data-dismiss="alert"></button>
        <strong>Congratulations</strong> You joined the event.
      </div>';
} else if ($url == "joined=false") {
  echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="btn-close close" data-dismiss="alert"></button>
        <strong>Someting went wrong</strong> Please try again later.
      </div>';
}

// <!-- error show messae -->

if (isset($error)) {
  echo '<div class="alert alert-danger">' . $error . '</div>';
}

?>
<div class="container mt-4">
    <div class="row">
        <?php
        while ($subEvents = mysqli_fetch_assoc($subevents)) {
        ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img class="img card-img-top event__thumbnail" width="250px" height="200px" src="<?php echo $subEvents['THUMBNAIL'] ?>" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $subEvents['SUB_EVENT_NAME']; ?></h5>
                        <p class="card-text">
                            <?php echo $subEvents['SUB_EVENT_DESCRIPTION']; ?>
                        </p>
                    </div>
                    <div class="card-footer">


                        <div class="row">
                            <div class="col">
                                <a href="join-subevent?<?php echo 'id=' . $id = $subEvents['SUB_EVENT_ID']; ?>" name="edit_button" class="btn btn-block btn-primary mb-1 w-100">Join</a>
                            </div>
                            <div class="col">
                                <a href="delete-subevent?<?php echo 'id=' . $id ?>" class="btn btn-block btn-info mb-1 w-100">View</a>
                            </div>
                            <div class="col">
                                <a href="save-subevent?<?php echo 'id=' . $id ?>" class="btn btn-block btn-warning mb-1 w-100"><i class='bx bx-bookmark'></i> Save</a>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>

<?php
include_once 'templates/users/footer.php';
?>