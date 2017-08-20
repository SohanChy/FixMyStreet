<?php

require_once "initialize.php";
$message = "";
$error = "";
$errorMessage = "";

if (!empty($_POST) && $_SERVER['QUERY_STRING'] == "") {
    $userObj = null;

    if ($_POST["action"] == "Log In") {
        if (validateLogInForm($_POST["data"], $_POST["pass"])) {
            $userObj = User::findByEmailOrMobile($_POST["data"]);
            
            if ($userObj) {
                if ($userObj->verifyPassword($_POST["pass"])) {
                    $token = $userObj->rememberToken();
                    if ($token) {
                        redirectToHome();
                    }
                    else {
                        $message = "Something went wrong. Plz try again";
                    }
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
        if ($_POST["pass"] == $_POST["conPass"]) {
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
        }
    }
}
elseif ($_SERVER['QUERY_STRING'] == "login") {
    require_once 'Views/loginForm.php';
}
elseif ($_SERVER['QUERY_STRING'] == "register") {
    require_once 'Views/registerForm.php';
}

function validateLogInForm($data, $pass)
{
    global $error, $errorMessage;

    if (strlen(str_replace(' ', '', $data)) == 0) {
        $error = "data";
        $errorMessage = "This field can't be empty";
        return false;
    }
    elseif (strlen($pass) == 0) {
        $error = "pass";
        $errorMessage = "This field can't be empty";
        return false;
    }
    elseif (strlen($pass) < 6) {
        $error = "pass";
        $errorMessage = "Password length has to be 6 minimum";
        return false;
    }
    return true;
}
