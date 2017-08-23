<?php

require_once 'initialize.php';

$streetid = check("streetid");

$street = Street::find($streetid);

$user = User::find($street->user_id);

require_once 'Views/singleStreet.php';