<?php

require_once "initialize.php";

$streets = Street::getAll();

$message = "All Streets with problem are here";

require_once 'Views/home.php';