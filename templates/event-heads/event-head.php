<?php
$subeventManager = new SubEvents();
$head_id = $data['id'];

try {
    $numberOfResponses = $subeventManager->showPostedEvents($head_id);
    $responses = mysqli_fetch_assoc($numberOfResponses);
    if($responses['COUNT(*)'] == 0){
        $responseMessage =  '<h3>No one has joined this event yet</h3>';
    }else{
        $responseMessage = $responses['COUNT(*)'];
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
        $likedTheProject = $subeventManager->likedtheProject($head_id);
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
$bodyColor = 'bg-white';
include 'templates/event-heads/header.php';
include 'templates/event-heads/navbar.php';
?>
<div class="contianer-fluid">
    <div class="row dashboard-top text-center">
        <div class="col-4 my-auto">
            <div class="glass-card">
                <div class="card-body glass-card-body">
                    <h5 class="card-title">Total Events</h5>

                    <p class="dashboard-info-show"><?php echo $responseMessage ?></p>
                    <a href="schedule" class="btn btn-primary">Schedule</a>
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
include_once 'templates/event-heads/footer.php';
?>