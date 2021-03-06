<?php 

class SubEvents {
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
        // $this->loginManager = new LoginManager();
    }

    public function getSubEvents($headid){
        $sql = "SELECT * FROM `event_heads` INNER JOIN subevents ON event_heads.ID = '$headid' = subevents.SUB_EVENT_HEAD = '$headid'";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        else {
            var_dump($result);
            echo mysqli_error($this->db);
            //throw new Exception("No Sub Events Found" . mysqli_error($this->db));
        }
    }

    public function joinSubEvent($subeventid, $userID){
        $sql = "INSERT INTO `joined_events` (`SUB_EVENT_ID`, `USER_ID`) VALUES ('$subeventid', '$userID')";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        else {
            throw new Exception("Error Joining Sub Event" . mysqli_error($this->db));
        }
    }

    public function unJoinSubEvent($subeventid, $userID){
        $sql = "DELETE FROM `joined_events` WHERE `SUB_EVENT_ID` = '$subeventid' AND `USER_ID` = '$userID'";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        else {
            throw new Exception("Error Joining Sub Event" . mysqli_error($this->db));
        }
    }

    public function saveSubEvents($subeventid, $userID){
        $sql = "INSERT INTO `saved_events`(`SUB_EVENT_ID`, `USER_ID`) VALUES ('$subeventid', '$userID')";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        else {
            throw new Exception("Error Saving Sub Event" . mysqli_error($this->db));
        }

    }
    public function removeSaveSubEvents($subeventid, $userID){
        $sql = "DELETE FROM `saved_events` WHERE SUB_EVENT_ID = '$subeventid' AND USER_ID = '$userID'";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        else {
            throw new Exception("Error Saving Sub Event" . mysqli_error($this->db));
        }

    }

    public function getJoinedSubEventID($id){
        $sql = "SELECT * FROM `joined_events` WHERE `USER_ID` = '$id'";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        else {
            throw new Exception("Error Getting Saved Sub Event" . mysqli_error($this->db));
        }

    }

    public function getSavedSubEventID($id){
        $sql = "SELECT * FROM `saved_events` WHERE `USER_ID` = '$id'";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        else {
            throw new Exception("Error Getting Saved Sub Event" . mysqli_error($this->db));
        }

    }

    public function getJoinedSubEvents($subeventid){
        $sql = "SELECT * FROM `joined_events` INNER JOIN subevents ON joined_events.SUB_EVENT_ID = '$subeventid'";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        else {
            throw new Exception("No Saved Sub Events Found" . mysqli_error($this->db));
        }
    }

    public function getSubEventDetailsWithID($subeventid){
        $sql = "SELECT * FROM `subevents` WHERE subevents.SUB_EVENT_ID = '$subeventid'";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        else {
            throw new Exception("No Saved Sub Events Found" . mysqli_error($this->db));
        }
    }

    public function getNumberOfPeopleJoinedSubevent($id){
        $sql = "SELECT COUNT(*) FROM `joined_events` WHERE `SUB_EVENT_ID` = '$id'";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        else {
            throw new Exception("Error Getting Number of People Joined Sub Event" . mysqli_error($this->db));
        }
    }

    public function showPostedEvents($head_id)
    {
        $sql = "SELECT COUNT(*) FROM subevents WHERE SUB_EVENT_HEAD = $head_id";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        else {
            throw new Exception("No Sub Events Found" . mysqli_error($this->db));
        }
    }

    public function getJoinUserInfo($sub_event_id){
        $query = "SELECT NAME, EMAIL, PHONE FROM `users_details` INNER JOIN joined_events ON users_details.ID = joined_events.USER_ID WHERE joined_events.SUB_EVENT_ID = '$sub_event_id'";
        $result = $this->db->query($query);
        if ($result) {
            return $result;
        } else {
            throw new Exception("Error: " . mysqli_error($this->db));
        }
    }

    // Extra Liked Function 
    public function likedtheProject($userID){
        $sql = "INSERT INTO `liked_the_project`(USER_ID, LIKED) VALUES ('$userID', 1)";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        else {
            throw new Exception("Error Liking the Project" . mysqli_error($this->db));
        }
    }

    public function getLikedProject(){
        $sql = "SELECT * FROM `liked_the_project`";
        $result = $this->db->query($sql);
        if($result){
            return $result;
        }
        else {
            throw new Exception("No Liked Projects Found" . mysqli_error($this->db));
        }
    }
}


?>