 <?php

require_once 'initialize.php';

$areaid = check("areaid");
$area = Area::find($areaid);

$streets = Street::getAllByAreaId($area->id);

$message = "All Streets in <b>{$area->name}</b> Area with problem are here";

require_once 'Views/home.php';