<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic '
  ),
));

$result = curl_exec($curl);

curl_close($curl);

$result = json_decode($result);

$access_token = $result->access_token;


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "ShortCode":"600998",
    "CommandID":"CustomerPayBillOnline",
    "Amount":"10",
    "Msisdn":"254708374149",
    "BillRefNumber":"H2"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$access_token,
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
