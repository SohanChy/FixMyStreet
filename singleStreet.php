<?php

require_once 'initialize.php';

$streetid = check("streetid");

$streets[] = Street::find($streetid);

require_once 'Views/home.php';