<?php

session_start();
//Block warning from php
error_reporting(E_ERROR | E_PARSE);
$path = $_SERVER['REQUEST_URI'];
$pageName = str_replace('optimized-event-manager/', '', $path);


if ($pageName == '/' || $pageName == '/home') {
    include_once 'templates/home.php';
} else if ($pageName == '/index' || $pageName == '/index.php') {
    include_once 'templates/home.php';
} else if ($pageName == '/events' || $pageName == '/event.php') {
    include_once 'templates/events.php';
} else if ($pageName == '/about' || $pageName == '/about.php') {
    include_once 'templates/about.php';
} else if ($pageName == '/contact' || $pageName == '/contact.php') {
    include_once 'templates/contact.php';
} else if ($pageName == '/login' || $pageName == '/login.php' || $pageName == '/login?invalidUserOrPassword') {
    //allow user if only his cookie is saved 
    $userData = json_decode($_COOKIE['userData'], true);
    if(isset($userData['id']) && !empty(isset($userData['id']))){
        header('Location: /optimized-event-manager/dashboard');
    }
    else{
        include_once 'Modules/includes/db.php';
        include_once 'Modules/Auth/LoginManager.php';
        include_once 'templates/Auth/login.php';
    }

    
} else if ($pageName == '/register' || $pageName == '/register.php') {
    $userData = json_decode($_COOKIE['userData'], true);
    if(isset($userData['id']) && !empty(isset($userData['id']))){
        header('Location: /optimized-event-manager/dashboard');
    }
    else{
        include_once 'Modules/includes/db.php';
        include_once 'Modules/Auth/RegisterManager.php';
        include_once 'templates/Auth/register.php';
    }
    
} 
else if ($pageName == '/dashboard' || $pageName == '/dashboard.php') {
    $userData = json_decode($_COOKIE['userData'], true);
        if (isset($userData['id']) && !empty(isset($userData['id']) && $userData['usertype'] == 'USER')) {
                include_once 'Modules/includes/db.php';
                include_once 'templates/dashboard.php';
        } else {
            header('Location: /optimized-event-manager/login');
        }
    
     
}
else if ($pageName == '/head-login' || $pageName == '/head-login.php' || $pageName == '/head-login?invalidUserOrPassword') {
    $data = $_COOKIE['headUser'];

    if (isset($data['id']) && !empty(isset($data['id']))) {
        include_once 'Modules/includes/db.php';
        include_once 'templates/event-heads/event-head.php';
    } else {
        include_once 'Modules/includes/db.php';
        include_once 'Modules/Auth/LoginManager.php';
        include_once 'templates/Auth/head-login.php';
    }
}
else if ($pageName = '/head-register' || $pageName == '/head-register.php') {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include_once 'Modules/includes/db.php';
        include_once 'templates/event-heads/event-head.php';
    } else {
        include_once 'Modules/includes/db.php';
        include_once 'Modules/Auth/RegisterManager.php';
        include_once 'templates/Auth/head-register.php';
    }
}
 else if ($pageName == '/event-head' || $pageName == '/event-head.php') {
    $data = json_decode($_COOKIE['headUser'], true);
   
        if (isset($data['id']) && !empty(isset($data['id']) && $data['usertype'] == 'EVENT_HEAD')) {
            include_once 'Modules/includes/db.php';
            include_once 'templates/event-heads/event-head.php';
        } else {
            echo "Please Login <a href= 'head-login.php'>Here</a>";
        }
    
} else if ($pageName == '/add-event' || $pageName == '/add-event.php') {
    header('Location: /');
}
// else if($pageName == '/manage-event' || $pageName == '/manage-event.php'){
//     $data = json_decode($_COOKIE['headUser'], true);
//     if (isset($data['id']) && !empty(isset($data['id']))) {
//         include_once 'Modules/includes/db.php';
//         include_once 'templates/event-heads/manage-event.php';
//     } else {
//         echo "Please Login <a href= 'head-login.php'>Here</a>";
//     }
// }
 else {
    include_once 'templates/404.php';
}
    

//     // else if($pageName == '/tempage' || $pageName == '/tempage.php'){
//     //     // include_once 'Modules/includes/db.php';
//     //     // include_once 'Modules/Event/EventManager.php';
//     //     include_once 'templates/event-heads/add-event.php';
//     //     // if(isset($_SESSION['EH_email'])){
//     //     //     include_once 'Modules/includes/db.php';
//     //     //     include_once 'Modules/Event/EventManager.php';
//     //     //     include_once 'templates/event-heads/add-event.php';
//     //     // }
//     //     // else{
//     //     //     echo "here";
//     //     // }
//     // }
?>