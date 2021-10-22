<?php

$eventdetails = new EventManager();
$orgManager= new OrganizationManager();
$head_email_id = $data['email'];
$headID = $data['id'];
try {
    $eventNames = $eventdetails->getEvents($head_email_id);
} catch (Exception $e) {
    $error = $e->getMessage();
}



?>
<?php
$title = "Dashboard - Eventers";
$bodyColor = 'bg-white';
include 'templates/event-heads/header.php';
include 'templates/event-heads/navbar.php';
?>

<?php
// Get the Sub Event Heads working under Head Organization
try {
    $org_id = $orgManager->getOrganizationIDHelper($headID);
    $organizationid = mysqli_fetch_assoc($org_id);
    $org_id = $organizationid['ORG_ID'];
    $members = $orgManager->getMemberOfOrganization($org_id);
} catch (Exception $e) {
    $MemberError = $e->getMessage();
}
?>

<?php
$currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
  "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
  $_SERVER['REQUEST_URI'];
$url = substr($currentURL, strrpos($currentURL, '?') + 1);
if ($url == "addedSuccessfully") {
  echo '<div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close close" data-dismiss="alert"></button>
        <strong>Congratulations</strong> Your Sub-event is live now.
      </div>';
} else if ($url == "errorOccured") {
  echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="btn-close close" data-dismiss="alert"></button>
        <strong>Someting went wrong</strong> Please try again later.
      </div>';
}

// <!-- error show messae -->

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
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group row border-0">
                            <div class="col-sm-6 mb-3 mb-sm-0">

                                <select name="event_name" class="form-select" placeholder="Select event name" id="eventNameDD">
                                    <?php
                                    
                                    if (isset($eventNames)) {
                                        foreach ($eventNames as $event) {
                                            echo '<option value="' . $event['EVENT_ID'] . '">' . $event['EVENT_NAME'] . '</option>';
                                        }
                                    } else {
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
                                    <option value=""><?php if (isset($MemberError)) {
                                                            echo $MemberError;
                                                        } else {
                                                            echo "Select event head";
                                                        }
                                                        ?></option>
                                    <?php
                                    // do{
                                    //     echo '<option value="' . $member['ID'] . '">' . $member['EH_NAME'] . '</option>';
                                    // }
                                     while($member = mysqli_fetch_assoc($members)){
                                        echo '<option value="' . $member['ID'] . '">' . $member['EH_NAME'] . '</option>';
                                    //foreach ($members as $row) {
                                        // echo '<option value="' . $row['HEAD_ID'] . '">' . $row['NAME'] . '</option>';
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
                                    <option value="2">PC games</option>
                                    <option value="3">Entertainment</option>
                                    <option value="4">Quizzes</option>
                                    
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
            <a href="show-event"><button class="btn p-3 bg-white font-weight-bold h-100 add-event-button w-100"><i class='bx bx-plus'> Show event</i></button></a>
        </div>

    </div>
</div>

<?php
include_once 'templates/event-heads/footer.php';
?>