 <?php

require_once 'initialize.php';

$searchKey = check("q");

$streets = Street::searchByName($searchKey);

require_once 'Views/home.php';