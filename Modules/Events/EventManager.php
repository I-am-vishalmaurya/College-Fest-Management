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
                    throw new Exception("File size is too big");
                }
            } else {
                 throw new Exception("There was an error uploading your file");
            }
        } else {
            throw new Exception("You cannot upload files of this type");
        }
    }
    public function addEvent($eventName, $eventHeadEmail, $eventStartDate, $EventEndDate, $eventLocation, $eventDescription, $thumbnail)
    {
        $eventHeadId = $this->loginManager->getHeadID($eventHeadEmail);
        $name = ($eventName);
        $startDate = $eventStartDate;
        $endDate = $EventEndDate;
        $location =($eventLocation);
        $description = ($eventDescription);
        $eventThumbnail = $thumbnail;
        if(!empty($eventHeadId) || !empty($name) || !empty($startDate) || !empty($endDate) || !empty($location) || !empty($description) || !empty($eventThumbnail)){
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
        }
        else{
            throw new Exception("All fields are required");
        }
        
    }
}
