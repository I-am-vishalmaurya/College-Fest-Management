<?php
$subeventManager = new SubEvents();
$email = $userData['id'];
$joinedSubEventID = $subeventManager->getJoinedSubEventID($email);
?>

<?php
$title = "Schedule - Eventers";
$bodyColor = 'bg-white';
include 'templates/users/header.php';
include 'templates/users/navbar.php';
?>

<div class="container mt-4">
    <div class="row">
        <?php
        while ($row = mysqli_fetch_assoc($joinedSubEventID)) {
            $subEventID = $row['SUB_EVENT_ID'];
            try {
                $joinedSubEvents = $subeventManager->getSubEventDetailsWithID($subEventID);
                $subEvents = $joinedSubEvents->fetch_assoc();
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
                                    <a href="unjoin-subevent?<?php echo 'id=' . $id = $subEvents['SUB_EVENT_ID']; ?>" name="edit_button" class="btn btn-block btn-primary mb-1 w-100">Unjoin</a>
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
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            ?>


        <?php
        }
        ?>

    </div>
</div>

<?php
include_once 'templates/users/footer.php';
?>