<?php 
    $eventManager = new EventManager();
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        try{
            $result = $eventManager->deleteSubEvents($_GET['id']);
            header('Location: show-event?deletedSuccessfully');
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
    

?>