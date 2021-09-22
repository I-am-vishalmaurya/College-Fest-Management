<?php
$message = null;
$error = null;
if (isset($_POST['addEvent'])) {
  $eventName = $_POST['eventName'];
  $eventHeadEmail = $data['email'];
  $eventStartDate = $_POST['eventStartDate'];
  $EventEndDate = $_POST['eventEndDate'];
  $eventLocation = $_POST['eventLocation'];
  $eventDescription = $_POST['eventDescription'];
  $_files = $_FILES['thumbnail'];
  //Code for Uploading the thumbnail
  $filename = $_FILES['thumbnail']['name'];
  $tempname = $_FILES['thumbnail']['tmp_name'];
  $fileSize = $_FILES['thumbnail']['size'];
  $fileError = $_FILES['thumbnail']['error'];


  $addEvent = new EventManager();
  try{
    $getDestiniation = $addEvent->handleThumbnail($filename, $tempname, $fileSize, $fileError);
  }
  catch(Exception $e){
    $error = $e->getMessage();
  }
  if(!$error){
    try{
      $result = $addEvent->addEvent($eventName, $eventHeadEmail, $eventStartDate, $EventEndDate, $eventLocation, $eventDescription, $getDestiniation);
      if ($result) {
        header('Location: add-event?eventAddedSuccessfully');
      } else {
        $error  = $addEvent->error;
        header('Location: add-event?eventAddedFailed');
      }
    }catch(Exception $e){
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
        <strong>Your Event is live now.</strong> Add sub event for your event in manage events section.
      </div>';
} else if ($url == "eventAddedFailed") {
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
<div class="ml-4">

  <fieldset>
    <legend>Hosted by</legend>
    <div class="form-group row">
      <label for="staticName" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        <input type="text" readonly="" class="form-control-plaintext" id="staticName" value=<?php echo $data['name']; ?>>
      </div>
      <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value=<?php echo $data['email']; ?>>
      </div>
      <label for="staticPhone" class="col-sm-2 col-form-label">Phone No</label>
      <div class="col-sm-10">
        <input type="text" readonly="" class="form-control-plaintext" id="staticPhone" value=<?php echo "9076260427" ?>>
      </div>
    </div>
    <form method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="event_name" class="form-label mt-4">Event Name</label>
        <input type="text" name="eventName" class="form-control" aria-describedby="eventnameHelp" placeholder="Enter event name...">
        <small id="eventnameHelp" class="form-text text-muted">Event name should be unique.</small>
      </div>
      <div class="form-group">
        <label for="inputLocation" class="form-label mt-4">Event location</label>
        <input type="text" name="eventLocation" class="form-control" id="inputLocation" placeholder="Event Location">
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col">
            <label for="date" class="form-label mt-4">Start of event</label>
            <input type="date" name="eventStartDate">
          </div>
          <div class="col">
            <label for="date" class="form-label mt-4">End of event</label>
            <input type="date" name="eventEndDate">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleTextarea" class="form-label mt-4">Little description about event</label>
        <textarea name="eventDescription" class="form-control" id="exampleTextarea" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="formFile" class="form-label mt-4">Thumbnail for event</label>
        <input class="form-control" name="thumbnail" type="file" id="formFile" required>
      </div>
      <button type="submit" name="addEvent" class="btn btn-primary">Host</button>
    </form>
</div>

<?php
include_once 'templates/event-heads/footer.php';
?>