<?php
require_once("ProductData.php");
session_start();

// If an identifier is provided, return that specific ProductData if it exists.
if(isset($_POST["identifier"]) ){
	//// Try and retrieve from cache
	//$result = ProductData::LoadFromCache($_POST["identifier"]);
	//// If not in cache, fetch it and cache it.
	//if(!isset($result)){
	//	// Fetch data from api
	//	$data = null;
	//	// If no data is returned from api, return null;
	//	if(!isset($data)){
	//		return null;
	//	}
	//
	//	// Otherwise, initialize obejct then cache.
	//	$result = new ProductData($_POST["identifier"]);
	//
	//	$result->SaveToCache();
	//}
	//echo json_encode($result);


	echo "test";
	$test = new ProductData("test");
	$test->Name = "test";

	echo json_encode($test);
}
else{
	echo json_encode($_SESSION["pd"]);
}
?>