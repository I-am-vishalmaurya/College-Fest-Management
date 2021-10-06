<?php
$data = json_decode($_COOKIE['headUser'], true);
$message = null;
$error = null;
$messageInvitation = null;
$orgManager = new OrganizationManager();
// try{
//     $result = $orgManager->getOrganizationHeadDetails($headID);
//     if($result){
//         $orgHeadDetails = $result;
//     }
// }
// catch(Exception $e){
//     $errorWhileJoining = $e->getMessage();
// }
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['addorganization'])) {
        $organization = $_POST['organization'];
        $head_email = $data['email'];
        if (!empty($organization)) {
            
            try {
                $result = $orgManager->addOrganization($head_email, $organization);
                //$result = $orgManager->verifyOrgName($organization);
                if ($result) {
                    header("location: organization?status=orgadded");
                } else {
                    header("location: organization?status=orgaddfailed");
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
    }
    elseif (isset($_POST['inviteHeads'])) {
        $invitedHeadEmail = $_POST['email'];
        $eventHeadID = $data['id'];
        if(!empty($invitedHeadEmail)){
            try{
                $result = $orgManager->inviteToOrganization($eventHeadID, $invitedHeadEmail);
                if($result){
                    
                    header("location: organization?status=sent");
                }
                else{
                    
                    header("location: organization?status=error");
                }
                echo "here";
            }
            catch(Exception $e){
                $error = $e->getMessage();
            }
        }
    }
    elseif(isset($_POST['joinOrganization'])){
        $headID = $data['id'];
        
        try{
            $result = $orgManager->joinOrganization($headID);
            if($result){
                header("location: organization?status=joined");
            }
            else{
                header("location: organization?status=notjoined");
            }
        }catch(Exception $e){
            $errorWhileJoining = $e->getMessage();
        }
    
    }
    else{
        echo "No button clicked";
    }
}
else{
    echo "Not Post";
}
