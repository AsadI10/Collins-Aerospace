<?php
require_once("ProductData.php");
session_start();

// If an identifier is provided, return that specific ProductData if it exists.
if(isset($_POST["identifier"]) ){
	$result = ProductData::LoadFromCache($_POST["identifier"]);
	if($result != null)
		echo json_encode($result);
}
else{
	echo json_encode($_SESSION["pd"]);
}
?>