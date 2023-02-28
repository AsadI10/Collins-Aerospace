<?php
if(!isset($_GET['identifier'])){
    exit();
}
require_once("./APIInterface.php");
require_once("./SessionMaster.php");

?>

<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/index.css"/>
</head>
<body>
    <br>
    <?php
    include("PageHeader.php");

    ?>
    <div>
    <?php

    $_SESSION['APIInterface']->GetRawData($_GET['identifier']);
    $json_string = json_encode($_SESSION['APIInterface']->GetRawData($_GET['identifier']), JSON_PRETTY_PRINT);
    echo $json_string;
    ?>
    </div>
</body>