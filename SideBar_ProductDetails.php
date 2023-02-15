<?php
if(!isset($_POST["identifier"]) || $_POST["identifier"] == "")
{
	exit();
}

require_once("./ProductData.php");
require_once("./SessionMaster.php");

//Converts the post fields (In CSV format) into a PHP style Array.
$_POST["identifier"] = str_getcsv($_POST["identifier"]);
$arrid = array();

//checks to see if just one marker has been passed or a collection
if(gettype($_POST["identifier"])!= "string"){
	foreach($_POST["identifier"] as $id){
		array_push($arrid, ProductData::Load($id));
	}
}
else{
	array_push($arrid, ProductData::Load($_POST["identifier"]));
}
?>
<!--
//iterates through collection and outputs correct format.
-->
<?php foreach($arrid as $id){ ?>
<h1 class="phpheader"><?php echo $id->GetName(); ?></h1>
<div class="divsidepanal">
Document Type: <?php echo $id->DocumentType; ?><br>
Creator: <?php echo $id->Creator; ?><br>
Created: <?php echo $id->DateCreated; ?><br>
Modified: <?php echo $id->DateModified; ?><br>

</div>


<?php
}?>