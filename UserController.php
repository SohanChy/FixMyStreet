<?php

require_once "initialize.php";
require_once "Helpers/validateForm.php";

$message = "";
$error = "";
$errorMessage = "";

if (!empty($_POST) && $_SERVER['QUERY_STRING'] == "") {
    $userObj = null;

    if ($_POST["action"] == "Log In") {
        if (validateLogInForm()) {
            $userObj = User::findByEmailOrMobile($_POST["data"]);
            
            if ($userObj) {
                if ($userObj->verifyPassword($_POST["pass"])) {
                    saveSession($userObj);
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
elseif ($_SERVER['QUERY_STRING'] == "login") {
    require_once 'Views/loginForm.php';
}
elseif ($_SERVER['QUERY_STRING'] == "register") {
    require_once 'Views/registerForm.php';
}

function saveSession($userObj)
{
    $token = $userObj->rememberToken();
    if ($token) {
        redirectToHome();
    }
    else {
        $message = "Something went wrong. Plz try again";
    }
}