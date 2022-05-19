<?php
require("connection.php");
header("Content-Type: application/json");

$response = '{
    "ResultCode" : 0,
    "ResultDesc": "Accepted"
}';

$mpesaResponse = file_get_contents('php://input');

$logFile = "M_PESAConfirmationResponse.txt";

$jsonMpesaResponse = json_decode($mpesaResponse, true);

$type = $jsonMpesaResponse['TransactionType'];
$transID = $jsonMpesaResponse['TransID'];
$transTime = $jsonMpesaResponse['TransTime'];
$TransAmount = $jsonMpesaResponse['TransAmount'];
$BusinessShortCode = $jsonMpesaResponse['BusinessShortCode'];
$BillRefNumber = $jsonMpesaResponse['BillRefNumber'];
$InvoiceNumber = $jsonMpesaResponse['InvoiceNumber'];
$OrgAccountBalance = $jsonMpesaResponse['OrgAccountBalance'];
$ThirdPartyTransID = $jsonMpesaResponse['ThirdPartyTransID'];
$MSISDN = $jsonMpesaResponse['MSISDN'];
$FirstName = $jsonMpesaResponse['FirstName'];
$MiddleName = $jsonMpesaResponse['MiddleName'];
$LastName = $jsonMpesaResponse['LastName'];

$time = $transTime;
    $time= (string)$time;
    $month = $time[0].$time[1].$time[2].$time[3]."-".$time[4].$time[5];




$sql = "INSERT INTO mpesa(TransType, TransID, TransTime, TransAmount, BusinessShortCode, BillRefNumber, InvoiceNumber, OrgAccBalance, ThirdPartyTransID, MSISDN, FirstName, MiddleName, LastName, monthMPESA) VALUES ('$type','$transID','$transTime','$TransAmount','$BusinessShortCode','$BillRefNumber','$InvoiceNumber','$OrgAccountBalance','$ThirdPartyTransID','$MSISDN','$FirstName','$MiddleName','$LastName' , '$month')";

mysqli_query($conn,$sql);


$log = fopen($logFile, "a");

fwrite($log, $mpesaResponse);

fclose($log);

echo $response;