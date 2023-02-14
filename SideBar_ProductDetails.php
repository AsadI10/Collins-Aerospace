<?php
if(!isset($_POST["identifier"]))
{
	exit();
}

require_once("ProductData.php");
session_start();

$_POST["identifier"] = str_getcsv($_POST["identifier"]);
$arrid = array();
if(gettype($_POST["identifier"])!= "string"){
	foreach($_POST["identifier"] as $id){
		array_push($arrid, ProductData::Load($id));
	}
}
else{
	array_push($arrid, ProductData::Load($_POST["identifier"]));
}
?>

<?php foreach($arrid as $id){ ?>
<h1><?php echo $id->GetName(); ?></h1>
Document Type: <?php echo $id->DocumentType; ?><br>
Creator: <?php echo $id->Creator; ?><br>
Created: <?php echo $id->DateCreated; ?><br>
Modified: <?php echo $id->DateModified; ?><br>
<?php
}?>
