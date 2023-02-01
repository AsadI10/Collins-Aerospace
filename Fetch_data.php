<?php
session_start();

header('Content-Type: application/json');
echo $_SESSION["data"];
?>