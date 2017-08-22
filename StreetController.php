<?php

require_once "initialize.php";
require_once "Helpers/validateForm.php";

$message = "";
$error = "picture";
$errorMessage = "image required";

if (!empty($_POST) && isset($_POST["area"])) {
    if (validateAddStreetForm()) {
        $areaObj = null;
        $streetObj = null;
    
        if ($_POST["area"] == "old") {
            $areaObj = Area::searchByName($_POST["oldArea"]);
        } elseif ($_POST["area"] == "new") {
            $areaObj = new Area(
                $_POST["newArea"],
                1
            );
            $areaObj->save();
        }
    
        $streetObj = new Street($_POST["name"]," ",$_POST["details"],$areaObj->id,1);
        $streetObj->save();
        redirectToSingleStreet($streetObj->id);
    }
}

require_once 'Views/StreetForm.php';

function redirectToSingleStreet($id)
{
    header("Location: singleStreet.php?streetid=".$id);
    exit();
}