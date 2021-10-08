<?php
$subeventManager = new SubEvents();
$user_id = $userData['id'];
try {
    $joinedEvents = $subeventManager->getJoinedSubEventID($user_id);
    $numberofJoinedEvents = mysqli_num_rows($joinedEvents);
    try {
        $savedEvents = $subeventManager->getSavedSubEventID($user_id);
        $numberofSavedEvents = mysqli_num_rows($savedEvents);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

try{
    $likedProjects = $subeventManager->getLikedProject();
    $numberofLikedProjects = mysqli_num_rows($likedProjects);
}
catch(Exception $e){
    echo $e->getMessage();
}
if (isset($_GET['liked_the_project'])) {
    try {
        $likedTheProject = $subeventManager->likedtheProject($user_id);
        if ($likedTheProject) {
            $likeMessage = "Thank You!";
        }
    } catch (Exception $e) {
        $alreadylikeMessage = "You have already liked the project";
    }
}

?>


<?php
$title = "Dashboard - Eventers";
$bodyColor = 'main-body-color';
include 'templates/users/header.php';
include 'templates/users/navbar.php';
?>

<div class="contianer-fluid">
    <div class="row dashboard-top text-center">
        <div class="col-4 my-auto">
            <div class="glass-card">
                <div class="card-body glass-card-body">
                    <h5 class="card-title">Upcoming Events</h5>

                    <p class="dashboard-info-show"><?php echo $numberofJoinedEvents ?></p>
                    <a href="schedule" class="btn btn-primary">Schedule</a>
                </div>
            </div>
        </div>
        <div class="col-4 my-auto">
            <div class="glass-card">
                <div class="card-body glass-card-body">
                    <h5 class="card-title">Saved Events</h5>

                    <p class="dashboard-info-show"><?php echo $numberofSavedEvents ?></p>
                    <a href="#" class="btn btn-primary">Saved Events</a>
                </div>
            </div>
        </div>
        <div class="col-4 my-auto">
            <div class="glass-card">
                <div class="card-body glass-card-body">
                    <h5 class="card-title">Liked the project?</h5>
                    <p class="dashboard-info-show"><?php echo $numberofLikedProjects ?></p>
                    <?php
                    if (isset($likeMessage)) {
                        echo "<p class='liked-info-show'>$likeMessage</p>";
                    } elseif (isset($alreadylikeMessage)) {
                        echo "<p class='liked-info-show'>$alreadylikeMessage</p>";
                    }

                    ?>

                    <form method="get">
                        <button type="submit" name="liked_the_project" class="btn btn-primary"><i class='bx bx-heart'></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'templates/users/footer.php';
?>