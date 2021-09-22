<?php
include '../Auth/LoginManager.php';
class EventManager
{
    public  $error;
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
        $this->getId = new LoginManager();
    }

    public function __clone()
    {
        trigger_error('Clone not allowed.', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error('Deserializing not allowed.', E_USER_ERROR);
    }

    public function handleThumbnail($filename, $tempname, $fileSize, $fileError)
    {
        $fileExtension = explode(".", $filename);
        $fileActualExtension = strtolower(end($fileExtension));
        $allowedFileTypes = array("jpg", "jpeg", "png");
        if (in_array($fileActualExtension, $allowedFileTypes)) {
            if ($fileError === 0) {
                if ($fileSize <= 5242880) {
                    $newfileName = uniqid('', true) . "." . $fileActualExtension;
                    $fileDestination = 'global/eventThumbnails/events/' . $newfileName;
                    (move_uploaded_file($tempname, $fileDestination));
                    return $fileDestination;
                } else {
                    $this->error = "Your file is too big!";
                }
            } else {
                $this->error = "There was an error uploading your file!";
            }
        } else {
            $this->error = "You cannot upload files of this type!";
        }
    }
    public function addEvent($eventName, $eventHeadEmail, $eventStartDate, $EventEndDate, $eventLocation, $eventDescription, $thumbnail)
    {
        $eventHeadId = $this->getId->getHeadID($eventHeadEmail);
        $name = $this->db->real_escape_string($eventName);
        $startDate = $eventStartDate;
        $endDate = $EventEndDate;
        $location = $this->db->real_escape_string($eventLocation);
        $description = $this->db->real_escape_string($eventDescription);
        $eventThumbnail = $thumbnail;

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
            return false;
        }
    }
}
