<?php

require_once "Models/Connection.php";
require_once "Models/Street.php";
require_once "Models/Area.php";
require_once "Models/User.php";
require_once "Helpers/GetCurUser.php";
$rootFolder =  basename(__DIR__) ;

$areaPhp = "singleArea.php";
$streetPhp = "singleStreet.php";

function check($id)
{
    if (isset($_GET[$id])) {
        if (!empty($_GET[$id])) {
            $pid = $_GET[$id];
            return $pid;
        } else {
            redirectToHome();
        }
    } else {
        redirectToHome();
    }
}

function redirectToHome()
{
    header('Location: index.php');
    exit();
}

function redirectTo($path)
{
    header('Location: '.$path);
    exit();
}

function cool_dump($data){
	highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
}