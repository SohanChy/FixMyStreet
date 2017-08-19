<?php

require_once "initialize.php";

$streets = Street::getAll();

require_once 'Views/home.php';