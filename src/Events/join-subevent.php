<?php 
    $subeventID = $_GET['id'];
    $userID = $userData['id'];

    $subeventManager = new SubEvents();
    try{
        $result = $subeventManager->joinSubEvent($subeventID, $userID);
        if($result){
            header("Location: all-event?joined=true");
        }
        else{
            header("Location: all-event?joined=false");
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    
   

?>