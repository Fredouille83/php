<?php

include 'XirSys.php';

$xirsysCall = new XirSys();

// If CORS is enabled, set proper headers
$xirsysCall->checkForCors();

// Execute POST request to get XirSys ICE servers
echo $xirsysCall->getIceServers($_POST["room"], $_POST["username"]);

?>
