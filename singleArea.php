 <?php

require_once 'initialize.php';

$areaid = check("areaid");
$area = Area::find($areaid);

$streets = Street::getAllByAreaId($area->id);

$message = $streets 
            ? "All Streets in <b>{$area->name}</b> Area with problem are here"
            : "Nothing to show";

require_once 'Views/home.php';