<?php

session_start();
//Block warning from php
error_reporting(E_ERROR | E_PARSE);
$path = $_SERVER['REQUEST_URI'];
$pageName = str_replace('optimized-event-manager/', '', $path);


if ($pageName == '/' || $pageName == '/home') {
    include 'templates/home.php';
} else if ($pageName == '/index' || $pageName == '/index.php') {
    include 'templates/home.php';
} else if ($pageName == '/events' || $pageName == '/event.php') {
    include 'templates/events.php';
} else if ($pageName == '/about' || $pageName == '/about.php') {
    include 'templates/about.php';
} else if ($pageName == '/contact' || $pageName == '/contact.php') {
    include 'templates/contact.php';
} else if ($pageName == '/login' || $pageName == '/login.php' || $pageName == '/login?invalidUserOrPassword') {
    //allow user if only his cookie is saved 
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']))) {
        header('Location: /optimized-event-manager/dashboard');
    } else {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'templates/Auth/login.php';
    }
} else if ($pageName == '/register' || $pageName == '/register.php') {
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']))) {
        header('Location: /optimized-event-manager/dashboard');
    } else {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/RegisterManager.php';
        include 'templates/Auth/register.php';
    }
} else if ($pageName == '/dashboard' || $pageName == '/dashboard.php') {
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']) && $userData['usertype'] == 'USER')) {
        include 'Modules/includes/db.php';
        include 'templates/dashboard.php';
    } else {
        header('Location: /optimized-event-manager/login');
    }
} else if (
    $pageName == '/add-event'
    || $pageName == '/add-event.php'
    || $pageName == '/add-event?eventAddedSuccessfully'
    || $pageName == '/add-event?eventAddedFailed'
) {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']) && $data['usertype'] == 'EVENT_HEAD')) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/EventManager.php';
        include 'templates/event-heads/add-event.php';
    } else {
        header('Location: /optimized-event-manager/head-login');
    }
}


// Further routing section is for event heads
else if (
    $pageName == '/add-subevent'
    || $pageName == '/add-subevent.php'
    || $pageName == '/add-subevent?eventAddedSuccessfully'
    || $pageName == '/add-subevent?eventAddedFailed'
) {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']) && $data['usertype'] == 'EVENT_HEAD')) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/EventManager.php';
        include 'templates/event-heads/add-subevents.php';
    } else {
        header('Location: /optimized-event-manager/head-login');
    }
}

else if ($pageName == '/head-login' || $pageName == '/head-login.php' || $pageName == '/head-login?invalidUserOrPassword') {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'templates/event-heads/event-head.php';
    } else {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'templates/Auth/head-login.php';
    }
}
else if ($pageName == '/event-head' || $pageName == '/event-head.php') {
    $data = json_decode($_COOKIE['headUser'], true);

    if (isset($data['id']) && !empty(isset($data['id']) && $data['usertype'] == 'EVENT_HEAD')) {
        include 'Modules/includes/db.php';
        include 'templates/event-heads/event-head.php';
    } else {
        echo "Please Login <a href= 'head-login.php'>Here</a>";
    }
} 
else if ( $pageName = '/organization' || $pageName = '/organization.php') {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']) && $data['usertype'] == 'EVENT_HEAD')) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Organization/OrganizationManager.php';
        include 'templates/event-heads/organization.php';
    }
    else {
        header('Location: /optimized-event-manager/head-login');
    }
}
else if ($pageName = '/head-register' || $pageName == '/head-register.php') {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'templates/event-heads/event-head.php';
    } else {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/RegisterManager.php';
        include 'templates/Auth/head-register.php';
    }
} 

// Further section is for adding the events 

// else if($pageName == '/manage-event' || $pageName == '/manage-event.php'){
//     $data = json_decode($_COOKIE['headUser'], true);
//     if (isset($data['id']) && !empty(isset($data['id']))) {
//         include 'Modules/includes/db.php';
//         include 'templates/event-heads/manage-event.php';
//     } else {
//         echo "Please Login <a href= 'head-login.php'>Here</a>";
//     }
// }
else {
    include 'templates/404.php';
}
    

//     // else if($pageName == '/tempage' || $pageName == '/tempage.php'){
//     //     // include 'Modules/includes/db.php';
//     //     // include 'Modules/Event/EventManager.php';
//     //     include 'templates/event-heads/add-event.php';
//     //     // if(isset($_SESSION['EH_email'])){
//     //     //     include 'Modules/includes/db.php';
//     //     //     include 'Modules/Event/EventManager.php';
//     //     //     include 'templates/event-heads/add-event.php';
//     //     // }
//     //     // else{
//     //     //     echo "here";
//     //     // }
//     // }
