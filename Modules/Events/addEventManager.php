<?php 
    class addEventManager {
        public function __construct() {
            $this->db = new eventManagerDB();
            $this->getId = new LoginManager();
        }

        
        public function addEvent($eventHeadId, $eventName,$eventHeadEmail, $eventStartDate, $EventEndDate, $eventLocation, $eventDescription, $thumbnail){
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
            if($result){
                return true;
            }
            else{
                return false;
            }
        }
    }

?>