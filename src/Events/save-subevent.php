<?php 
    $subeventID = $_GET['id'];
    $userID = $userData['id'];

    $subeventManager = new SubEvents();
    try{
        $result = $subeventManager->saveSubEvents($subeventID, $userID);
        if($result){
            header("Location: saved?saved=true");
        }
        else{
            header("Location: all-event?saved=false");
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    
   if(isset($_GET['unsaveid'])){
    try{
        $unSaveResult = $subeventManager->removeSaveSubEvents($_GET['unsaveid'], $userID);
        header("location: saved?unsave=true");
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
   }

?>