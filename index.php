<?php




require_once __DIR__ . "./vendor/autoload.php";

use App\Handler\Contact;
use App\Router;

$router = new Router();

$router->get("/", function () {
    require_once 'templates/home.php';
});
$router->get("/events", function () {
    include 'Modules/includes/db.php';
    include 'Modules/Auth/LoginManager.php';
    include 'Modules/Events/EventManager.php';

    require_once 'templates/events.php';
});

$router->get("/about", function (array $params = []) {
    echo "About Page";
    if (!empty($params['username'])) {
        echo '<h1> Hello' . $params['username'] . '</h1>';
    } else {
        echo "Hello";
    }
});
// ************************* Start User Functionality *********************************
// User Login Routing
$router->get("/login", function (array $params = []) {
    if (!empty($params['status'])) {
        if ($params['status'] === 'userAlreadyExist') {
            echo "User Already Exists";
            require_once 'templates/Auth/login.php';
        } elseif ($params['status'] === 'registrationSuccessful') {
            echo "Registration Successful Please Login.";
            require_once 'templates/Auth/login.php';
        }
    } else {
        require_once 'templates/Auth/login.php';
    }
});

$router->post("/login", function () {
    include 'Modules/includes/db.php';
    include 'Modules/Auth/LoginManager.php';
    include 'src/Authentication/login.php';
});

$router->get("/dashboard", function () {
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/EventManager.php';
        include 'Modules/Events/SubEvents.php';
        require_once 'templates/users/dashboard.php';
    } else {
        header("location: /login");
    }
});
// User Register Routing
$router->get("/register", function () {
    include 'templates/Auth/register.php';
});

$router->post("/register", function () {
    include 'Modules/includes/db.php';
    include 'Modules/Auth/RegisterManager.php';
    include 'src/Authentication/register.php';
});

// User Forgot Password
$router->get('/forgot-password', function () {
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']))) {
        require_once 'templates/users/forgot-password.php';
    } else {
        header("location: /login");
    }
});

$router->post('/forgot-password', function () {
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']))) {
        require_once 'Modules/includes/db.php';
        require_once 'Modules/Auth/LoginManager.php';
        require_once 'src/Authentication/forgot-password.php';
    } else {
        header("location: /login");
    }
});
//User Functionality
$router->get('/view-profile', function () {
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']))) {

        require_once 'templates/users/viewProfile.php';
    } else {
        header("location: /login");
    }
});

$router->get('/all-event', function () {
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/EventManager.php';
        require_once 'templates/users/all-events.php';
    } else {
        header("location: /login");
    }
});

// User Joining the Event
$router->get('/join-subevent', function () {
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/SubEvents.php';
        require_once 'src/Events/join-subevent.php';
    } else {
        header("location: /login");
    }
});

$router->get('/unjoin-subevent', function () {
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/SubEvents.php';
        require_once 'src/Events/unjoin-subevent.php';
    } else {
        header("location: /login");
    }
});

$router->get('/save-subevent', function () {
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/SubEvents.php';
        require_once 'src/Events/save-subevent.php';
    } else {
        header("location: /login");
    }
});

$router->get('/schedule', function () {
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/SubEvents.php';
        require_once 'templates/users/event-schedule.php';
    } else {
        header("location: /login");
    }
});

