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

$ch = curl_init();


curl_setopt($ch, CURLOPT_URL, "https://hallam.sci-toolset.com/api/v1/token"); //set API URL
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //enables returned JSON from execution
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //disables SSL/TPL for execution
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // **

//setting header variables for API call. (So API reaches correct Endpoint)
$headers = array(
    'Content-Type: application/x-www-form-urlencoded',
    'Accept: */*',
    'Host: localhost' //return address
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); //provides the CURLOPT_HTTPHEADER with the $header array for the curl request

//same as header except POST
$data = array(
    'grant_type=password&username=hallam&password=9JS(g8Zh'
);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //same as header except POST


//set the <CLIENTID>:<CLIENTSECRET> for the API's communication with us... the client.
$userdetail = "hallam:9JS(g8Zh"; //gibberish username and pass
curl_setopt($ch,CURLOPT_USERPWD, $userdetail); //same as setting an option for the header except its for <USERNAME>:<PASSWORD> and takes a string

//executes the curl request and gets the status code (200) being success
$result = curl_exec($ch);  

//prints log to screen
print($result);

//ALWAYS CLOSE CONNECTIONS!
curl_close($ch);

?>