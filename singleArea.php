 <?php

require_once 'initialize.php';

$areaid = check("areaid");
$area = Area::find($areaid);

$streets = Street::getAllByAreaId($area->id);

require_once 'Views/home.php';