<?php

include 'XirSys.php';

$xirsysCall = new XirSys();

// If CORS is enabled, set proper headers
$xirsysCall->checkForCors();

// Execute POST request to add a XirSys domain
echo $xirsysCall->addDomain($_POST["domain"]);

?>