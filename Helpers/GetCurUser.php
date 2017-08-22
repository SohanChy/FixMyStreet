<?php

if (! isset($_SESSION) || ! is_array($_SESSION)) {
    session_start();
}

$curUser = false;

if (isset($_SESSION["curUser"])) {
    $curUser = $_SESSION["curUser"];
}
elseif (isset($_COOKIE["token"])) {
    $curUser = $_SESSION["curUser"] = User::findByToken($_COOKIE["token"]);
}