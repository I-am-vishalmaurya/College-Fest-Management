<?php 
$message = null;
$error = null;
if (isset($_POST['addEvent'])) {
    $eventName = $_POST['EventName'];
    $eventHeadEmail = $data['email'];
    $eventStartDate = $_POST['startdate'];
    $EventEndDate = $_POST['enddate'];
    $eventLocation = $_POST['EventLocation'];
    $eventDescription = $_POST['EventDescription'];
    $_files = $_FILES['EventThumbnail'];
    //Code for Uploading the thumbnail
    $filename = $_FILES['EventThumbnail']['name'];
    $tempname = $_FILES['EventThumbnail']['tmp_name'];
    $fileSize = $_FILES['EventThumbnail']['size'];
    $fileError = $_FILES['EventThumbnail']['error'];
  
  
    $addEvent = new EventManager();
    try{
      $getDestiniation = $addEvent->handleThumbnail($filename, $tempname, $fileSize, $fileError, "events");
    }
    catch(Exception $e){
      $error = $e->getMessage();
      header('Location: host-event?error=' . $error);
    }
    if(!$error){
      try{
        $result = $addEvent->addEvent($eventName, $eventHeadEmail, $eventStartDate, $EventEndDate, $eventLocation, $eventDescription, $getDestiniation);
        if ($result) {
          header('Location: host-event?eventAddedSuccessfully');
        } else {
          $error  = $addEvent->error;
          header('Location: host-event?eventAddedFailed');
        }
      }catch(Exception $e){
        $error = $e->getMessage();
        header('Location: host-event?error=' . $error);
      }
    }
  }
  
?>
