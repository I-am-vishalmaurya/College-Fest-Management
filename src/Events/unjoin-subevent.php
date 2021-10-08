<?php 
    $subeventID = $_GET['id'];
    $userID = $userData['id'];

    $subeventManager = new SubEvents();
    try{
        $result = $subeventManager->unJoinSubEvent($subeventID, $userID);
        if($result){
            header("Location: schedule?unJoined=true");
        }
        else{
            header("Location: schedule?unJoined=false");
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    
   

?>