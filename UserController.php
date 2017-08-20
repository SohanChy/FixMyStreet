<?php

require_once "initialize.php";
require_once "Helpers/validateForm.php";

$message = "";
$error = "";
$errorMessage = "";

if ($_SERVER['QUERY_STRING'] == "logout") {
    if ($curUser) {
        $curUser->rememberToken(true);
        $curUser = false;
    }
    if (isset($_COOKIE["token"]) && !empty($_COOKIE["token"])) {
        setcookie("token", "", time() - 1); //cookie expired
    }
    if (isset($_SESSION["curUser"]) && !empty($_SESSION["curUser"])) {
        unset($_SESSION["curUser"]);
        session_destroy();
    }
    require_once 'Views/loginForm.php';
}
elseif ($curUser) {
    redirectToHome();
}
elseif ($_SERVER['QUERY_STRING'] == "login") {
    require_once 'Views/loginForm.php';
}
elseif ($_SERVER['QUERY_STRING'] == "register") {
    require_once 'Views/registerForm.php';
}
elseif (!empty($_POST) && $_SERVER['QUERY_STRING'] == "") {
    $userObj = null;

    if ($_POST["action"] == "Log In") {
        if (validateLogInForm()) {
            $userObj = User::findByEmailOrMobile($_POST["data"]);
            
            if ($userObj) {
                if ($userObj->verifyPassword($_POST["pass"])) {
                    $token = $userObj->rememberToken();
                    $_SESSION["curUser"] = $userObj;

                    if ($_POST["remember"] && $token) {
                        setcookie("token", $token, time() + 86400); //86400 1 day
                    }
                    redirectToHome();
                }
                else {
                    $error = "pass";
                    $errorMessage = "Password doesn't match";
                }
            }
            else {
                $error = "data";
                $errorMessage = "User not found";
            }
        }
        require_once 'Views/loginForm.php';
    } 
    elseif ($_POST["action"] == "Sign Up") {
        if (validateRegForm()) {
            if (User::findByEmailOrMobile($_POST["email"])) {
                $error = "email";
                $errorMessage = "This email is already registered";
            }
            elseif (User::findByEmailOrMobile($_POST["mobile"])) {
                $error = "mobile";
                $errorMessage = "This mobile is already registered";
            }
            else {
                $userObj = new User(
                    $_POST["name"],
                    $_POST["mobile"],
                    $_POST["email"],
                    $_POST["address"],
                    $_POST["pass"]
                );
                $userObj->save();
                $message = "Registration Successful. You may Log In now";
                require_once 'Views/loginForm.php';
                exit();
            }
        }
        require_once 'Views/registerForm.php';
    }    
}
else {
    redirectToHome();
}