<?php 
    $subeventid = $_GET['id'];
    $eventManager = new SubEvents();
    try{
        $numberOfResponses = $eventManager->getNumberOfPeopleJoinedSubevent($subeventid);
        $responses = mysqli_fetch_assoc($numberOfResponses);
        if($responses['COUNT(*)'] == 0){
            $responseMessage =  '<h3>No one has joined this event yet</h3>';
        }else{
            $number = $responses['COUNT(*)'];
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }

    
    

?>


<?php
$title = "Dashboard - Eventers";
$bodyColor = 'main-body-color';
include 'templates/event-heads/header.php';
include 'templates/event-heads/navbar.php';
?>

<div class="contianer-fluid">
    <div class="row dashboard-top text-center">
    <h1 class=" text-center">Responses</h1>
        <div class="col-4 my-auto">
            <div class="glass-card">
                <div class="card-body glass-card-body">
                    <h5 class="card-title">Responses</h5>
                    <p class="dashboard-info-show"><?php if(isset($responseMessage)){
                        echo $responseMessage;
                    }
                    else{
                        echo $number;
                    } 
                    ?></p>  
                </div>
            </div>
        </div>
        <div class="col-8 my-auto">
            <div class="glass-card">
                <div class="card-body glass-card-body">
                    <h5 class="card-title">Participant Information</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Email Address</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            try{
                                $count = null;
                                $userInfo = $eventManager->getJoinUserInfo($subeventid);
                                while($user = mysqli_fetch_assoc($userInfo)){
                                    $count = $count + 1;
                                    echo '<tr>';
                                    echo '<td>'. $count .'</td>';
                                    echo '<td>'.$user['NAME'].'</td>';
                                    echo '<td>'.$user['PHONE'].'</td>';
                                    echo '<td>'.$user['EMAIL'].'</td>';
                                    echo '</tr>';
                                }
                            }
                            catch(Exception $e){
                                echo $e->getMessage();
                            }
                            //echo count($userInfoAray);
                            
                        ?>
                            
                        </tbody>
                    </table>  
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'templates/event-heads/footer.php';
?>