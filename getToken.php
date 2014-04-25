<?php

include 'XirSys.php';

$xirsysCall = new XirSys();

// If CORS is enabled, set proper headers
$xirsysCall->checkForCors();

// Execute POST request to get a XirSys security token
echo $xirsysCall->getToken($_POST["room"], $_POST["username"]);

?>