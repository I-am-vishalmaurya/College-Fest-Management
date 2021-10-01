<?php
$message = null;
$error = null;
$eventdetails = new EventManager();
$getOrgMembers = new OrganizationManager();
$head_email_id = $data['email'];
$headID = $data['id'];
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
if (isset($_POST['add_subevents'])) {
    $head_email = $data['email'];
    $event_name = $_POST['event_name'];
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
    }
    if (!$error) {
        try {
            $result = $eventdetails->addSubEvents(
                $event_name,
                $head_email,
                $category,
                $subEventHeadID,
                $sub_event_name,
                $sub_event_description,
                $sub_event_datetime,
                $sub_event_location,
                $thumbnailDestination
            );

            if ($result) {
                header("location: add-subevent?addedSuccessfully");
            } else {
                header("location: add-subevent?errorOccured");
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }

}

?>


<?php
$title = "Dashboard - Eventers";
$bodyColor = 'bg-white';
include 'templates/event-heads/header.php';
include 'templates/event-heads/navbar.php';
?>

<?php
$currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
    "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
    $_SERVER['REQUEST_URI'];
$url = substr($currentURL, strrpos($currentURL, '?') + 1);
if ($url == "eventAddedSuccessfully") {
    echo '<div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close close" data-dismiss="alert"></button>
        <strong>Your Event is live now.</strong> Add sub event for your event here.
      </div>';
}
if (isset($message)) {
    echo '<div class="alert alert-danger">' . $message . '</div>';
}
if (isset($error)) {
    echo '<div class="alert alert-danger">' . $error . '</div>';
}

?>


<div class="container-fluid  p-4">
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group row border-0">
                            <div class="col-sm-6 mb-3 mb-sm-0">

                                <select name="event_name" class="form-select" placeholder="Select event name" id="eventNameDD">
                                    <?php
                                    if(isset($eventNames)){
                                        foreach ($eventNames as $event) {
                                            echo '<option value="' . $event['EVENT_ID'] . '">' . $event['EVENT_NAME'] . '</option>';
                                        }
                                    }
                                    else{
                                        echo '<option value="">Add the events</option>';
                                    }
                                    
                                
                                    ?>

                                </select>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" name="sub_event_name" placeholder="Sub-event Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="location" placeholder="Location">

                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="sub_event_location" placeholder="City" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="datetime-local" class="form-control form-control-user" id="dtttextbox" name="sub_event_datetime" placeholder="Date & Time" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <select name="sub_event_head_id" class="form-select" placeholder="Select event head" id="subeventheadDD">
                                    <option value=""><?php if(isset($MemberError)){
                                            echo $MemberError;
                                    }
                                    else{
                                        echo "Select event head";
                                    }
                                     ?></option>
                                    <?php
                                    // do{
                                    //     echo '<option value="' . $member['ID'] . '">' . $member['EH_NAME'] . '</option>';
                                    // }
                                    // while($member = mysqli_fetch_assoc($members));
                                    foreach ($members as $row) {
                                        echo '<option value="' . $row['HEAD_ID'] . '">' . $row['NAME'] . '</option>';
                                     }
                                    
                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <textarea class="form-control form-control-user" name="sub_event_description" placeholder="Enter details about event" required rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <select name="category" class="form-select" placeholder="Choose Category">
                                    <option value="0" selected disabled>Choose the category</option>
                                    <option value="1">Sports</option>
                                    <option value="2">Outdoor activity</option>
                                    <option value="3">Indoor sports</option>
                                    <option value="4">Entertainment</option>
                                    <option value="5">Quiz games</option>
                                    <option value="6">Games</option>
                                    <option value="7">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 mb-3 mb-sm-0">
                                <label for="formFile2" class="form-label">Thumbnail for sub-event</label>
                                <input class="form-control" name="sub_event_thumbnail" type="file" id="formFile2">
                            </div>
                        </div>

                        <button type="submit" id="post_event_btn" name="add_subevents" class="btn btn-primary btn-user btn-block w-100">
                            Post Event
                        </button>

                    </form>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="text-start my-2">
            <h3 class="h3 text-gray-700 text-bold">Manage subevent</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas molestias cupiditate minus alias sed qui nemo! Maiores animi officia possimus enim? Dignissimos magnam molestias porro, facere dolorum dolorem doloribus mollitia.</p>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <button class="btn p-3 bg-white font-weight-bold h-100 add-event-button w-100" data-toggle="modal" data-target="#exampleModalCenter"><i class='bx bx-plus'> Add event</i></button>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="showevent.php"><button class="btn p-3 bg-white font-weight-bold h-100 add-event-button w-100"><i class='bx bx-plus'> Show event</i></button></a>
        </div>

    </div>
</div>

<?php
include_once 'templates/event-heads/footer.php';
?>