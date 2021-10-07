<?php 
$id = $_GET['id'];
    $eventManager = new EventManager();
    try{
        $subeventdetails = $eventManager->subEventDetails($id);
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
    $details = mysqli_fetch_assoc($subeventdetails);
    $sub_event_head_id = $details['SUB_EVENT_HEAD'];
    $head_details = $eventManager->getHeadInfoOnSubEventID($sub_event_head_id);
    $head_details = mysqli_fetch_assoc($head_details);
    $head_name = $head_details['EH_NAME'];
    
?>

<?php
$title = "Update Sub-Events - Eventers";
$bodyColor = 'bg-white';
include 'templates/event-heads/header.php';
include 'templates/event-heads/navbar.php';
?>
<div class="container">
    <h5 class="text-center 600 h3 text-primary fs-3 fw-3 my-3">Edit Event</h5>

    <form method="post">
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label>Event Name</label>
                <input type="text" class="form-control form-control-user disabled" name="event_name" value="<?php echo $eventname = $details['EVENT_NAME']; ?>" disabled>
            </div>
            <div class="col-sm-6">
                <label>Sub event name</label>
                <input type="text" class="form-control form-control-user" name="sub_event_name" value="<?php echo $subeventname = $details['SUB_EVENT_NAME']; ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label>Place</label>
            <input type="text" class="form-control form-control-user" name="college_name" value="<?php echo $details['SUB_EVENT_LOCATION']; ?>">

        </div>
        <div class="form-group row">
            <div class="col-sm-6">
                <label>Time</label>
                <input type="text" class="form-control form-control-user" id="dtttextbox" name="time" value="<?php echo $details['SUB_EVENT_DATE']; ?>" required>
                <script>
                    var dtt = document.getElementById('dtttextbox')
                    dtt.onfocus = function(event) {
                        this.type = 'datetime-local';
                        this.focus();
                    }
                </script>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <label>Event head name</label>
                <input type="text" name="head_name" class="form-control form-control-user" value="<?php echo $head_name ?>" disabled>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <label>Description</label>
                <textarea class="form-control form-control-user" name="description" required rows="3"><?php echo $details['SUB_EVENT_DESCRIPTION']; ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <label>Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control form-control-user" placeholder="Upload an photo">
            </div>

        </div>

        <div class="form-group row">
            <div class="col">
                <input type="hidden" name="event_id_hidden" value=<?php echo $details['SUB_EVENT_ID'] ?>>

                <button type="submit" name="update-Button" class="btn btn-success btn-user btn-block w-100">
                    Update Event
                </button>
            </div>
            <div class="col">
                <a name="cancel-button" role="button" class="btn btn-danger btn-user btn-block w-100" href="show-event">
                    Cancel
                </a>
            </div>
        </div>


    </form>



</div>

<?php
include_once 'templates/event-heads/footer.php';
?>