<?php
header("Content-Type: application/json");

$response = '{
    "ResultCode" : 0,
    "ResultDesc": "Accepted"
}';

$mpesaResponse = file_get_contents('php://input');

$logFile = "validationResponse.txt";

$jsonMpesaResponse = json_decode($mpesaResponse, true);

$log = fopen($logFile, "a");

fwrite($log, $mpesaResponse);

fclose($log);


echo $response;
