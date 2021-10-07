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
include 'templates/event-heads/header.php';
include 'templates/event-heads/navbar.php';
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
                                <a href="update-subevent?<?php echo 'id=' . $id = $subEvents['SUB_EVENT_ID']; ?>" name="edit_button" class="btn btn-block btn-secondary mb-1 w-100">Edit</a>
                            </div>
                            <div class="col">
                                <a href="delete-subevent?<?php echo 'id=' . $id ?>" class="btn btn-block btn-danger mb-1 w-100">Delete</a>
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
include_once 'templates/event-heads/footer.php';
?>