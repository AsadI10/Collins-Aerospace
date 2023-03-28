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
    <!-- <link rel="stylesheet" href="CSS/index.css"/> -->
    <title>Collins Team One</title>
</head>
<body>
    <br> 
    <?php
    include("PageHeader.php");
    ?>
    <br>
    <?php
    $data = $_SESSION['APIInterface']->GetRawProductData($_GET['identifier']);

    include("Histogram.php");
    ?>

    <div class="DataProductPage">
    <?php
    function displaylevel($obj, $isarr){
        // Create a list of all members
        ?>
        <ul>
        <?php
            $hasDisplayed = false;
            foreach($obj as $name => $val){
                ?>
                <li>
                    <span class="variable_name">
                        <?php
                        // Display a name
                        $hasDisplayed = true;
                        if(!$isarr){
                            echo "\"".$name."\"";
                        }
                        else{
                            echo "[".$name."]";
                        }
                        ?>
                    </span> : <span class="variable_value">
                    <?php

                    // If object type has children, display
                    switch(gettype($val)){
                        case "object":
                            ?> <br> <?php
                            displaylevel($val, false);
                            break;
                        case "array":
                            ?> <br> <?php
                            displaylevel($val, true);
                            break;
                        case "integer":
                            echo $val;
                            ?> <br> <?php
                            break;
                        default:
                            echo $val == null ? "NULL" : "\"".$val."\"";
                            ?> <br> <?php
                            break;
                    }
                    ?>
                    </span>
                </li>
                <?php
            }
            if(!$hasDisplayed){
                ?> <span class="variable_value"> <?php
                echo "EMPTY";
                ?> </span> <br> <?php
            }
            ?>
        </ul>
        <?php
    }
    displaylevel($data,0, false);
    
    ?>
    </div>
    <br>
</body>

<style>
    nav{
    text-align: right;
    overflow: hidden;
    position: relative;
    margin-top: -48px;
    padding-right: 15px;
}
nav ul li{
    display: inline;
    font-size: 17px;
    color: black;
    padding:100px 10px 10px; 
    padding: 5px 16px;
    font-weight: bold;
    font-family: 'Courier New', Courier, monospace; 
    cursor: pointer;
}
    .DataProductPage{
        border: solid black 2px;
        font-size: 19px;
        width: 80%;
        padding: 2px;
        margin-left: 150px;
        /* style="overflow:auto; height:90%" */
    }
    body{
        overflow: auto;
        height:100%;
    }
    #chart_div{
    margin: auto;
    width: 95%;
    position: relative;
    margin-top: -17px;
}
</style>