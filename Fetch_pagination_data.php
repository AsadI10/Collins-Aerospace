<?php
require_once("./ProductData.php");
require_once("./APIInterface.php");
require_once("./CacheDB.php");

session_start();

if($_SESSION['Pagination_id'] != null){
    $allarr = array();
    $identifiers = $_SESSION["APIInterface"]->GetPaginationIdentifiers();

    foreach($identifiers as $identifier){
        array_push($allarr, ProductData::Load($identifier));
    }

    echo json_encode($allarr);
}
?>