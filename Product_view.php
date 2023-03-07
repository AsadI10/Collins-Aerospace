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
    <div style="overflow:auto; height:90%">
    <?php

    $data = $_SESSION['APIInterface']->GetRawProductData($_GET['identifier']);
    //$json_string = json_encode($_SESSION['APIInterface']->GetRawProductData($_GET['identifier']), JSON_PRETTY_PRINT);

    function displaylevel($obj, $depth, $isarr){
        $hasDisplayed = false;
        foreach($obj as $name => $val){
            $hasDisplayed = true;
            if(!$isarr){
                echo str_repeat("-",$depth * 4); echo "\"".$name."\""; ?> : <?php
            }
            else{
                echo str_repeat("-",$depth * 4); echo "[".$name."]"; ?> : <?php
            }

            switch(gettype($val)){
                case "object":
                    ?> <br> <?php
                    displaylevel($val,$depth+1, false);
                    break;
                case "array":
                    ?> <br> <?php
                    displaylevel($val,$depth+1, true);
                    break;
                case "int":
                    echo $val;
                    ?> <br> <?php
                    break;
                default:
                    echo $val == null ? "NULL" : "\"".$val."\"";
                    ?> <br> <?php
                    break;
            }
        }
        if(!$hasDisplayed){
            echo str_repeat("-",$depth * 4)."EMPTY";
            ?> <br> <?php
        }
    }

    displaylevel($data,0, false);
    
    ?>
    </div>
</body>