<?php

require_once "initialize.php";

if (!empty($_POST)) {
    $userObj = null;

    if ($_POST["action"] == "Log In"){
        die(" log in ");
    }
    else if ($_POST["action"] == "Sign Up"){
        $userObj = new User
    }
    redirectToHome();
}
else if($_SERVER['QUERY_STRING'] == "login")
    require_once 'Views/loginForm.php';

else if($_SERVER['QUERY_STRING'] == "register")
    require_once 'Views/registerForm.php';