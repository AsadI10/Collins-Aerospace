<?php
/* Instantiate $ch (curl object).

 This object will be used for all
 calls back and forth to the API.
 The object can also take many extra
 'bodys', 'headers', 'POST' fields 
 for certain requests.

 read this for basics to POST &
 Header fields:

 https://reqbin.com/Article/HttpPost

 also refer to this to demonstrate
 CURL_OPT functions:
 https://stackoverflow.com/questions/61266770/how-to-get-oauth-2-0-using-php-curl-with-client-credentials-as-grant-type
 */

session_start();

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://hallam.sci-toolset.com/discover/api/v1/products/search"); //set API URL
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //enables returned JSON from execution
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //disables SSL/TPL for execution
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // **

$headers = array(
    'Accept: */*',
    'Authorization: Bearer '.$_SESSION["authtoken"],
    'Content-Type: application/json',
    'Host: localhost' //return address
);

curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

$post = '{"size":5, "keywords":""}';

curl_setopt($ch, CURLOPT_POSTFIELDS,$post);

$results = curl_exec($ch);

curl_close($ch);

var_dump($results);


?>