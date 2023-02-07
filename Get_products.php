<?php
//FORGET ABOUT BELOW!


/*
    $set = curl_exec($ch);
    curl_close($ch);

    $set = json_decode($set);
    $p = "product";
    $r = "result";
    $c = "centre";
    var_dump($set->$p->$r->$c);

*/



//BULLSHIT CRAP CRAP CRAPGETS THE COORDINATES AND ALL META DATA.
function getDetails($id){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://hallam.sci-toolset.com/discover/api/v1/products/".$id); //set API URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); //enables returned JSON from execution
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //disables SSL/TPL for execution
    curl_setopt($ch, CURLOPT_TCP_FASTOPEN, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //**

    $headers = array(
        'Accept: */*',
        'Authorization: Bearer '.$_SESSION["authtoken"],
        'Content-Type: application/json',
    );

    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);

    $set = curl_exec($ch);
    curl_close($ch);

    $set = json_decode($set);
    $p = "product";
    $r = "result";
    $c = "centre";
    var_dump($set->$p->$r->$c);
    //INSERT INTO DB HERE TO JAVASCRIPT CAN ACCESS IT AND DRAW IT!
}
?>