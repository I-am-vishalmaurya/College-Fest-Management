<?php 
    class OrganizationManager{
        public $error;
        private static $instance = null;
        public static function getInstance(){
            if(!self::$instance instanceof self){
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
            trigger_error('Clone is not allowed.', E_USER_ERROR);
        }

        public function __wakeup()
        {
            trigger_error('Deserializing is not allowed.', E_USER_ERROR);
        }

        public function addOrganization($email,$orgname){
            $orgResult = $this->verifyOrgName($orgname);
            if($orgResult){
                throw new Exception("Organization name already exists " . $orgname);
            }
            else{
                $org_admin_id = $this->loginManager->getHeadID($email);
                $query = "INSERT INTO organizations(`ORG_NAME`, `ORG_ADMIN_ID`) VALUES(
                    '$orgname',
                    '$org_admin_id'
                )";
                
                if($this->db->query($query)){
                    return true;
                }
                else{
                    throw new Exception("Error: Organization not added");
                }
                
            }
        }

        public function updateHeadDetails($org_id,$id){
            
            $query = "UPDATE `event_heads` SET `ORG_ID` = '$org_id', `ORG_STATUS` = 'ADMIN' WHERE `event_heads`.`ID` = $id;";
            if($this->db->query($query)){
                return true;
            }
            else{
                throw new Exception("Error: Organization not updated");
            }
        }

        public function inviteToOrganization($eventHeadID, $toInviteEmail){
            $checkInvitedHeadEmailExist = $this->loginManager->getHeadID($toInviteEmail);
            try{
                $joiningOrganizationName = $this->getOrganizationHeadDetails($eventHeadID);
                $org_id = $this->getOrganizationID($joiningOrganizationName['ORG_NAME']);
                $org_id = $org_id['ORG_ID'];
                if(isset($checkInvitedHeadEmailExist)){
                    $result = $this->getHeadDetailNotInOrganization($toInviteEmail);
                    if(mysqli_num_rows($result) > 0){
                        if(isset($org_id)){
                            $query = "UPDATE `event_heads` SET `ORG_ID` = '$org_id', `ORG_STATUS` = 'PENDING' WHERE `event_heads`.`ID` = '$checkInvitedHeadEmailExist'" ;
                            if($this->db->query($query)){
                                return true;
                            }
                            else{
                                throw new Exception("Error: Invitation not sent" . $this->db->error);
                            }
                        }
                        else{
                            throw new Exception("Error: Organization not found" . var_dump($org_id));
                        }
                        
                    }
                    else{
                        throw new Exception("The user has pending requests");
                    }
                }
                else{
                    throw new Exception('Error: The Invited person is not joined as event head');
                }
            }catch(Exception $e){
                throw new Exception("Error: " . $e->getMessage());
            }
            
            
        }
        public function joinOrganization($id){
            $getDetails = $this->loginManager->getHeadInfo($id);
            if($getDetails['ORG_STATUS'] == 'PENDING'){
                $query = "UPDATE `event_heads` SET `ORG_STATUS` = 'JOINED' WHERE `event_heads`.`ID` = '$id'";
                if($this->db->query($query)){
                    return $this->db->query($query);
                }
                else{
                    throw new Exception("Error: Organization not joined");
                }
            }
            elseif($getDetails['ORG_STATUS'] == 'JOINED'){
                throw new Exception("Error: Already joined");
            }
            else{
                throw new Exception("Error: " . $this->db->error);
            }
        }

        public function getMemberOfOrganization($org_id){
            $query = "SELECT * FROM event_heads WHERE event_heads.ORG_ID = '$org_id'";
            $result = $this->db->query($query);
            if($result){
                return $result;
            }
            else{
                throw new Exception("Error: " . $this->db->error);
            }
           
            
        }

        public function getOrganizationIDHelper($headID){
            $query = "SELECT * FROM `organizations` WHERE ORG_ADMIN_ID = $headID";
            $result = $this->db->query($query);
            if($result){
                return $result;
            }
            else{
                throw new Exception("Error: " . $this->db->error);
            }
        }

        public function getAllDetailsOfOrganizations($org_id){
            $query = "SELECT * FROM `organizations` INNER JOIN event_heads WHERE organizations.ORG_ID = '$org_id' AND event_heads.ORG_ID = '$org_id'";
            $result = $this->db->query($query);
            if($result){
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            else{
                throw new Exception("Error: " . $this->db->error);
            }
        }

        public function getDetailsOfHeads($headID){
            $query = "SELECT * FROM `event_heads` INNER JOIN organizations WHERE `ID` = '$headID'";
            $result = $this->db->query($query);
            if($result){
                return $result;
            }
            else{
                throw new Exception("Error: " . $this->db->error);
            }
        }
        public function getOrganizationID($orgName){
            $query = "SELECT `ORG_ID` FROM `organizations` WHERE `ORG_NAME` = '$orgName'";
            $result = $this->db->query($query);
            if($result){
                $row = $result->fetch_assoc();
                return $row;
            }
            else{
                throw new Exception("Error: Organization ID not found");
            }

        }

        public function getOrganizationBasedOnHeadID($headID){
            $query = "SELECT organizations.ORG_ID FROM `organizations` INNER JOIN event_heads ON organizations.ORG_ADMIN_ID = '$headID'= event_heads.ID = '$headID'";
            $result = $this->db->query($query);
            if($result){
                $row = $result->fetch_assoc();
                return $row;
            }
            else{
                throw new Exception("Error: Organization ID not found");
            }
        }
        // fUNCTION TO GET ORGANIZATION HEAD DETAILS WITH HEAD ID (ADMIN ID)
        public function getOrganizationHeadDetails($headID){
            $query = "SELECT * FROM `organizations` INNER JOIN event_heads ON organizations.ORG_ADMIN_ID = event_heads.ID WHERE event_heads.ID = '$headID'";
            $result =  $this->db->query($query);
            if($result){
                return $result->fetch_assoc();
            }
            else{
                throw new Exception("Error: Organization not found" . $this->db->error);
            }
        }
        // FUNCTION FOR PENDING REQUEST
        public function showDetailsToInvitedHead($org_id){
            $query = "SELECT event_heads.EH_NAME, organizations.ORG_NAME FROM `event_heads` INNER JOIN organizations WHERE event_heads.ORG_ID = '$org_id' AND organizations.ORG_ID = '$org_id' AND event_heads.ORG_STATUS = 'ADMIN'";
            $result = $this->db->query($query);
            if($result){
                return $result->fetch_assoc();
            }
            else{
                throw new Exception("Error: " . $this->db->error);
            }
        }

        public function getSubEventHeadDetails(){
            $query = "SELECT * FROM `subevent_head_details` INNER JOIN organizations ON subevent_head_details.ORGANIZATION = organizations.ORG_ID";
            return $this->db->query($query);
        }

        public function getHeadDetailNotInOrganization($email){
            $query = "SELECT * FROM event_heads WHERE event_heads.ORG_STATUS IS NULL AND event_heads.ORG_ID IS NULL AND event_heads.EH_EMAIL = '$email'";
            $result = $this->db->query($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }
        public function verifyOrgName($orgname){
            $query = "SELECT * FROM `organizations` WHERE ORG_NAME = '$orgname'";
            $result = $this->db->query($query);
            if($result->num_rows > 0){
                return true;
            }
            else{
                return false;
            }
        }
        public function getOrganizationssdetails($headID){
            $query = "SELECT * FROM `organizations` WHERE ORG_ADMIN_ID = '$headID'";
            $result = $this->db->query($query);
            if($result){
                return $result;
            }
            else{
                throw new Exception("Error: " . $this->db->error);
            }
        }

        public function deleteOrgHead($delete_head_id){
            $query = "UPDATE `event_heads` SET `ORG_ID` = NULL, `ORG_STATUS` = NULL WHERE `event_heads`.`ID` = $delete_head_id";
            if($this->db->query($query)){
                return true;
            }
            else{
                throw new Exception("Error: " . $this->db->error);
            }
        }


    }

?>