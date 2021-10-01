<?php 




require_once __DIR__ . "./vendor/autoload.php";

use App\Handler\Contact;
use App\Router;

$router = new Router();

$router -> get("/", function(){
    require_once 'templates/home.php';
});
$router -> get("/events", function(){
    include 'Modules/includes/db.php';
    include 'Modules/Auth/LoginManager.php';
    include 'Modules/Events/EventManager.php';

    require_once 'templates/events.php';
});

$router -> get("/about", function(array $params = []){
    echo "About Page";
    if(!empty($params['username'])){
        echo '<h1> Hello' . $params['username'] . '</h1>';
    }
    else{
        echo "Hello";
    }
    
});
// ************************* Start User Functionality *********************************
// User Login Routing
$router -> get("/login", function(array $params = []){
    if(!empty($params['status'])){
        if($params['status'] === 'userAlreadyExist'){
            echo "User Already Exists";
            require_once 'templates/Auth/login.php';
        }
        elseif($params['status'] === 'registrationSuccessful'){
            echo "Registration Successful Please Login.";
            require_once 'templates/Auth/login.php';
        }
    }
    else{
        require_once 'templates/Auth/login.php';
    }
    
});

$router -> post("/login", function(){
    include 'Modules/includes/db.php';
    include 'Modules/Auth/LoginManager.php';
    include 'src/Authentication/login.php';
});

$router -> get("/dashboard", function(){
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']))) {
        require_once 'templates/dashboard.php';
    }
    else{
        header("location: /login");
    }
});
// User Register Routing
$router -> get("/register", function(){
    include 'templates/Auth/register.php';
});

$router -> post("/register", function(){
    include 'Modules/includes/db.php';
    include 'Modules/Auth/RegisterManager.php';
    include 'src/Authentication/register.php';
});

// *********************** User functionality Done **********************************

// ************************ Event Head Functionality Start **************************
// Head Authentications
$router -> get('/head-login', function(){
    if(!empty($params['status'])){
        if($params['status'] === 'userAlreadyExist'){
            echo "Head Already Exists";
            require_once 'templates/Auth/head-login.php';
        }
        elseif($params['status'] === 'registrationSuccessful'){
            echo "Registration Successful Please Login.";
            require_once 'templates/Auth/head-login.php';
        }
    }
    else{
        require_once 'templates/Auth/head-login.php';
    }
    
});

$router -> post('/head-login', function(){
    include 'Modules/includes/db.php';
    include 'Modules/Auth/LoginManager.php';
    include 'src/Authentication/head-login.php';
});

$router -> get('/event-head', function(){
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        require_once 'templates/event-heads/event-head.php';
    }
    else{
        header("location: /head-login");
    }
});

$router -> get('/head-register', function(){
    require_once 'templates/Auth/head-register.php';
});

$router -> post('/head-register', function(){
    include 'Modules/includes/db.php';
    include 'Modules/Auth/RegisterManager.php';
    require_once 'src/Authentication/head-register.php';
});

// Head Profiles
$router -> get('/profile', function(){
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Organization/OrganizationManager.php';
        require_once 'templates/event-heads/viewProfile.php';
    }
    else{
        header("location: /head-login");
    }
});

// Head Organization
$router -> get('/organization', function(array $params = []){
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']) && $data['usertype'] == 'EVENT_HEAD')) {
        if(!empty($params['status'])){
            if($params['status'] === 'sent'){
                echo "Invitation Sent";
                require_once 'templates/event-heads/organization';
            }
            elseif($params['status'] === 'error'){
                echo "Invitation Not Sent";
                require_once 'templates/event-heads/organization.php';
            }
            elseif($params['status'] === 'joined'){
                echo "Joined Successfully";
                require_once 'templates/event-heads/organization.php';
            }
            elseif($params['status'] === 'notjoined'){
                echo "Not Joined";
                require_once 'templates/event-heads/organization.php';
            }
            elseif($params['status'] === 'orgadded'){
                echo "Organization Added";
                require_once 'templates/event-heads/organization.php';
            }
            elseif($params['status'] === 'orgaddfailed'){
                echo "Organization Add Failed";
                require_once 'templates/event-heads/organization.php';
            }
        }
        else{
            require_once 'templates/event-heads/organization.php';
        }
        
    }
    else{
        header("location: /head-login");
    }
});

$router -> post('/organization', function(){
    include 'Modules/includes/db.php';
    include 'Modules/Auth/LoginManager.php';
    include 'Modules/Organization/OrganizationManager.php';
    require_once 'src/Organizations/organization.php';
});
// ************************ Event Head Functionality Done *******************************
// $router -> get("/contact", Contact::class. '::execute');

// $router -> post("/contact", function($params){
//     var_dump($params);
// });
$router -> addNotFoundHandler(function(){
    require_once 'templates/404.php';
});

$router->run();