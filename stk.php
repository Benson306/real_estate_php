<?php 
$hook = file_get_contents('php://input');
$logFile = "stk.txt";
$log = fopen($logFile, "a");

fwrite($log, $hook);

fclose($log);


?>