<?php

$message = null;
$errors = null;
$eventManager = new EventManager();


try {
    $subevents = $eventManager->getSubEventDetails();
} catch (Exception $e) {
    $errors = $e->getMessage();
}

?>


<?php
include 'templates/includes/header.php';
include 'templates/includes/navbar.php';
?>
<div class="container">
    <div class="row">
        <?php 
        while($row = mysqli_fetch_assoc($subevents)){
            ?>
            <div class="col-md-4 ">
                <div class="card mb-4 shadow-sm h-100">
                    <img class="card-img-top" src="<?php echo $row['THUMBNAIL']; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-text"><?php echo $row['SUB_EVENT_NAME']; ?></h4>
                        <p class="card-text"><?php echo $row['SUB_EVENT_DESCRIPTION']; ?></p>
                        <!-- date of event -->
                        <p class="card-text"><?php echo date('d F Y', strtotime($row['SUB_EVENT_DATE'])); ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="event.php?id=<?php echo $row['SUB_EVENT_ID']; ?>" class="btn btn-sm btn-outline-primary w-100">View</a>
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
include 'templates/includes/footer.php';
?>