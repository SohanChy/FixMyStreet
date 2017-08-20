<?php

if (!isset($_SESSION) || !is_array($_SESSION)) {
    session_start();
}

$curUser = false;

if (isset($_SESSION["curUser"]) && !empty($_SESSION["curUser"])) {
    $curUser = $_SESSION["curUser"];
}
elseif (isset($_COOKIE["token"]) && !empty($_COOKIE["token"])) {
    $curUser = $_SESSION["curUser"] = User::findByToken($_SESSION["token"]);
}