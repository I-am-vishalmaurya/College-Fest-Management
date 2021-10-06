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
}


?>