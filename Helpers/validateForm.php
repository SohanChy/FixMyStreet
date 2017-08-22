<?php

function validateLogInForm()
{
    global $error, $errorMessage;

    $fields = array("data", "pass");
    
    if (! checkFields($fields)) {
        return false;
    }
    
    if (strlen($_POST["pass"]) < 6) {
        $error = "pass";
        $errorMessage = "Password length has to be 6 minimum";
        return false;
    }
    return true;
}

function validateRegForm()
{
    global $error, $errorMessage;
    $fields = array("name", "mobile", "email", "address", "pass", "conPass");

    if (! checkFields($fields)) {
        return false;
    }

    if (strlen($_POST["mobile"]) < 11) {
        $error = "mobile";
        $errorMessage = "Invalid mobile no";
        return false;
    }
    if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error = "email";
        $errorMessage = "Invalid email";
        return false;
    }
    if (strlen($_POST["pass"]) < 6) {
        $error = "pass";
        $errorMessage = "Password length has to be 6 minimum";
        return false;
    }
    if ($_POST["pass"] != $_POST["conPass"]) {
        $error = "conPass";
        $errorMessage = "Password doesn't match";
        return false;
    }
    return true;
}

function validateAddStreetForm()
{
    global $error, $errorMessage;
    
    $fields = array("name", "details");
    
    if (! checkFields($fields)) {
        return false;
    }
    
    if ($_POST["area"] == "old" && $_POST["oldArea"] == "") {
        $error = "oldArea";
        $errorMessage = "Select an area or create new";
        return false;
    }
    if ($_POST["area"] == "new" && $_POST["newArea"] == "") {
        $error = "newArea";
        $errorMessage = "Enter area name or select from dropdown menu";
        return false;
    }
    if (! checkFiles()) {
        $error = "picture";
        $errorMessage = "image is required";
        return false;
    }
    return true;
}

function checkFiles()
{
    global $error, $errorMessage;

    $fields = array("pic1", "pic2", "pic3");
    
    $flag = false;
    foreach($fields as $field) {
        if (isset($_FILES[$field]) && $_FILES[$field]["error"] == 0) {
            $flag = true;
        }
    }
    return $flag;
}

function checkFields($fields)
{
    global $error, $errorMessage;

    foreach($fields as $field) {
        if (! isset($_POST[$field]) || $_POST[$field] == "") {
            $error = $field;
            $errorMessage = "This field can't be empty";
            return false;
        }
    }
    return true;
}
