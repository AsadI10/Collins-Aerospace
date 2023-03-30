<?php
if(!isset($_POST["data"]) || $_POST["data"] == "")
{
	exit();
}

require_once("./ProductData.php");
require_once("./SessionMaster.php");

//Converts the post fields (In CSV format) into a PHP style Array.
//$_POST["data"] = str_getcsv($_POST["data"]);
$arrid = array();

$_POST["data"] = json_decode($_POST["data"]);
/*

this never worked, this routine will always only have ONE marker passed into it, 
instead of making constant expensive DB calls to check what weve already loaded
i have passed the leaflet Marker into the function to increase performance.

//checks to see if just one marker has been passed or a collection
if(gettype($_POST["identifier"])!= "string"){
	foreach($_POST["identifier"] as $id){
		array_push($arrid, ProductData::Load($id));
	}
}
else{
	array_push($arrid, ProductData::Load($_POST["identifier"]));
}
*/
//iterates through collection and outputs correct format.
?>
	<h1 class="phpheader"><?php echo $_POST["data"]->Name; ?>
	<div class="divsidepanal">
		Identifier: <?php echo $_POST["data"]->Identifier; ?><br>
		Document Type: <?php echo $_POST["data"]->DocumentType; ?><br>
		Mission: <a style="color: red; font-weight: bold;" onclick="document.getElementById('MissionSearch').value='<?php echo $_POST["data"]->MissionID; ?>'; ReloadMap();"><?php echo $_POST["data"]->MissionID; ?></a><br>
		Creator: <?php echo $_POST["data"]->Creator; ?><br>
		Created: <?php echo date("d-m-Y H:i:s", $_POST["data"]->DateCreated); ?><br>
		Modified: <?php echo date("d-m-Y H:i:s", $_POST["data"]->DateModified); ?><br>
	</div>
	<a class="Details-link" target="_blank" href=<?php echo ("\"Product_view.php?identifier=".$_POST["data"]->Identifier)."\"";  ?>>Details</a></h1>
<?php
?>
