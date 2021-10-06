<?php
$title = "Host Event - Eventers";
$bodyColor = 'bg-white';
include 'templates/event-heads/header.php';
include 'templates/event-heads/navbar.php';

$name = $data['name'];
$email = $data['email']
?>


<!-- Checking the url and getting the validation alerts -->
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

?>

<div class="ml-4">

  <fieldset>
    <legend>Hosted by</legend>
    <form method="post" enctype="multipart/form-data">
    <div class="form-group row">
      <label for="staticName" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        <input type="text" readonly="" class="form-control-plaintext" id="staticName" value=<?php echo $name ?>>
      </div>
      <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="text" readonly="" class="form-control-plaintext" name="email" value=<?php echo $email ?>>
      </div>
      
    </div>
    
    <div class="form-group">
      <label for="event_name" class="form-label mt-4">Event Name</label>
      <input type="eventName" name= "EventName" class="form-control" id="event_name" aria-describedby="eventnameHelp" placeholder="Enter event name...">
      <small id="eventnameHelp" class="form-text text-muted">Event name should be unique.</small>
    </div>
    <div class="form-group">
      <label for="inputLocation" class="form-label mt-4">Event location</label>
      <input type="text" name= "EventLocation" class="form-control" id="inputLocation" placeholder="Event Location">
    </div>
    <div class="form-group">
      <label for="date" class="form-label mt-4">Event start date</label>
      <input type="date" name= "startdate" class="form-control" placeholder="Event Start Date">
    </div>
    <div class="form-group">
      <label for="inputLocation" class="form-label mt-4">Event end date</label>
      <input type="date" name= "enddate" class="form-control"  placeholder="Event End Date">
    </div>
    
    <div class="form-group">
      <label for="exampleTextarea" class="form-label mt-4">Little description about event</label>
      <textarea name="EventDescription" class="form-control" id="exampleTextarea" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="formFile" class="form-label mt-4">Thumbnail for event</label>
      <input class="form-control" name="EventThumbnail" type="file" id="formFile" required>
    </div>
    
    <button type="submit" name="addEvent" class="btn btn-primary">Host</button>
</form>
</div>

<?php
include_once 'templates/event-heads/footer.php';
?>