<?php
if(!isset($_GET['identifier'])){
    exit();
}
require_once("./APIInterface.php");
require_once("./SessionMaster.php");

?>

<head>
    <link rel="stylesheet" href="CSS/index.css"/>
</head>
<body>
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