<?php
    //session_destroy();
    //header('Location: /optimized-event-manager');
    setcookie('headUser', '', time() - 15);
    setcookie('userData', '', time() - 15);
    header("location: /optimized-event-manager/login")
?>