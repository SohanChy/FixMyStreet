<?php

require_once "initialize.php";
require_once "Helpers/validateForm.php";

$message = "";
$error = "";
$errorMessage = "";

if (! $curUser) {
    $message = "Log In is required";
    require_once 'Views/loginForm.php';
    exit();
}

if (!empty($_POST) && isset($_POST["area"])) {
    if (validateAddStreetForm()) {

        $areaObj = null;
        $streetObj = null;
    
        if ($_POST["area"] == "old") {
            $areaObj = Area::searchByName($_POST["oldArea"]);
            if (! $areaObj) { //Not necesssary but just for good practice
                $error = "oldArea";
                $errorMessage = "Area not found";
            }
        } elseif ($_POST["area"] == "new") {
            $areaObj = Area::searchByName($_POST["newArea"]);
            if (! $areaObj) {
                $areaObj = new Area(
                    $_POST["newArea"],
                    $curUser->id
                );
                $areaObj->save();
            }
        }
        if ($areaObj) {
            $streetObj = new Street(
                $_POST["name"],
                "",
                $_POST["details"],
                $areaObj->id,
                $curUser->id
            );
            $streetObj->save();
            $streetObj->imageJson = savePicFiles($streetObj->id);
            $streetObj->save();

            redirectTo("singleStreet.php?streetid=".$streetObj->id);
        }
    }
}

require_once 'Views/StreetForm.php';

//saved file name Format : streetId_xx_time_xx_key_xx.ext
function savePicFiles($streetId)
{
    $fields = array("pic1", "pic2", "pic3");
    
    $imageArray = [];
    foreach($fields as $key => $field) {
        if (isset($_FILES[$field]) && $_FILES[$field]["error"] == 0) {
            $info = pathinfo($_FILES[$field]['name']);
            $ext = $info['extension']; // get the extension of the file
            $newname = "streetId_".$streetId
                        ."_time_".time()
                        ."_key_".$key
                        .".".$ext; 
            $target = 'pictures/'.$newname;
            
            move_uploaded_file($_FILES[$field]['tmp_name'], $target);

            array_push($imageArray, $newname);
        }
    }
    return json_encode($imageArray);
}