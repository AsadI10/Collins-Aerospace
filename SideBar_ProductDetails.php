<?php
if(!isset($_POST["identifier"]))
{
	exit();
}

require_once("ProductData.php");
session_start();

$productData = ProductData::Load($_POST["identifier"]);
?>

<h1><?php echo $productData->GetName(); ?></h1>
Creator: <?php echo $productData->Creator; ?><br>
Created: <?php echo $productData->DateCreated; ?><br>
Modified: <?php echo $productData->DateModified; ?><br>