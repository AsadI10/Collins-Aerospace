<?php
session_start();
$data = $_SESSION["data"];

header('Content-Type: application/json');
echo json_encode($_SESSION["data"]);
?>