<?php
//======================================
// POST Parameters

// Use of multiple parameters are supported unless otherwise specified.
//--------------------------------------
// "identifier": Returns 0 or 1 products that match the identifier. All other post parameters are ignored.
// "documenttype": Returns 0 or more products that match the documenttype.
// "missionid": Returns 0 or more products that match the missionid.
//======================================

require_once("./ProductData.php");
require_once("./APIInterface.php");
require_once("./CacheDB.php");
require_once("./SessionMaster.php");

// If an identifier is provided, return that specific ProductData if it exists.
// If it doesn't exist, return nothing
if(isset($_POST["identifier"]) ){
	$result = ProductData::Load($_POST["identifier"]);
	if($result != null)
	{
		echo json_encode($result);
	}
	exit();
}

// Get search criteria
$searchDocumentType = isset($_POST["documenttype"]) ? $_POST["documenttype"] : null;
$searchMissionID = isset($_POST["missionid"]) ? $_POST["missionid"] : null;


// Return array of all matching products
$allArr = array();
$identifiers = $_SESSION["APIInterface"]->GetAllProductIdentifiers($searchDocumentType, $searchMissionID);

foreach($identifiers as $identifier){
	array_push($allArr, ProductData::Load($identifier));
}

echo json_encode($allArr);
?>