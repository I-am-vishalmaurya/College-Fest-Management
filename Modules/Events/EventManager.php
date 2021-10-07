<?php
class EventManager
{
    public  $errors;
    private static $instance = null;
    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->db = new eventManagerDB();
        $this->loginManager = new LoginManager();
    }

    public function __clone()
    {
        trigger_error('Clone not allowed.', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error('Deserializing not allowed.', E_USER_ERROR);
    }

    public function handleThumbnail($filename, $tempname, $fileSize, $fileError, $savedDestination)
    {

        $fileExtension = explode(".", $filename);
        $fileActualExtension = strtolower(end($fileExtension));
        $allowedFileTypes = array("jpg", "jpeg", "png");
        if (in_array($fileActualExtension, $allowedFileTypes)) {
            if ($fileError === 0) {
                if ($fileSize <= 5242880) {
                    $newfileName = uniqid('', true) . "." . $fileActualExtension;
                    $fileDestination = 'global/eventThumbnails/' . $savedDestination . '/' . $newfileName;
                    (move_uploaded_file($tempname, $fileDestination));
                    return $fileDestination;
                } else {
                    throw new Exception("File size is too big");
                }
            } else {
                throw new Exception("There was an error uploading your file");
            }
        } else {
            throw new Exception($fileActualExtension . " is not a valid file type");
        }
    }
    public function addEvent($eventName, $eventHeadEmail, $eventStartDate, $EventEndDate, $eventLocation, $eventDescription, $thumbnail)
    {
        $eventHeadId = $this->loginManager->getHeadID($eventHeadEmail);
        $name = ($eventName);
        $startDate = $eventStartDate;
        $endDate = $EventEndDate;
        $location = ($eventLocation);
        $description = ($eventDescription);
        $eventThumbnail = $thumbnail;
        if (!empty($eventHeadId) || !empty($name) || !empty($startDate) || !empty($endDate) || !empty($location) || !empty($description) || !empty($eventThumbnail)) {
            $query = "INSERT INTO `events`(`EVENT_HEAD_ID`, `EVENT_NAME`, `EVENT_HEAD_EMAIL`, `PLACE`, `DESCRIPTION`, `THUMBNAIL`, `EVENT_START_DATE`, `EVENT_END_DATE`) VALUES (
                '$eventHeadId',
                '$name',
                '$eventHeadEmail',
                '$location',
                '$description',
                '$eventThumbnail',
                '$startDate',
                '$endDate'
            )";
            $result = $this->db->query($query);
            if ($result) {
                return true;
            } else {
                throw new Exception("Error: " . $this->db->error);
            }
        } else {
            throw new Exception("All fields are required");
        }
    }

    public function addSubEvents(
        $event_id,
        $sub_event_name,
        $category,
        $subEventHeadID,
        $sub_event_description,
        $thumbnailDestination,
        $sub_event_datetime,
        $sub_event_location,
    ) {
        $query = "INSERT INTO `subevents`(`EVENT_ID`, `SUB_EVENT_NAME`, `CATEGORY`,`SUB_EVENT_HEAD`,`SUB_EVENT_DESCRIPTION`, `THUMBNAIL`, `SUB_EVENT_DATE`, `SUB_EVENT_LOCATION`) VALUES (
            '$event_id',
            '$sub_event_name',
            '$category',
            '$subEventHeadID',
            '$sub_event_description',
            '$thumbnailDestination',
            '$sub_event_datetime',
            '$sub_event_location'
            )";
        $result = $this->db->query($query);
        if ($result) {
            return true;
        } else {
            throw new Exception(
                "Error: " . mysqli_error($this->db)
                //$subEventName,
                // $category,
                // $subEventHeadID,
                // $subEventDescription,
                // $subEventThumbnail,
                // $subEventDateTime,
                // $subEventLocation
            );
        }
    }

    public function getSubEventDetails()
    {
        $query = "SELECT * FROM `subevents`";
        $result = $this->db->query($query);
        if ($result) {
            return $result;
        } else {
            throw new Exception("Error: " . mysqli_error($this->db));
        }
    }

    public function filterSubEvents($tagName)
    {
        try {
            $tagID = $this->getTagID($tagName);
            $query = "SELECT * FROM `tags` INNER JOIN subevents ON tags.ID = '$tagID' = subevents.CATEGORY = '$tagID'";
            $result = $this->db->query($query);
            if ($result) {
                return $result;
            } else {
                throw new Exception("Error: " . mysqli_error($this->db));
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getTags()
    {
        $query = "SELECT * FROM `tags`";
        $result = $this->db->query($query);
        if ($result) {
            return $result;
        } else {
            throw new Exception("Error: " . mysqli_error($this->db));
        }
    }

    public function getTagID($tagName)
    {
        $query = "SELECT * FROM `tags` WHERE `TAG_NAME` = '$tagName'";
        $result = $this->db->query($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['ID'];
        } else {
            throw new Exception("Error: " . mysqli_error($this->db));
        }
    }

    public function getEvents($email)
    {
        $query = "SELECT EVENT_NAME, EVENT_ID FROM `events` WHERE EVENT_HEAD_EMAIL = '$email'";
        if ($result = $this->db->query($query)) {
            $events = array();
            while ($row = $result->fetch_assoc()) {
                $events[] = $row;
            }
            return $events;
        } else {
            throw new Exception("Error: " . $this->db->error);
        }
    }

    public function getSubEventHeads($organization, $heademail, $eventName)
    {
    }

    public function getEventID($eventName)
    {

        $query = "SELECT EVENT_ID AS ID FROM `events` WHERE EVENT_NAME = '$eventName'";
        if ($result = $this->db->query($query)) {
            $row = $result->fetch_assoc();
            return var_dump($eventName);
        } else {
            throw new Exception("Error: " . $this->db->error);
        }
    }
}
