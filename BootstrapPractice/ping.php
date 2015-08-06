<?php
    // This script is design to be called from an AJAX call in a javascript file. The AJAX call should POST to this script an IP address and timeout (in seconds). This script returns connection status and latency in json format to the AJAX call.

    // Inputs POSTed from AJAX call
    $ip = $_POST['ip'];
    $timeout = $_POST['timeout'];

    $port = 80;
    
    $tB = microtime(true); 
    $fP = fSockOpen($ip, $port, $errno, $errstr, $timeout); 
    if (!$fP) {
        $connected = false;
    } else{
        $tA = microtime(true); 
        $latency = round((($tA - $tB) * 1000), 0)." ms";
        $connected = true;
    }
    
    // Return json object to AJAX call
    $return['latency'] = json_encode($latency);
    $return['connected'] = json_encode($connected);
	echo json_encode($return);
?>