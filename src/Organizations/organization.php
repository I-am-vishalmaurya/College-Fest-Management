<?php
require_once 'Modules/Organization/OrganizationManager.php';

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
    if (isset($_POST['invitemembertorganization'])) {
        
        $invitedHeadEmail = $_POST['email'];
        $HEAD_ID = $data['id'];
        
        if(!empty($invitedHeadEmail)){
            
            try{
                $result = $orgManager->inviteToOrganization($HEAD_ID, $invitedHeadEmail);
                var_dump($result);
                if($result){
                    header("location: organization?status=sent" . $result);
                }
                else{
                    header("location: organization?status=error");
                }
            }
            catch(Exception $e){
                echo $error = $e->getMessage();
            }
        }
        else{
            echo $error = "Please enter email";
        }
    }
    elseif (isset($_POST['addorganization'])) {
        $organization = $_POST['organization'];
        $head_email = $data['email'];
        $id = $data['id'];
        if (!empty($organization)) {
            
            try {
                $result = $orgManager->addOrganization($head_email, $organization);
                $org_id = $orgManager->getOrganizationssdetails($id);
                $org_result = mysqli_fetch_assoc($org_id);
                try{
                    $result2 = $orgManager->updateHeadDetails($org_result['ORG_ID'], $id);
                    if ($result2) {
                        header("location: organization?status=orgadded");
                    } else {
                        echo "here";
                        header("location: organization?status=orgaddfailed");
                    }
                }
                catch(Exception $e){
                    echo $errorWhileJoining = $e->getMessage();
                }
                //$result = $orgManager->verifyOrgName($organization);
                
            } catch (Exception $e) {
                echo $error = $e->getMessage();
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
    
    elseif(isset($_POST['deleteOrgHead'])){
        $head_id = $data['id'];
        $delete_head_id = $_POST['id'];
        if($head_id == $delete_head_id){
            header("location: organization?status=cannotdelete");
        }
        else{
            try{
                $result = $orgManager->deleteOrgHead($delete_head_id);
                if($result){
                    header("location: organization?status=deleted");
                }
                else{
                    header("location: organization?status=notdeleted");
                }
            }catch(Exception $e){
                $errorWhileJoining = $e->getMessage();
            }
        }
        
    }
}
    
else{
    echo "Not Post";
}
