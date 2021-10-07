<?php
$message = null;
$error = null;
$eventdetails = new EventManager();
$getOrgMembers = new OrganizationManager();
$head_email_id = $data['email'];
$headID = $data['id'];
echo "In Post Section";
// Get  the EVent names hosted by the head
try {
    $eventNames = $eventdetails->getEvents($head_email_id);
    
} catch (Exception $e) {
    $error = $e->getMessage();
    
}

// Get the Sub Event Heads working under Head Organization
try{
    $members = $getOrgMembers->getMemberOfOrganization($headID);
    array_pop($members);
    array_pop($members);  
}
catch(Exception $e){
    $MemberError = $e->getMessage();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_name'];
    $category = $_POST['category'];
    $sub_event_name = $_POST['sub_event_name'];
    $sub_event_datetime = $_POST['sub_event_datetime'];
    $sub_event_location = $_POST['location'];
    $sub_event_description = $_POST['sub_event_description'];
    $subEventHeadID = $_POST['sub_event_head_id'];
    // Manageing the thubmnail of sub events
    $filename = $_FILES['sub_event_thumbnail']['name'];
    $tempname = $_FILES['sub_event_thumbnail']['tmp_name'];
    $fileSize = $_FILES['sub_event_thumbnail']['size'];
    $fileError = $_FILES['sub_event_thumbnail']['error'];
    try {
        $thumbnailDestination = $eventdetails->handleThumbnail($filename, $tempname, $fileSize, $fileError, 'subevents');
    } catch (Exception $e) {
        $error =  $e->getMessage();
        header("location: add-subevent?error=" . $error);
    }
    if (!$error) {
        try {
            $result = $eventdetails->addSubEvents(
                $event_id,
                $sub_event_name,
                $category,
                $subEventHeadID,
                $sub_event_description,
                $thumbnailDestination,
                $sub_event_datetime,
                $sub_event_location,
                
            );

            if ($result) {
                header("location: add-subevent?addedSuccessfully");
            } else {
                header("location: add-subevent?errorOccured");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
            var_dump($error);
            //header("location: add-subevent?error=" . $error);
        }
    }

}
