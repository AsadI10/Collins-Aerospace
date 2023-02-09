<?php
require_once("ProductData.php");
require_once("APIInterface.php");
require_once("CacheDB.php");
session_start();
// If an identifier is provided, return that specific ProductData if it exists.
if(isset($_POST["identifier"]) ){
	$result = ProductData::LoadFromCache($_POST["identifier"]);
	if($result != null)
		echo json_encode($result);
}
// Return array of all
else{
	$allArr = array();
	$identifiers = $_SESSION["APIInterface"]->GetAllProductIdentifiers();

	foreach($identifiers as $identifier){
		array_push($allArr, ProductData::Load($identifier));
	}

	echo json_encode($allArr);
}
?>