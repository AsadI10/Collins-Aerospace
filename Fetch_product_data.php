<?php
require_once("ProductData.php");
session_start();

if(isset($_POST["all"])){
}
// If an identifier is provided, return that specific ProductData if it exists.
else if(isset($_POST["identifier"]) ){
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

	var_dump($allArr);

	echo json_encode($allArr);
}
?>