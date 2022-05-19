<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://tinypesa.com/api/v1/express/initialize',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('amount' => '1','msisdn' => '254740826478'),
  CURLOPT_HTTPHEADER => array(
    'Apikey: VvwujB5aunS'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