$router->get('/saved', function () {
    $userData = json_decode($_COOKIE['userData'], true);
    if (isset($userData['id']) && !empty(isset($userData['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/SubEvents.php';
        require_once 'templates/users/saved.php';
    } else {
        header("location: /login");
    }
});
// *********************** User functionality Done **********************************

// ************************ Event Head Functionality Start **************************
// Head Authentications
$router->get('/head-login', function () {
    if (!empty($params['status'])) {
        if ($params['status'] === 'userAlreadyExist') {
            echo "Head Already Exists";
            require_once 'templates/Auth/head-login.php';
        } elseif ($params['status'] === 'registrationSuccessful') {
            echo "Registration Successful Please Login.";
            require_once 'templates/Auth/head-login.php';
        }
    } else {
        require_once 'templates/Auth/head-login.php';
    }
});

$router->post('/head-login', function () {
    include 'Modules/includes/db.php';
    include 'Modules/Auth/LoginManager.php';
    include 'src/Authentication/head-login.php';
});

$router->get('/event-head', function () {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        require_once 'templates/event-heads/event-head.php';
    } else {
        header("location: /head-login");
    }
});

$router->get('/head-register', function () {
    require_once 'templates/Auth/head-register.php';
});

$router->post('/head-register', function () {
    include 'Modules/includes/db.php';
    include 'Modules/Auth/RegisterManager.php';
    require_once 'src/Authentication/head-register.php';
});

// Head Profiles
$router->get('/profile', function () {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Organization/OrganizationManager.php';
        require_once 'templates/event-heads/viewProfile.php';
    } else {
        header("location: /head-login");
    }
});
// Event Adding and Managing Functionality
$router->get('/host-event', function () {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'templates/event-heads/host-event.php';
    } else {
        header("location: /head-login");
    }
});

$router->post('/host-event', function () {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Events/EventManager.php';
        include 'Modules/Auth/LoginManager.php';
        include 'src/Events/host-event.php';
        include 'templates/event-heads/host-event.php';
    } else {
        header("location: /head-login");
    }
});

$router->get('/add-subevent', function () {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/EventManager.php';
        include 'Modules/Organization/OrganizationManager.php';
        include 'templates/event-heads/add-subevent.php';
    } else {
        header("location: /head-login");
    }
});

$router->post('/add-subevent', function () {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/EventManager.php';
        include 'Modules/Organization/OrganizationManager.php';
        include 'src/Events/add-subevent.php';
    } else {
        header("location: /head-login");
    }
});

$router->get('/show-event', function () {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/EventManager.php';
        include 'templates/event-heads/show-event.php';
    } else {
        header("location: /head-login");
    }
});

$router->get('/update-subevent', function () {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/EventManager.php';
        include 'templates/event-heads/update-subevent.php';
    } else {
        header("location: /head-login");
    }
});

$router->get('/delete-subevent', function () {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/EventManager.php';
        include 'src/Events/delete-subevent.php';
    } else {
        header("location: /head-login");
    }
});

// Reports
$router->get('/report', function () {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/EventManager.php';
        include 'Modules/Organization/OrganizationManager.php';
        include 'templates/event-heads/report.php';
    } else {
        header("location: /head-login");
    }
});
// Head Organization
$router->get('/organization', function (array $params = []) {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']) && $data['usertype'] == 'EVENT_HEAD')) {
        //require_once 'Modules/Organization/OrganizationManager.php';
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Organization/OrganizationManager.php';
        require_once 'templates/event-heads/organization.php';
    } else {
        header("location: /head-login");
    }
});

$router->post('/organization', function () {
    include 'Modules/includes/db.php';
    include 'Modules/Auth/LoginManager.php';
    include 'Modules/Organization/OrganizationManager.php';
    require_once 'src/Organizations/organization.php';
});

// Report For Event Heads
$router->get('/report', function () {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/EventManager.php';
        include 'Modules/Events/SubEvents.php';
        require_once 'templates/event-heads/report.php';
    } else {
        header("location: /head-login");
    }
});

$router->get('/detail-report', function () {
    $data = json_decode($_COOKIE['headUser'], true);
    if (isset($data['id']) && !empty(isset($data['id']))) {
        include 'Modules/includes/db.php';
        include 'Modules/Auth/LoginManager.php';
        include 'Modules/Events/EventManager.php';
        include 'Modules/Events/SubEvents.php';
        require_once 'templates/event-heads/detail-report.php';
    } else {
        header("location: /head-login");
    }
});
//Logout
$router->get('/logout', function () {
    include 'templates/Auth/Logout.php';
});

// ************************ Event Head Functionality Done *******************************
// $router -> get("/contact", Contact::class. '::execute');

// $router -> post("/contact", function($params){
//     var_dump($params);
// });
$router->addNotFoundHandler(function () {
    require_once 'templates/404.php';
});

$router->run();
