<?php 
session_start();
    $path = $_SERVER['REQUEST_URI'];
    $pageName = str_replace('optimized-event-manager/', '', $path);
    if($pageName == '/' || $pageName == '/home') {
        include 'templates/home.php';
    }
    else if($pageName == '/index' || $pageName == '/index.php'){
        include 'templates/home.php';
    }
    else if($pageName == '/events' || $pageName == '/event.php'){
        include 'templates/events.php';
    }
    else if($pageName == '/about' || $pageName == '/about.php'){
        include 'templates/about.php';
    }
    else if($pageName == '/contact' || $pageName == '/contact.php'){
        include 'templates/contact.php';
    }
    else if($pageName == '/login' || $pageName == '/login.php' || $pageName == '/login?invalidUserOrPassword'){
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'templates/Auth/login.php';
    }
    else if($pageName == '/register' || $pageName == '/register.php'){
        include 'Modules/includes/db.php';
        include 'Modules/Auth/RegisterManager.php';
        include 'templates/Auth/register.php';  
    }
    else if($pageName == '/head-login' || $pageName == '/head-login.php' || $pageName == '/head-login?invalidUserOrPassword'){
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'templates/event-heads/head-login.php';
    }
    else if($pageName == '/event-head' || $pageName == '/event-head.php'){
        if(isset($_SESSION['EH_email'])){
            include 'Modules/includes/db.php';
            include 'templates/event-heads/event-head.php';
        }
        else{
            echo "Please Login <a href= 'head-login.php'>Here</a>";
        }
       
    }
    else if($pageName ='//head-register' || $pageName == '/head-register.php'){
        include 'Modules/includes/db.php';
        include 'Modules/Auth/RegisterManager.php';
        include 'templates/event-heads/head-register.php';
    }


?>