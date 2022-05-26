<?php
require_once 'Modules/Organization/OrganizationManager.php';
require_once 'Modules/includes/db.php';
require_once 'Modules/Auth/LoginManager.php';
$orgManager = new OrganizationManager();
$headID = $data['id'];
global $orgHeadDetails;
// The head will be the admin of the organization
try {
    $result = $orgManager->getOrganizationHeadDetails($headID);
    if ($result) {
        
        $orgHeadDetails = $result;
    } else {
        // The head is not an organization admin
        $headDetails = $orgManager->getDetailsOfHeads($headID);
        if ($headDetails) {
            $orgHeadDetails = mysqli_fetch_assoc($headDetails);
        } else {
            $orgHeadDetails = null;
        }
    }
} catch (Exception $e) {
    $errorWhileJoining = $e->getMessage();
}
if(is_null($orgHeadDetails)){
    $orgDetails = null;
}
else{
   
    try {
        $details = $orgManager->getAllDetailsOfOrganizations($orgHeadDetails['ORG_ID']);
        if ($details) {
            $orgDetails = $details;
        } else {
            $orgDetails = null;
        }
    } catch (Exception $e) {
        $infoMemberofOrganization = $e->getMessage();
    }
}


$title = "Organization - Eventers";
$bodyColor = 'bg-white';
include 'templates/event-heads/header.php';
include 'templates/event-heads/navbar.php';
?>

<?php
    if(is_null($orgHeadDetails)){
        include 'templates/event-heads/organizations/organization-null.php';  
    }
    else{
        if ($headID === $orgHeadDetails['ORG_ADMIN_ID']) {
            include 'templates/event-heads/organizations/organization-invites.php';
            
        } else {
            
                if ($orgHeadDetails['ORG_STATUS'] === 'ADMIN') {
                    include 'templates/event-heads/organizations/organization-invites.php';
                } else if ($orgHeadDetails['ORG_STATUS'] === 'JOINED') {
                    include 'templates/event-heads/organizations/organization-joined.php';
                } else if ($orgHeadDetails['ORG_STATUS'] === 'PENDING') {
                    $org_id = $orgHeadDetails['ORG_ID'];    
                    $pendingResult = $orgManager->showDetailsToInvitedHead($org_id);
                    $org_name = ($pendingResult['ORG_NAME']);
                    $org_Admin_name = $pendingResult['EH_NAME'];
                    include 'templates/event-heads/organizations/organization-pending.php';
            
    }

}

}
?>


<!-- <div class="container">
    <h2>You are not part of organization yet</h2>
    <p>Your organization invites will show here</p>
    <div class="container">
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    You have been invited by <strong>VISHAL MAURYA</strong> <a href="#" class="alert-link">to join his organization.</a>
    <button class="btn btn-info btn-sm w-25">Join Now</button>
    </div>
    </div>
</div>
<div class="container">
    <h2>Create your own organization</h2>
    <p>You can create your own organization and invite your friends to join</p>
</div> -->

<?php
include_once 'templates/event-heads/footer.php';
?>